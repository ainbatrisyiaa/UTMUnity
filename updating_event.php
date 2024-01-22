<!-- updating_event.php -->

<?php
function getEventById($eventId) {
    $servername = "localhost";
    $username = "DevGenius";
    $password = "UTMUnity67";
    $dbname = "devgenius";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM events_2 WHERE id = ?");
    $stmt->bind_param("i", $eventId);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $event = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
        return $event;
    } else {
        $stmt->close();
        $conn->close();
        return false; // Event not found
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];

    // Implement your function to get event details by ID
    $event = getEventById($id);

    if (!$event) {
        echo "Event not found";
        exit; // Add exit to stop further execution
    }
} else {
    header("HTTP/1.1 400 Bad Request");
    echo "Invalid request";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Event</title>
    <link rel="stylesheet" href="styles1.css">
</head>
<body>

    <?php include "header.php" ?>

    <main>
        <div class="right">
            <div class="section-title">Update Event</div>
            <form action="process_update.php" method="post" enctype="multipart/form-data">
                <!-- Populate form fields with existing event details -->
                <input type="hidden" name="id" value="<?php echo $event['id']; ?>" />

                <div class="input-box">
                    <label>Title</label>
                    <input type="text" name="title" value="<?php echo $event['title']; ?>" required />
                </div>

                <!-- Other event details input fields go here, pre-filled with existing values -->

                <div class="input-box">
                    <label>Image</label>
                    <input type="file" name="image" accept="image/*" />
                </div>

                <div class="input-box">
                    <label>Category</label>
                    <select name="category" required>
                        <!-- Add options dynamically based on your categories -->
                        <option value="category1">NGO</option>
                        <option value="category2">UTMVolunteer</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>

                <div class="input-box">
    <label>Description</label>
    <!-- Use textarea for description -->
    <textarea name="description" placeholder="Enter event description" required><?php echo $event['description']; ?></textarea>
</div>

<div class="input-box">
    <label>Details</label>
    <!-- Use textarea for details -->
    <textarea name="details" placeholder="Enter event details" required><?php echo $event['details']; ?></textarea>
</div>


                <!-- Add other input fields as needed -->

                <button type="submit">Update Event</button>
            </form>
        </div>
    </main>

    <?php include "footer.php" ?>

    <script src="javascript/script.js"></script>

</body>
</html>
