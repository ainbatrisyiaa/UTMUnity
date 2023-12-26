<?php
// Establish a database connection
$servername = "localhost";
$username = "localhost";
$password = "donationform";
$dbname = "donationdetails";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Specify the event name you want to retrieve
$eventName = 'Save Animals Life'; // Replace with the actual event name you want

// Fetch event data for a specific event
$result = $conn->query("
    SELECT UserDetails.event_name, UserDetails.donate
    FROM UserDetails
    WHERE UserDetails.event_name = '$eventName'
");

if ($result->num_rows > 0) {
    $totalDonation = 0;

    while ($row = $result->fetch_assoc()) {
        $totalDonation += $row["donate"];
    }

    echo "<tr>";
    echo "<td>" . $eventName . "</td>";
    echo "<td>$" . number_format($totalDonation, 2) . "</td>";
    echo "</tr>";
} else {
    echo "<tr><td colspan='2'>Event not found</td></tr>";
}

$conn->close();
?>
