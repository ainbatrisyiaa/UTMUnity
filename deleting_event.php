<!-- delete_event.php -->

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $event_id = $_POST["id"];

    // Add this line for debugging
    file_put_contents("delete_log.txt", "Delete request received for ID: $event_id\n", FILE_APPEND);

    $servername = "localhost";
    $username = "DevGenius";
    $password = "UTMUnity67";
    $dbname = "devgenius";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the DELETE statement
    $stmt = $conn->prepare("DELETE FROM events_2 WHERE id = ?");
    $stmt->bind_param("i", $event_id);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    echo json_encode(["status" => true, "msg" => "Event deleted successfully"]);
} else {
    header("HTTP/1.1 400 Bad Request");
    echo "Invalid request";
}
?>

