<?php
$servername = "localhost";
$username = "DevGenius";
$password = "UTMUnity67";
$dbname = "devgenius";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the required fields are set in the $_POST array
    $full_name = isset($_POST['full_name']) ? $_POST['full_name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone_number = isset($_POST['phone_number']) ? $_POST['phone_number'] : '';
    $event_name = isset($_POST['event_name']) ? $_POST['event_name'] : '';
    $participant_type = isset($_POST['participant_type']) ? $_POST['participant_type'] : '';
    $student_id = isset($_POST['student_id']) ? $_POST['student_id'] : '';
    $staff_id = isset($_POST['staff_id']) ? $_POST['staff_id'] : '';
    $faculty = isset($_POST['faculty']) ? $_POST['faculty'] : '';
    $medical_info = isset($_POST['medical_info']) ? $_POST['medical_info'] : '';

    // Check for database connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Your SQL query with prepared statement
    $stmt = $conn->prepare("INSERT INTO registration (full_name, email, phone_number, event_name, participant_type, student_id, staff_id, faculty, medical_info) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("sssssssss", $full_name, $email, $phone_number, $event_name, $participant_type, $student_id, $staff_id, $faculty, $medical_info);

    // Execute the query
    if ($stmt->execute()) {
        $data = array(
            'status' => true,
            'msg' => 'Registration successful!'
        );
        // Redirect to the next page using JavaScript
        echo '<script>alert("Registration Successful");</script>';
    echo '<script>window.location.href = "index1.php";</script>';
    exit;  // Ensure that no further content is sent to the browser

    } else {
        $data = array(
            'status' => false,
            'msg' => 'Sorry, registration not successful: ' . $stmt->error
        );
    }

    // Close the prepared statement
    $stmt->close();

    // Close the database connection
    $conn->close();

} else {
    $data = array(
        'status' => false,
        'msg' => 'Invalid request method'
    );
}

// You can use the $data array to handle the response or redirect the user as needed
?>
