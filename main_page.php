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

// Fetch events from the database
$sql = "SELECT * FROM events_2 LIMIT 4";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #a3e4d7;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            overflow: hidden;
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            border-radius: 10px 10px 0 0;
        }

        .event {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
            cursor: pointer;
        }

        .event img {
            max-width: 50%;
            height: 40%;
            border-radius: 5px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <header>
        <h1>Charity</h1>
    </header>

    <?php
    // Check if there are events to display
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo '<div class="event">';
            echo '<img src="events/' . $row['image'] . '" alt="' . $row['title'] . '">';
            // Fix the hyperlink to the event details page
            echo '<h2><a href="event_details.php?id=' . $row['id'] . '">' . $row['title'] . '</a></h2>';
            echo '</div>';
        }
    } else {
        echo '<p>No events found.</p>';
    }

    // Close the database connection
    $conn->close();
    ?>

</div>

</body>
</html>
