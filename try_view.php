<!DOCTYPE HTML>
<html lang="en">

<head>
    <link rel="stylesheet" href="feedbackpage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submitted Form</title>
</head>

<body>

            <!-- Add a dropdown for event selection -->
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="get" class="volunteer-form">
    <label for="event_id">Select Event:</label>
    <select name="event_id" id="event_id" required>
        <?php
        // Assuming you have a database connection established
        $conn = mysqli_connect("localhost", "DevGenius", "UTMUnity67", "devgenius");

        // Fetch events for the dropdown
        $eventsQuery = "SELECT event_id, event_name FROM events";
        $eventsResult = mysqli_query($conn, $eventsQuery);

        if (!$eventsResult) {
            die("Error fetching events: " . mysqli_error($conn));
        }

        // Check if any events are retrieved
        if (mysqli_num_rows($eventsResult) > 0) {
            while ($eventRow = mysqli_fetch_assoc($eventsResult)) {
                $eventId = $eventRow['event_id'];
                $eventName = $eventRow['event_name'];
                echo "<option value='$eventId'>$eventName</option>";
            }
        } else {
            echo "<option value='' disabled>No events available</option>";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
    </select>
    <input type="submit" class="button2" value="Select Event">
</form>



            <?php
            // Check if an event is selected
            if (isset($_GET['event_id'])) {
                // Assuming you have a database connection established
                $conn = mysqli_connect("localhost", "DevGenius", "UTMUnity67", "devgenius");

                // Retrieve the event details from the database based on the event_id
                $event_id = $_GET['event_id'];
                $eventQuery = "SELECT * FROM events WHERE event_id = $event_id";
                $eventResult = mysqli_query($conn, $eventQuery);

                if ($eventResult && mysqli_num_rows($eventResult) > 0) {
                    $eventRow = mysqli_fetch_assoc($eventResult);
                    $eventName = $eventRow['event_name'];
                    $organizer = $eventRow['organizer'];

                    echo "<h2>Welcome to the $eventName Feedback Form!</h2>";
                    echo "<p>Organized by: $organizer</p>";
                    echo "<br>";

                    // Display the form questions dynamically
                    $questionsQuery = "SELECT * FROM questions WHERE event_id = $event_id";
                    $questionsResult = mysqli_query($conn, $questionsQuery);

                    echo "<form action='submit_answers.php' method='post' class='volunteer-form'>";
                    echo "<input type='hidden' name='event_id' value='$event_id'>"; // Pass the event_id in the form

                    while ($questionRow = mysqli_fetch_assoc($questionsResult)) {
                        // Display your questions and input fields here
                        // Example:
                        echo "<div class='question'>";
                        echo "<label for='answer_$questionRow[question_id]'>$questionRow[question_text]</label>";
                        echo "<input type='text' name='answer_$questionRow[question_id]' required>";
                        echo "</div>";
                    }

                    echo "<input type='submit' class='button2' value='Submit Answers'>";
                    echo "</form>";
                } else {
                    echo "<p>Event not found.</p>";
                }

                // Close the database connection
                mysqli_close($conn);
            }
            ?>
        </div>
    </div>
</body>
</html>