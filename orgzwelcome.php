<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Initialize the session
session_start();
require 'studentstaffdb.php';
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

// Check if the user is logged in, if not then redirect him to the login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: googlelogin.php");
    exit;
}

// Replace these values with your actual database credentials
$servername = "localhost";
$username = "DevGenius";
$password = "UTMUnity67";
$database = "devgenius";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to select email from the 'google' table based on the user's ID
$user_id = $_SESSION["id"]; // Assuming 'id' is the user ID in your session
$sql = "SELECT email FROM google WHERE id = $user_id";

// Execute the query
$result = $conn->query($sql);

// Check if there is a row in the result set
if ($result->num_rows > 0) {
    // Fetch the email and store it in the session variable
    $row = $result->fetch_assoc();
    $_SESSION["email"] = $row["email"];
} else {
    echo "Email not found in the database.";
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        /* General Styles */
        *,
        *::before,
        *::after {
        box-sizing: border-box;
        -webkit-box-sizing: border-box;}
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #a3e4d7;
            padding: 10px;
            margin: 0;
        }

        .icon-bar {
            background-color: #333;
            overflow: hidden;
            position: fixed;
            top: 0;
            width: 100%;
        }

        .icon-bar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .icon-bar a:hover {
            background-color: #ddd;
            color: black;
        }

        .icon-bar i {
            float: left;
            font-size: 24px;
            margin-right: 16px;
        }

        /* Center the Icon Bar */
        .icon-bar {
            display: flex;
            justify-content: center;
        }

        /* Increase Space Between Icon Bar and Content Section */
        .content-section {
            margin-top: 120px; /* Adjust as needed */
        }

        /* Button Wrapper Styles */
        .button-wrapper {
            text-align: center;
            margin-top: 100px;
        }

        .button-wrapper a {
            display: inline-block;
            text-align: center;
            margin: 15px;
            text-decoration: none;
        }

        .button-wrapper img {
            cursor: pointer;
            width: 200px; /* Adjust the width as needed */
            height: 150px; /* Adjust the height as needed */
            border: 1px solid black;
        }

        .label {
            margin-top: 10px;
            color: black;
            border: 1px solid black;
        }

        ._container{
        max-width: 800px;
        background-color: #ffffff;
        padding: 20px;
        margin: 0 auto;
        border: 1px solid #cccccc;
        border-radius: 1px;
        margin-top: 120px
    }
    ._info{
        text-align: center;
    }
    ._info h1{
        margin:10px 0;
        text-transform: capitalize;
    }
    ._info p{
        color: #555555;
    }
    ._info a{
        display: inline-block;
        background-color: #E53E3E;
        color: #fff;
        text-decoration: none;
        padding:5px 10px;
        border-radius: 2px;
        border: 1px solid rgba(0, 0, 0, 0.1);
    }
    ._img > img{
        width: 100px;
        min-height: 100px;
    }
    </style>
</head>
<body>

    <div class="icon-bar">
        <a class="active" href="#home"><i class="fa fa-home"></i> Home</a>
        <a href="#about"><i class="fa fa-info-circle"></i> About</a>
        <a href="news.php"><i class="fa fa-newspaper-o"></i> News</a>
        <a href="#contact"><i class="fa fa-envelope"></i> Contact</a>
        <a href="orgzprofile.php"><i class="fa fa-user"></i> Profile</a>
        <a href="googlelogout.php"><i class="fa fa-sign-out"></i> Logout</a>
    </div>

    <!-- Content Section -->
    <div class="_container">
        <div class="_info">
            <h4 class="my-5">Hi, <b><?php echo isset($_SESSION["name"]) ? htmlspecialchars($_SESSION["name"]) : "User"; ?></b>. Welcome to our site.</h4>
            <p><?php echo isset($_SESSION["email"]) ? htmlspecialchars($_SESSION["email"]) : "Email"; ?></p>
        </div>
    </div>   
        
        <div class="button-wrapper">
            <!-- Clickable Image 1 -->
            <a href="events.php">
                <img src="event-volunteers.jpg" alt="Image 1">
                <div class="label">Add Events</div>
            </a>
            <!-- Clickable Image 2 -->
            <a href="orgzdonate.php">
                <img src="Donate.jpg" alt="Image 2">
                <div class="label">Donation</div>
            </a>
            <!-- Clickable Image 3 -->
            <a href="orgFeedback.php">
                <img src="feedback.png" alt="Image 3">
                <div class="label">Feedback</div>
            </a>
        </div>
    </div>

</body>
</html>
