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

    // Fetch the corresponding form_id for the selected event
    $formQuery = "SELECT id FROM forms WHERE event_id = $event_id LIMIT 1";
    $formResult = mysqli_query($conn, $formQuery);

    if ($formResult && mysqli_num_rows($formResult) > 0) {
        $formRow = mysqli_fetch_assoc($formResult);
        $form_id = $formRow['id'];

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

        // Use prepared statements for better security
        $insertQuery = "INSERT INTO responses (form_id, question_id, event_id, response) VALUES (?, ?, ?, ?)";

        // Start a transaction
        mysqli_begin_transaction($conn);

        try {
            // Prepare the statement
            $stmt = mysqli_prepare($conn, $insertQuery);

            // Check for errors in preparation
            if (!$stmt) {
                throw new Exception("Error in preparing statement: " . mysqli_error($conn));
            }

            // Bind parameters
            mysqli_stmt_bind_param($stmt, "iiis", $form_id, $question_id, $event_id, $response);

            // Execute the statement for each response
            foreach ($responses as $question_id => $response) {
                // Execute the statement
                $result = mysqli_stmt_execute($stmt);

                // Check for errors in execution
                if (!$result) {
                    throw new Exception("Error in executing statement: " . mysqli_stmt_error($stmt));
                }
            }

            // Commit the transaction
            mysqli_commit($conn);

            header("Location: share_feedback.php");
            exit;
        } catch (Exception $e) {
            // Rollback the transaction on any exception
            mysqli_rollback($conn);

            echo "Error: " . $e->getMessage();
        } finally {
            // Close the statement
            mysqli_stmt_close($stmt);
        }
    } else {
        echo "Error: Form not found for the selected event.";
    }
}

// Close the database connection
mysqli_close($conn);
?>
