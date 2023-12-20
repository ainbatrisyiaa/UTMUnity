<?php
$servername = "localhost";
$username = "JelizaJustine";
$password = "";
$dbname = "volunteering_events";

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

// Insert data into database
$sql = "INSERT INTO registration (full_name, email, phone_number, participant_type, student_id, staff_id, faculty, medical_info) 
        VALUES ('$full_name', '$email', '$phone_number', '$participant_type', '$student_id', '$staff_id', '$faculty', '$medical_info')";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful!";
	header("Location: index1.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
