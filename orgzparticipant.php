<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="feedbackpage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participant List</title>
    <style>
        body {
        font-family: Arial, sans-serif;
        background-color: #a3e4d7;
        margin: 0;
        padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        form {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<form method="post" action="">
    <label for="event">Select Event:</label>
    <select name="event" id="event">
        <!-- Populate the dropdown with event names from your database -->
        <?php
        $servername = "localhost";
        $username = "DevGenius";
        $password = "UTMUnity67";
        $dbname = "devgenius";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT DISTINCT event_name FROM registration";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value=\"{$row['event_name']}\">{$row['event_name']}</option>";
            }
        }

        $conn->close();
        ?>
    </select>
    <input type="submit" value="Show Participants">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedEvent = isset($_POST['event']) ? $_POST['event'] : '';

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM registration WHERE event_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $selectedEvent);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Event Name</th>
                <th>Participant Type</th>
                <th>Student ID</th>
                <th>Staff ID</th>
                <th>Faculty</th>
                <th>Medical Info</th>
            </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['full_name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['phone_number']}</td>
                <td>{$row['event_name']}</td>
                <td>{$row['participant_type']}</td>
                <td>{$row['student_id']}</td>
                <td>{$row['staff_id']}</td>
                <td>{$row['faculty']}</td>
                <td>{$row['medical_info']}</td>
            </tr>";
        }

        echo "</table>";
    } else {
        echo "No participants found for the selected event.";
    }

    $stmt->close();
    $conn->close();
}
?>

</body>
</html>
