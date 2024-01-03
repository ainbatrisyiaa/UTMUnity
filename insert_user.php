<?php
session_start();
$db_connection = mysqli_connect("localhost", "DevGenius", "UTMUnity67", "devgenius");

if (!$db_connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($db_connection, $_POST['id']);
    $name = mysqli_real_escape_string($db_connection, $_POST['name']);
    $email = mysqli_real_escape_string($db_connection, $_POST['email']);
    $category = mysqli_real_escape_string($db_connection, $_POST['category']);

    $insert_query = "INSERT INTO `google` (`oauth_id`, `name`, `email`, `category`) VALUES ('$id', '$name', '$email', '$category')";

    if (mysqli_query($db_connection, $insert_query)) {
        // Update the session category
        $_SESSION['category'] = $category;
        // Set the session variable for logged in user
        $_SESSION['loggedin'] = $id;
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "Invalid request";
}

mysqli_close($db_connection);
?>
