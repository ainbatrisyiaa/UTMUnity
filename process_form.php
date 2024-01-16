<?php
require 'database_connection.php';

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

    // Your database connection code
    // ...

    // Your SQL query
    $insert_query = "INSERT INTO `registration` (`full_name`, `email`, `phone_number`, `event_name`, `participant_type`, `student_id`, `staff_id`, `faculty`, `medical_info`) VALUES ('$full_name', '$email', '$phone_number', '$event_name', '$participant_type', '$student_id', '$staff_id', '$faculty', '$medical_info')";

    // Execute the query
    if (mysqli_query($con, $insert_query)) {
        $data = array(
            'status' => true,
            'msg' => 'Registration successful!'
        );
    } else {
        $data = array(
            'status' => false,
            'msg' => 'Sorry, registration not successful'
        );
    }

} else {
    $data = array(
        'status' => false,
        'msg' => 'Invalid request method'
    );
}

// You can use the $data array to handle the response or redirect the user as needed
?>




<!--?php
require 'database_connection.php';

$full_name = $_POST['full_name'];
$email = $_POST['email'];
$phone_number = $_POST['phone_number'];
$event_name = $_POST['event_name']; 
$participant_type = $_POST['participant_type']; 
$student_id = $_POST['student_id'];
$staff_id = $_POST['staff_id'];
$faculty = $_POST['faculty'];
$medical_info = $_POST['medical_info'];

$insert_query = "INSERT INTO `registration` (`full_name`, `email`, `phone_number`, `event_name`, `participant_type`, `student_id`, `staff_id`, `faculty`, `medical_info`) VALUES ('$full_name', '$email', '$phone_number', '$event_name', '$participant_type', '$student_id', '$staff_id', '$faculty', '$medical_info')";

if(mysqli_query($con, $insert_query)) {
    $data = array(
        'status' => true,
        'msg' => 'Registration successful!'
    );
} else {
    $data = array(
        'status' => false,
        'msg' => 'Sorry, registration not successful'
    );
}

?>



