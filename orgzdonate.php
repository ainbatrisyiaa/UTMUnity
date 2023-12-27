<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organization Donation</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #a3e4d7;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
        }

        .admin-container {
            width: 80%;
            max-width: 600px;
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            text-align: center;
        }

        .total-donation {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .no-event {
            color: #555;
        }

        .back-to-home {
            text-decoration: none;
            color: #ffffff;
            background-color: #2E8B57;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
            display: inline-block;
        }

        .back-to-home:hover {
            background-color: #CC6640;
        }
    </style>
</head>

<body>
    <div class="admin-container">
        <h2>Your Total Donation</h2>

        <?php
        // Establish a database connection
        $servername = "localhost";
        $username = "DevGenius";
        $password = "UTMUnity67";
        $dbname = "devgenius";


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

            echo "<div class='total-donation'>";
            echo "<p>Event Name: " . $eventName . "</p>";
            echo "<p>Total Donation: $" . number_format($totalDonation, 2) . "</p>";
            echo "</div>";
        } else {
            echo "<p class='no-event'>Event not found</p>";
        }

        $conn->close();
        ?>

    <a href="welcome.php" class="back-to-home">Back to Home</a>
    </div>
</body>

</html>
