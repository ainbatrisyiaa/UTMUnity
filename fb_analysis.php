<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="feedbackpage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Add your CSS styles here or link to an external stylesheet */
        .content2 {
            margin-left: 370px;
            text-align: left;
        }

        select {
            width: 300px; /* Adjust the width as needed */
            padding: 8px; /* Adjust padding as needed */
            font-size: 16px; /* Adjust font size as needed */
            border-radius: 10px;
        }

        button {
            width: 150px;
            padding: 8px;
            font-size: 16px; /* Adjust font size as needed */
            border-radius: 10px;
        }

        .body2 {
            margin-left: 40px;
            font-family: Arial, Helvetica, sans-serif;
            /*background-color: #a3e4d7;*/
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background-color: #ffffff;
        }
    </style>

    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="header">
    <a href="#default" class="logo">
        <img id="first-logo" src="utm-logo.png">
        <img id="second-logo" src="vol-club.png">
    </a>
    <div class="header-right">
        <a href="admin.php">Home</a>
        <a href="admin_page.php">Donate</a>
        <a href="orgFeedback.php">Feedback</a>
    </div>
</div>

    <div style="font-family: Arial; padding: 10px;">
        <ul style="list-style-type: none; padding: 0; margin: 0;">
            <li style="display: inline-block; margin-right: 10px;">
                <a href="orgFeedback.php" style="text-decoration: none; color: #333; padding: 5px 10px; background-color: #ddd; border-radius: 5px;">Feedback</a>
            </li>
            <li style="display: inline-block; margin-right: 10px; font-weight: bold; color: #555;">&gt;&gt;</li>
            <li style="display: inline-block;">
                <a href="fb_analysis.php" style="text-decoration: none; color: #333; padding: 5px 10px; background-color: #ddd; border-radius: 5px;">Feedback Report</a>
            </li>
        </ul>
    </div>

<div class="body2">
    <h1>Program Feedback Report</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="event">Select Event:</label>
        <select name="event" id="event">
            <?php
            // Assuming you have a database connection established
            $conn = mysqli_connect("localhost", "DevGenius", "UTMUnity67", "devgenius");

            // Fetch events for the dropdown
            $eventsQuery = "SELECT id, title FROM events_2";
            $eventsResult = mysqli_query($conn, $eventsQuery);

            if (!$eventsResult) {
                die("Error fetching events: " . mysqli_error($conn));
            }

            // Check if any events are retrieved
            if (mysqli_num_rows($eventsResult) > 0) {
                while ($eventRow = mysqli_fetch_assoc($eventsResult)) {
                    $eventId = $eventRow['id'];
                    $eventName = $eventRow['title'];
                    echo "<option value='$eventId'>$eventName</option>";
                }
            } else {
                echo "<option value='' disabled selected>No events available</option>";
            }

            // Close the database connection
            mysqli_close($conn);
            ?>
        </select>
        <button type="submit">View Feedback</button>
    </form>

    <?php
    session_start();
    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get selected event from the form
        $selectedEventId = $_POST["event"];

        // Fetch event name and feedback data for the selected event
        $conn = mysqli_connect("localhost", "DevGenius", "UTMUnity67", "devgenius");

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $eventNameQuery = "SELECT title FROM events_2 WHERE id = '$selectedEventId'";
        $eventNameResult = mysqli_query($conn, $eventNameQuery);

        if (!$eventNameResult) {
            die("Error fetching event name: " . mysqli_error($conn));
        }

        $eventRow = mysqli_fetch_assoc($eventNameResult);
        $selectedEventName = ($eventRow) ? $eventRow['title'] : '';

        // Fetch feedback data for the selected event
        $feedbackData = getFeedbackData($conn, $selectedEventId);

        // Fetch options for all questions outside the loop
        $optionsQuery = "SELECT id, options FROM questions WHERE event_id = '$selectedEventId'";
        $optionsResult = mysqli_query($conn, $optionsQuery);

        if (!$optionsResult) {
            die("Error fetching options: " . mysqli_error($conn));
        }

        $questionOptionsMap = [];
        while ($optionsRow = mysqli_fetch_assoc($optionsResult)) {
            $questionOptionsMap[$optionsRow['id']] = explode(',', $optionsRow['options']);
        }

        // Store data in session
        $_SESSION['selectedEventId'] = $selectedEventId;
        $_SESSION['selectedEventName'] = $selectedEventName;
        $_SESSION['feedbackData'] = $feedbackData;
        $_SESSION['questionOptionsMap'] = $questionOptionsMap;

        // Close the database connection after fetching options
        mysqli_close($conn);
    }
?>


<?php

// Include PhpSpreadsheet classes
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Display feedback report
if (isset($feedbackData)) {
    echo "<h2>Feedback Report for $selectedEventName</h2>";
    $numResponses = count($feedbackData['responses'][array_keys($feedbackData['responses'])[0]]);
    echo "<p>Number of Responses: " . $numResponses . "</p>";

    // Download button for Excel file
    echo '<a href="javascript:void(0);" onclick="confirmDownload()">Download Excel</a>';

    // Start the flex container
    echo '<div style="display: flex; flex-wrap: wrap;">';

    // Render the charts using the fetched options
    foreach ($feedbackData['questions'] as $question) {
        $questionId = $question['id'];
        $questionOptions = $questionOptionsMap[$questionId];

        // Set the width for each chart container
        echo '<div style="width: 30%; margin: 20px;">';
        echo '<h3>Question: ' . $question['question_text'] . '</h3>';
        echo '<canvas id="feedbackChart' . $questionId . '"></canvas>';
        echo '</div>';
    }

    echo '</div>'; // End the flex container

    // Start the script block outside the loop
    echo '<script>';
    echo 'document.addEventListener("DOMContentLoaded", function () {';

    foreach ($feedbackData['questions'] as $question) {
        $questionId = $question['id'];
        $questionOptions = $questionOptionsMap[$questionId];

        // Generate chart data for each question
        $chartData = generateChartData($feedbackData['responses'][$questionId], $questionOptions);

        // Output JavaScript for each chart
        echo 'var ctx' . $questionId . ' = document.getElementById("feedbackChart' . $questionId . '").getContext("2d");';
        echo 'var feedbackChart' . $questionId . ' = new Chart(ctx' . $questionId . ', {';
        echo 'type: "bar",';
        echo 'data: {';
        echo 'labels: ' . json_encode($questionOptions) . ',';
        echo 'datasets: [{';
        echo 'label: "Responses",';
        echo 'data: ' . json_encode(array_values($chartData)) . ',';
        echo 'backgroundColor: "rgba(75, 192, 192, 0.2)",';
        echo 'borderColor: "rgba(75, 192, 192, 1)",';
        echo 'borderWidth: 1';
        echo '}],';
        echo '},';
        echo 'options: {';
        echo 'scales: {';
        echo 'y: {';
        echo 'beginAtZero: true';
        echo '}';
        echo '}';
        echo '}';
        echo '});';
    }

    echo '});';
    echo '</script>';

    // Check if the download_excel parameter is set in the URL
    if (isset($_GET['download_excel']) && $_GET['download_excel'] == 1) {
        downloadExcel($feedbackData, $questionOptionsMap);
    }
}
?>

<script>
function confirmDownload() {
    var confirmMsg = "Are you sure you want to download the Excel file?";
    if (confirm(confirmMsg)) {
        // If user confirms, trigger the download
        window.location.href = 'download_excel.php';
    }
}
</script>

<?php
// Function to generate chart data from responses
function generateChartData($responses, $options)
{
    $chartData = array_fill_keys($options, 0);

    // Iterate through each response for the question
    foreach ($responses as $response) {
        // Iterate through each character in the response
        foreach (str_split($response) as $selectedOption) {
            if (isset($chartData[$selectedOption])) {
                $chartData[$selectedOption]++;
            }
        }
    }

    return $chartData;
}
?>


<?php
    // Function to fetch feedback data from the database
function getFeedbackData($conn, $selectedEventId)
{
    // Escape user input to prevent SQL injection
    $selectedEventId = mysqli_real_escape_string($conn, $selectedEventId);

    // Fetch questions for the selected event using a prepared statement
    $questionsQuery = "SELECT * FROM questions WHERE event_id = ?";
    $questionsStmt = mysqli_prepare($conn, $questionsQuery);
    mysqli_stmt_bind_param($questionsStmt, "i", $selectedEventId);
    mysqli_stmt_execute($questionsStmt);
    $questionsResult = mysqli_stmt_get_result($questionsStmt);

    if (!$questionsResult) {
        die("Error fetching questions: " . mysqli_error($conn));
    }

    $questions = [];
    while ($questionRow = mysqli_fetch_assoc($questionsResult)) {
        $questions[] = $questionRow;
    }

    // Fetch responses for each question
    $responses = [];

    foreach ($questions as $question) {
        $questionId = $question['id'];
        $responsesQuery = "SELECT response FROM responses WHERE event_id = ? AND question_id = ?";
        $responsesStmt = mysqli_prepare($conn, $responsesQuery);
        mysqli_stmt_bind_param($responsesStmt, "ii", $selectedEventId, $questionId);
        mysqli_stmt_execute($responsesStmt);
        $responsesResult = mysqli_stmt_get_result($responsesStmt);

        if (!$responsesResult) {
            die("Error fetching responses: " . mysqli_error($conn));
        }

        // Fetch all responses for the current question
        $questionResponses = [];
        while ($responseRow = mysqli_fetch_assoc($responsesResult)) {
            $questionResponses[] = $responseRow['response'];
        }

        $responses[$questionId] = $questionResponses;
    }

    return ['questions' => $questions, 'responses' => $responses];
}

?>
</div>

</body>
</html>
