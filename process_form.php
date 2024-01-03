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
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$phone_number = $_POST['phone_number'];
$participant_type = $_POST['participant'];
$student_id = $_POST['student_id'];
$staff_id = $_POST['staff_id'];
$faculty = $_POST['faculty'];
$medical_info = $_POST['medical_info'];
$event_name = $_POST['event_name']; 

// Insert data into database
$sql = "INSERT INTO registration (full_name, email, phone_number, participant_type, student_id, staff_id, faculty, medical_info, event_name) 
        VALUES ('$full_name', '$email', '$phone_number', '$participant_type', '$student_id', '$staff_id', '$faculty', '$medical_info', '$event_name')";


if ($conn->query($sql) === TRUE) {
    echo "Registration successful!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>

