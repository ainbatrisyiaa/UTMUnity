<!-- process_add_event.php -->
<?php
require "php/functions.php";

// Check if the form is submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data
    $title = $_POST['title'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $details = $_POST['details'];

    // Upload image
    $target_dir = "events/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

        // Insert event into the database
        if (addEvent($title, $category, $description, $details, $_FILES["image"]["name"])) {

            // Get the start and end date/time from the form
            $event_start_date = $_POST['event_start_date'];
            $event_start_time = $_POST['event_start_time'];
            $event_end_date = $_POST['event_end_date'];
            $event_end_time = $_POST['event_end_time'];

            // Combine date and time to create DateTime objects
            $start_datetime = new DateTime($event_start_date . ' ' . $event_start_time);
            $end_datetime = new DateTime($event_end_date . ' ' . $event_end_time);

            // Format dates to be stored in the calendar_event_master table
            $formatted_start = $start_datetime->format('Y-m-d H:i:s');
            $formatted_end = $end_datetime->format('Y-m-d H:i:s');

            // Insert event into the calendar_event_master table
            if (addEventToCalendar($title, $formatted_start, $event_start_time, $formatted_end, $event_end_time)) {
                echo "Event added successfully!";
                header("Location: view_all_events.php");
                exit; // Make sure to exit after a header redirect
            } else {
                echo "Error adding event to the calendar database.";
            }
        } else {
            echo "Error adding event to the events_2 table.";
        }

    } else {
        echo "Error uploading image.";
    }
} else {
    echo "Invalid request method.";
}
?>
