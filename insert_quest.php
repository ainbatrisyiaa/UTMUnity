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
  $organizer = $_POST['organizer'];
  $openDate = $_POST['open_date'];
  $openTime = $_POST['open_time'];
  $closeDate = $_POST['close_date'];
  $closeTime = $_POST['close_time'];

  // Validate and obtain event_id from events_2
  $eventName = $_POST['event_name']; // Assuming this is the name of the event
  $eventQuery = "SELECT id FROM events_2 WHERE title = ?";
  $eventStmt = $conn->prepare($eventQuery);
  $eventStmt->bind_param("s", $eventName);
  
  if (!$eventStmt->execute()) {
      die("Error checking event details: " . $eventStmt->error);
  }

  $eventResult = $eventStmt->get_result();
  $eventRow = $eventResult->fetch_assoc();

  if (!$eventRow) {
      die("Event not found in events_2 table.");
  }

  $eventId = $eventRow['id'];

  // Insert into forms table
  $eventInsertQuery = "INSERT INTO forms (event_id, organizer, open_date, open_time, close_date, close_time) VALUES (?, ?, ?, ?, ?, ?)";
  $eventStmt = $conn->prepare($eventInsertQuery);
  $eventStmt->bind_param("isssss", $eventId, $organizer, $openDate, $openTime, $closeDate, $closeTime);

  if (!$eventStmt->execute()) {
      die("Error inserting event details: " . $eventStmt->error);
  }

  // Get the auto-generated form_id
  $formId = $conn->insert_id;

    // Insert Questions
    $questions = $_POST['questions'];
    $answerFormats = $_POST['answer_formats'];
    $options = $_POST['options'];

    $questionInsertQuery = "INSERT INTO questions (form_id, event_id, question_text, answer_format, options) VALUES (?, ?, ?, ?, ?)";
    $questionStmt = $conn->prepare($questionInsertQuery);
    $questionStmt->bind_param("iisss", $formId, $eventId, $question, $answerFormat, $option);

    foreach ($questions as $index => $question) {
        $answerFormat = $answerFormats[$index];
        $option = $options[$index];

        if (!$questionStmt->execute()) {
            die("Error inserting question: " . $questionStmt->error);
        }
    }

    $confirmationMessage = "Are you sure you want to publish the form?";
    echo "<script>";
    echo "if (confirm('$confirmationMessage')) {";
    echo "    window.location.href = 'publish_form.php';";
    echo "} else {";
    echo "    alert('Form publication canceled.');";
    echo "}";
    echo "</script>";
    exit();
}

mysqli_close($conn);
?>
