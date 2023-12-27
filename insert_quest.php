<?php
$servername = "localhost";
$username = "DevGenius";
$password = "UTMUnity67";
$dbname = "devgenius";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Insert Event Details
    $eventName = $_POST['event_name'];
    $organizer = $_POST['organizer'];
    $openDate = $_POST['open_date'];
    $openTime = $_POST['open_time'];
    $closeDate = $_POST['close_date'];
    $closeTime = $_POST['close_time'];

    $eventInsertQuery = "INSERT INTO Events (event_name, organizer, open_date, open_time, close_date, close_time) VALUES ('$eventName', '$organizer', '$openDate', '$openTime', '$closeDate', '$closeTime')";
    mysqli_query($conn, $eventInsertQuery);

    // Get the auto-generated event_id
    $eventId = mysqli_insert_id($conn);

    // Insert Questions
    $questions = $_POST['questions'];
    $answerFormats = $_POST['answer_formats'];
    $options = $_POST['options'];

    foreach ($questions as $index => $question) {
        $answerFormat = $answerFormats[$index];
        $option = $options[$index];

        $questionInsertQuery = "INSERT INTO Questions (event_id, question_text, answer_format, options) VALUES ('$eventId', '$question', '$answerFormat', '$option')";
        mysqli_query($conn, $questionInsertQuery);
    }

    // Redirect or show success message
    header("Location: view_form.php");
    exit();
}

mysqli_close($conn);
?>