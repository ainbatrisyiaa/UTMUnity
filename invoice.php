<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Invoice</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #a3e4d7;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .invoice-container {
            width: 600px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .invoice-header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }

        .invoice-details {
            margin-bottom: 20px;
        }

        .invoice-details p {
            margin: 5px 0;
        }

        .invoice-items table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .invoice-items th,
        .invoice-items td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .invoice-footer {
            text-align: right;
            font-weight: bold;
        }

        .back-to-home {
            text-decoration: none;
            color: #fff;
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
    <div class="invoice-container">
        <h2 class="invoice-header">Invoice</h2>

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

        // Sample data, you can replace it with your actual data
        $eventName = 'Planting Tree Is Fun';

        // Fetch items and amounts from the database
        $result = $conn->query("
            SELECT first_name, donate
            FROM userdetails
            WHERE event_name = '$eventName'
        ");

        if ($result->num_rows > 0) {
            $items = array();
            $totalDonation = 0;

            while ($row = $result->fetch_assoc()) {
                $items[] = array($row["first_name"], $row["donate"]);
                $totalDonation += $row["donate"];
            }

            
        // Get the current date and time when the invoice is viewed
        $viewingDate = date('Y-m-d H:i:s');

            echo "<div class='invoice-details'>";
            echo "<p><strong>Viewing Date:</strong> " . $viewingDate . "</p>";
            echo "<p><strong>Event Name:</strong> " . $eventName . "</p>";
            echo "</div>";

            echo "<div class='invoice-items'>";
            echo "<table>";
            echo "<thead><tr><th>Donor Name</th><th>Amount</th></tr></thead>";
            echo "<tbody>";
            foreach ($items as $item) {
                echo "<tr><td>" . $item[0] . "</td><td>$" . number_format($item[1], 2) . "</td></tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";

            echo "<div class='invoice-footer'>";
            echo "<p>Total: $" . number_format($totalDonation, 2) . "</p>";
            echo "</div>";
        } else {
            echo "<p>No items found for the specified event</p>";
        }

        $conn->close();
        ?>

        <a href="orgzwelcome.php" class="back-to-home">Back to Home</a>
    </div>
</body>

</html>
