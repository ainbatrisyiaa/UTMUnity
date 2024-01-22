<?php
function updateEvent($eventId, $postData) {
    $servername = "localhost";
    $username = "DevGenius";
    $password = "UTMUnity67";
    $dbname = "devgenius";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if a new image is provided
    if ($_FILES["image"]["name"]) {
        // Upload new image
        $target_dir = "events/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Update the image path in the database
            $stmt = $conn->prepare("UPDATE events_2 SET title = ?, image = ? WHERE id = ?");
            $stmt->bind_param("ssi", $postData['title'], $_FILES["image"]["name"], $eventId);
        } else {
            echo "Error uploading new image.";
            return false;
        }
    } else {
        // No new image provided, update without changing the image path
        $stmt = $conn->prepare("UPDATE events_2 SET title = ? WHERE id = ?");
        $stmt->bind_param("si", $postData['title'], $eventId);
    }

    // Execute the update query
    $result = $stmt->execute();

    $stmt->close();
    $conn->close();

    return $result;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    // Implement your function to update event details
    $updatedEvent = updateEvent($id, $_POST); // Ensure updateEvent function is implemented

    if ($updatedEvent) {
        // Redirect back to view_all_events.php with updated information
        header("Location: view_all_events.php");
        exit;
    } else {
        echo "Failed to update event";
    }
} else {
    header("HTTP/1.1 400 Bad Request");
    echo "Invalid request";
    exit;
}
?>
