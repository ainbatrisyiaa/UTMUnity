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

// Check if the user_id and donate are set in the URL
if (isset($_GET["user_id"], $_GET["donate"])) {
    $user_id = $_GET["user_id"];
    $donate = $_GET["donate"];

    // Prepare the SQL statement to retrieve user details
    $stmt = $conn->prepare("SELECT * FROM UserDetails WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);

    // Execute the prepared statement
    $stmt->execute();

    // Get the result set
    $result = $stmt->get_result();

    // Check if user details are found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email_id = $row["email_id"];
        $event_name = $row["event_name"];
        $last_name = $row["last_name"];
        $first_name = $row["first_name"];
        $phone_number = $row["phone_number"];
    } else {
        // Handle the case when user details are not found
        exit("User details not found.");
    }

    // Close the prepared statement
    $stmt->close();
} else {
    // Handle the case when user_id or donate is not set in the URL
    exit("User ID or donation amount not provided.");
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            text-align: center;
            padding-top: 50px;
        }

        .receipt-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #8d4004;
            margin-bottom: 10px;
        }

        .receipt-text {
            font-size: 18px;
            color: #6C757D;
            margin-bottom: 20px;
        }

        .back-to-home {
            text-decoration: none;
            color: #ffffff;
            background-color: #2E8B57;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
            display: inline-block;
            margin-top: 20px;
        }

        .back-to-home:hover {
            background-color: #CC6640;
        }
    </style>
</head>

<body>
    <div class="receipt-container">
        <h2>Donation Receipt</h2>
        <p class="receipt-text">Thank you, <strong><?php echo $first_name . " " . $last_name; ?></strong>, for your generous donation.</p>
        <p class="receipt-text">Details:</p>
        <p class="receipt-text">Email: <?php echo $email_id; ?></p>
        <p class="receipt-text">Event Name: <?php echo $event_name; ?></p>
        <p class="receipt-text">Phone Number: <?php echo $phone_number; ?></p>
        <p class="receipt-text">Donation Amount: $<?php echo $donate; ?></p>
        <a href="studenthome.php" class="back-to-home">Back to Home</a>
    </div>
</body>
</html>
