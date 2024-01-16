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

// Get id from the URL
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch event details from the database based on id
    $sql = "SELECT * FROM events_2 WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

    // Display event details with your provided styles
    echo '<!DOCTYPE html>';
    echo '<html lang="en">';
    echo '<head>';
    echo '<meta charset="UTF-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<title>Event Details</title>';

    // Include your provided styles
    echo '<style>';
    echo 'body {';
    echo '    font-family: Arial, sans-serif;';
    echo '    background-color: #a3e4d7;';
    echo '    margin: 0;';
    echo '    padding: 0;';
    echo '}';
    echo '.container {';
    echo '    max-width: 800px;';
    echo '    margin: 50px auto;';
    echo '    background-color: #ffffff;';
    echo '    border-radius: 10px;';
    echo '    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);';
echo '    text-align: center;';
echo '    overflow: hidden;';
echo '}';
echo 'header {';
echo '    background-color: #4CAF50;';
echo '    color: white;';
echo '    padding: 20px;';
echo '    border-radius: 10px 10px 0 0;';
echo '}';
echo '.event-details {';
echo '    margin: 20px;';
echo '    padding: 20px;';
echo '    border-radius: 5px;';
echo '    background-color: #f9f9f9;';
echo '}';
echo '.event img {';
echo '    max-width: 70%;';
echo '    height: auto;';
echo '    border-radius: 5px;';
echo '    margin-bottom: 10px;';
echo '}';
echo '.event-name {';
echo '    font-size: 24px;';
echo '    margin-bottom: 10px;';
echo '}';
echo '.donate-button {';
echo '    margin: 20px;';
echo '    padding: 10px;';
echo '    background-color: #4CAF50;';
echo '    color: white;';
echo '    border: none;';
echo '    border-radius: 5px;';
    echo '    cursor: pointer;';
    echo '}';
    echo '</style>';
        echo '</head>';
        echo '<body>';

        echo '<div class="container">';
        echo '<header>';
        echo '<h2>Charity</h2>';
        echo '</header>';

        echo '<div class="event-details">';
        echo '<img src="events/' . $row['image'] . '" alt="' . $row['title'] . '">';
        echo '<h2 class="event-name">' . $row['title'] . '</h2>';
        echo '<p>' . $row['description'] . '</p>';
        echo '<p>' . $row['details'] . '</p>';
        // Add any other event details you want to display
        echo '</div>';

        // Add the Donate Now button with the JavaScript function
        echo '<button class="donate-button" onclick="redirectToDonation(\'' . $row['title'] . '\')">Donate Now</button>';

        echo '</div>';
        echo '</body>';
        echo '</html>';
    } else {
        echo '<p>Event not found.</p>';
    }
} else {
    echo '<p>Invalid request.</p>';
}

// Close the database connection
$conn->close();
?>

<!-- JavaScript function to redirect to donation page -->
<script>
    function redirectToDonation(eventTitle) {
        // Redirect to the donate.php page with the event title as a parameter
        window.location.href = 'Donationdetails.php?id' + encodeURIComponent(eventTitle);
    }
</script>
