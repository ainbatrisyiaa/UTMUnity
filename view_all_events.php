<?php
// view_all_events.php

function getAllEvents() {
    $servername = "localhost";
    $username = "DevGenius";
    $password = "UTMUnity67";
    $dbname = "devgenius";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM events_2";
    $result = $conn->query($sql);

    $events = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $events[] = $row;
        }
    }

    $conn->close();

    return $events;
}

// Fetch all events from the database
$events = getAllEvents();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Events</title>
    <link rel="stylesheet" href="styles1.css">
    <style>
        .event-box {
            margin-bottom: 20px; /* Adjust as needed */
        }

        .event-box img {
            max-width: 20%;
            max-height: 10;
            height: auto;
        }

        .modal-footer {
            margin-top: 10px; /* Adjust as needed */
        }
    </style>
</head>
<body>

    <?php include "header.php" ?>

    <main>
        <div class="right">
            <div class="section-title">All Events</div>

            <?php
            // Display events
            foreach ($events as $event) {
                echo "<div class='event-box'>";
                // Display the image using an <img> tag
                echo "<img src='events/{$event['image']}' alt='{$event['title']}' />";
                echo "<h2>{$event['title']}</h2>";
                echo "<p>Category: {$event['category']}</p>";
                echo "<p>Description: {$event['description']}</p>";
                echo "<p>Details: {$event['details']}</p>";
                echo "<div class='modal-footer'>";
                echo "<button type='button' class='btn btn-danger' onclick='confirmDelete({$event['id']})'>Delete Event</button>";
                echo "<button type='button' class='btn btn-warning' onclick='updateEvent({$event['id']})'>Update Event</button>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
    </main>

    <?php include "footer.php" ?>

    <script src="javascript/script.js"></script>

    <script>
function confirmDelete(eventId) {
    var result = confirm("Are you sure you want to delete this event?");
    if (result) {
        deleteEvent(eventId);
    }
}

function deleteEvent(eventId) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.status) {
                    console.log("Event deleted with ID: " + eventId);
                    // Reload the page after the delete request is complete
                    location.reload();
                } else {
                    console.error("Error deleting event: " + response.msg);
                }
            } else {
                console.error("Error deleting event: " + xhr.statusText);
            }
        }
    };

    xhr.open("POST", "deleting_event.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("id=" + eventId);
}


function updateEvent(eventId) {
    window.location.href = "updating_event.php?id=" + eventId;
}
</script>
</body>
</html>
