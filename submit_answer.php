<?php
// Assuming you have a database connection established
$conn = mysqli_connect("localhost", "DevGenius", "UTMUnity67", "devgenius");

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get event_id and other relevant data from the form
    $event_id = mysqli_real_escape_string($conn, $_POST['event_id']);

    // Create an array to store responses
    $responses = [];

    // Iterate through form fields (assuming they are named in the format 'answer_{question_id}')
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'answer_') === 0) {
            // Extract question_id from the field name
            $question_id = substr($key, strlen('answer_'));

            // Sanitize and store the response
            $response = mysqli_real_escape_string($conn, $value);
            $responses[$question_id] = $response;
        }
    }

    // Insert responses into the database (modify this based on your table structure)
    $insertQuery = "INSERT INTO responses (event_id, question_id, response) VALUES ";

    foreach ($responses as $question_id => $response) {
        $insertQuery .= "('$event_id', '$question_id', '$response'), ";
    }

    // Remove the trailing comma and execute the query
    $insertQuery = rtrim($insertQuery, ", ");
    $result = mysqli_query($conn, $insertQuery);

    if ($result) {
        echo "Responses successfully submitted!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
