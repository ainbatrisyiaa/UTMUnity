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
        <a href="#about">About Us</a>
        <a href="#getIn">Get Involved</a>
        <a href="#donate">Donate</a>
        <a href="#contact">Contact</a>
        <i class="fas fa-user profile-icon"></i> <!-- Font Awesome user icon -->
    </div>
</div>

<div class="body2">
    <h1>Our Program Review</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="event">Select Event:</label>
        <select name="event" id="event">
            <?php
            // Assuming you have a database connection established
            $conn = mysqli_connect("localhost", "DevGenius", "UTMUnity67", "devgenius");

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
    // Assuming you have a database connection
    $conn = mysqli_connect("localhost", "DevGenius", "UTMUnity67", "devgenius");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get selected event from the form
    $selectedEventId = $_POST["event"];

    // Fetch event name for the selected event
    $eventNameQuery = "SELECT event_name FROM events WHERE id = '$selectedEventId'";
    $eventNameResult = mysqli_query($conn, $eventNameQuery);

    if (!$eventNameResult) {
        die("Error fetching event name: " . mysqli_error($conn));
    }

    $eventRow = mysqli_fetch_assoc($eventNameResult);
    $selectedEventName = ($eventRow) ? $eventRow['event_name'] : '';

    // Fetch and display feedback for the selected event
    $feedbackData = getFeedbackData($conn, $selectedEventId);

    // Display feedback in a table
    if (!empty($feedbackData['questions']) && !empty($feedbackData['responses'])) {
        echo "<h2>Feedback for $selectedEventName</h2>";

        // Display header row with question_text as column titles
        echo "<table border='1' style='width:70%; font-size: 14px;'>";

        echo "<tr>";
        foreach ($feedbackData['questions'] as $question) {
            echo "<th>{$question['question_text']}</th>";
        }
        echo "</tr>";

        // Display response rows
        echo "<tr>";
        foreach ($feedbackData['responses'] as $response) {
            echo "<td>$response</td>";
        }
        echo "</tr>";

        echo "</table>";
    } else {
        echo "<p>No feedback available for $selectedEventName</p>";
    }
}


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
            $responses[] = ($responseRow) ? $responseRow['response'] : '';
        }

        return ['questions' => $questions, 'responses' => $responses];
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

</div>


</body>
</html>
