<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="feedbackpage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Add your CSS styles here or link to an external stylesheet */
        .content2 {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
        }

        .A {
            margin-left: 40px;
            font-family: Arial, Helvetica, sans-serif;
            /*background-color: #a3e4d7;*/
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
        <a href="#about">About Us</a>
        <a href="#getIn">Get Involved</a>
        <a href="#donate">Donate</a>
        <a href="#contact">Contact</a>
        <i class="fas fa-user profile-icon"></i> <!-- Font Awesome user icon -->
    </div>
</div>
<hr>
<div class = "A">
    <h1>Feedback Report</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="event">Select Event:</label>
        <select name="event" id="event">
            <?php
            // Assuming you have a database connection established
            $conn = mysqli_connect("localhost", "DevGenius", "UTMUnity67", "devgenius");

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Fetch events for the dropdown
            $eventsQuery = "SELECT id, event_name FROM events";
            $eventsResult = mysqli_query($conn, $eventsQuery);

            if (!$eventsResult) {
                die("Error fetching events: " . mysqli_error($conn));
            }

            // Check if any events are retrieved
            if (mysqli_num_rows($eventsResult) > 0) {
                while ($eventRow = mysqli_fetch_assoc($eventsResult)) {
                    $eventId = $eventRow['id'];
                    $eventName = $eventRow['event_name'];
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
    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get selected event from the form
        $selectedEventId = $_POST["event"];

        // Fetch event name and feedback data for the selected event
        $conn = mysqli_connect("localhost", "DevGenius", "UTMUnity67", "devgenius");

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $eventNameQuery = "SELECT event_name FROM events WHERE id = '$selectedEventId'";
        $eventNameResult = mysqli_query($conn, $eventNameQuery);

        if (!$eventNameResult) {
            die("Error fetching event name: " . mysqli_error($conn));
        }

        $eventRow = mysqli_fetch_assoc($eventNameResult);
        $selectedEventName = ($eventRow) ? $eventRow['event_name'] : '';

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

        // Close the database connection after fetching options
        mysqli_close($conn);
    }
?>


<?php
    // Display feedback report
    if (isset($feedbackData)) {
        echo "<h2>Feedback Report for $selectedEventName</h2>";
        echo "<p>Number of Responses: " . count($feedbackData['responses']) . "</p>";
        echo "Download Excel";

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
    }
?>

<?php
    // Function to generate chart data from responses
    function generateChartData($response, $options)
    {
        $chartData = array_fill_keys($options, 0);

        // Iterate through each character in the response
        foreach (str_split($response) as $selectedOption) {
            if (isset($chartData[$selectedOption])) {
                $chartData[$selectedOption]++;
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

        // Fetch questions for the selected event
        $questionsQuery = "SELECT * FROM questions WHERE event_id = '$selectedEventId'";
        $questionsResult = mysqli_query($conn, $questionsQuery);

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
            $responsesQuery = "SELECT response FROM responses WHERE event_id = '$selectedEventId' AND question_id = '$questionId'";
            $responsesResult = mysqli_query($conn, $responsesQuery);

            if (!$responsesResult) {
                die("Error fetching responses: " . mysqli_error($conn));
            }

            $responseRow = mysqli_fetch_assoc($responsesResult);
            $responses[$questionId] = ($responseRow) ? $responseRow['response'] : '';
        }

        return ['questions' => $questions, 'responses' => $responses];
    }
?>
</div>
</body>
</html>
