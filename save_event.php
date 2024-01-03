<?php
require 'database_connection.php';

$event_name = $_POST['event_name'];
$event_start_date = date("Y-m-d", strtotime($_POST['event_start_date']));
$event_end_date = date("Y-m-d", strtotime($_POST['event_end_date']));
$event_start_time = $_POST['event_start_time']; // Add this line
$event_end_time = $_POST['event_end_time']; // Add this line

// Combine date and time to create DateTime objects
$start_datetime = new DateTime("$event_start_date $event_start_time");
$end_datetime = new DateTime("$event_end_date $event_end_time");

// Format DateTime objects as strings for database insertion
$formatted_start_datetime = $start_datetime->format('Y-m-d H:i:s');
$formatted_end_datetime = $end_datetime->format('Y-m-d H:i:s');

$insert_query = "INSERT INTO `calendar_event_master` (`event_name`, `event_start_date`, `event_end_date`, `event_start_time`, `event_end_time`) VALUES ('$event_name', '$formatted_start_datetime', '$formatted_end_datetime', '$event_start_time', '$event_end_time')";

if(mysqli_query($con, $insert_query)) {
    $data = array(
        'status' => true,
        'msg' => 'Event added successfully!'
    );
} else {
    $data = array(
        'status' => false,
        'msg' => 'Sorry, Event not added.'
    );
}

echo json_encode($data);
?>


