<?php
require 'database_connection.php';

$event_id = isset($_POST['event_id']) ? $_POST['event_id'] : '';
$event_name = isset($_POST['event_name']) ? $_POST['event_name'] : '';
$event_start_date = isset($_POST['event_start_date']) ? date("Y-m-d", strtotime($_POST['event_start_date'])) : '';
$event_end_date = isset($_POST['event_end_date']) ? date("Y-m-d", strtotime($_POST['event_end_date'])) : '';
$event_start_time = isset($_POST['event_start_time']) ? $_POST['event_start_time'] : '';
$event_end_time = isset($_POST['event_end_time']) ? $_POST['event_end_time'] : '';

// Check if required keys are present
if ($event_id === '' || $event_name === '' || $event_start_date === '' || $event_end_date === '' || $event_start_time === '' || $event_end_time === '') {
    $data = array(
        'status' => false,
        'msg' => 'Invalid data provided.'
    );
} else {
    // Combine date and time to create DateTime objects
    $start_datetime = new DateTime("$event_start_date $event_start_time");
    $end_datetime = new DateTime("$event_end_date $event_end_time");

    // Format DateTime objects as strings for database insertion
    $formatted_start_datetime = $start_datetime->format('Y-m-d H:i:s');
    $formatted_end_datetime = $end_datetime->format('Y-m-d H:i:s');

    $update_query = "UPDATE `calendar_event_master` SET 
                     `event_name` = '$event_name', 
                     `event_start_date` = '$formatted_start_datetime', 
                     `event_end_date` = '$formatted_end_datetime', 
                     `event_start_time` = '$event_start_time', 
                     `event_end_time` = '$event_end_time' 
                     WHERE `event_id` = $event_id";

    if(mysqli_query($con, $update_query)) {
        $data = array(
            'status' => true,
            'msg' => 'Event updated successfully!'
        );
    } else {
        $data = array(
            'status' => false,
            'msg' => 'Sorry, Event not updated.'
        );
    }
}

echo json_encode($data);
?>

