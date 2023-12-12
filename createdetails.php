<?php
$servername = "localhost";
$username = "localhost";
$password = "donationform";
$dbname = "donationdetails";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create the "UserDetails" table if it doesn't exist
$sqlUserDetails = "CREATE TABLE IF NOT EXISTS UserDetails (
    user_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    event_name VARCHAR(255),
    email_id VARCHAR(255),
    first_name VARCHAR(255),
    last_name VARCHAR(100),
    phone_number INT(12),
    donate FLOAT(6)
)";

if (mysqli_query($conn, $sqlUserDetails)) {
    echo "Table UserDetails created successfully or already exists<br>";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
