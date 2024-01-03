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

// Get form data
$full_name = isset($_POST['full_name']) ? $_POST['full_name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$phone_number = isset($_POST['phone_number']) ? $_POST['phone_number'] : '';
$event_name = isset($_POST['event_name']) ? $_POST['event_name'] : '';
$participant_type = isset($_POST['participant_type']) ? $_POST['participant_type'] : '';
$student_id = isset($_POST['student_id']) ? $_POST['student_id'] : '';
$staff_id = isset($_POST['staff_id']) ? $_POST['staff_id'] : '';
$faculty = isset($_POST['faculty']) ? $_POST['faculty'] : '';
$medical_info = isset($_POST['medical_info']) ? $_POST['medical_info'] : '';

// Insert data into database
$sql = "INSERT INTO registration (full_name, email, phone_number, event_name, participant_type, student_id, staff_id, faculty, medical_info) 
        VALUES ('$full_name', '$email', '$phone_number', '$event_name', '$participant_type', '$student_id', '$staff_id', '$faculty', '$medical_info')";


if ($conn->query($sql) === TRUE) {
    echo "Registration successful!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>

