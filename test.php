<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: googlelogin.php');
    exit;
}
$db_connection = mysqli_connect("localhost", "DevGenius", "UTMUnity67", "devgenius");
if (!$db_connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id']) && isset($_GET['name']) && isset($_GET['email'])) {
    // Assuming you have already established a database connection

    $id = mysqli_real_escape_string($db_connection, $_GET['id']);
    $name = mysqli_real_escape_string($db_connection, $_GET['name']);
    $email = mysqli_real_escape_string($db_connection, $_GET['email']);

    // Display a form to capture the user's role
    echo '<form method="post" action="">';
    echo '<label for="role">Select Role:</label>';
    echo '<select name="role" id="role">';
    echo '<option value="student">Student</option>';
    echo '<option value="staff">Staff</option>';
    echo '<option value="organization">Organization</option>';
    echo '</select>';
    echo '<input type="submit" value="Submit">';
    echo '</form>';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['role'])) {
        $role = mysqli_real_escape_string($db_connection, $_POST['role']);

        // Insert user information into the database
        $insert_query = "INSERT INTO `google` (`oauth_id`, `name`, `email`, `category`) VALUES ('$id', '$name', '$email', '$role')";
        
        if (mysqli_query($db_connection, $insert_query)) {
            echo "User information added successfully!";
        } else {
            echo "Error adding user information: " . mysqli_error($db_connection);
        }
    }
} else {
    echo "Invalid request!";
}

?>
