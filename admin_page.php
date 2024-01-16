<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('bg.jpeg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            background-color: #a3e4d7;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .admin-container {
            width: 600px;
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="admin-container">
        <h2>Event List and Total Donation</h2>
        <table>
            <thead>
                <tr>
                    <th>Event Name</th>
                    <th>Total Donation</th>
                </tr>
            </thead>
            <tbody>
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

                // Fetch event data with total donation
                $result = $conn->query("
                    SELECT event_name, SUM(donate) as total_donation
                    FROM UserDetails
                    GROUP BY event_name
                ");

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["event_name"] . "</td>";
                        echo "<td>$" . number_format($row["total_donation"], 2) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No events found</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
