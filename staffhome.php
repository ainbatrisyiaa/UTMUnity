<?php
session_start();
require 'studentstaffdb.php';

$db_connection = mysqli_connect("localhost", "DevGenius", "UTMUnity67", "devgenius");
if (!$db_connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!isset($_SESSION['loggedin']))  {
    header('Location: main.php');
    exit;
}

$id = $_SESSION['loggedin'];
$get_user = mysqli_query($db_connection, "SELECT * FROM `google` WHERE `oauth_id`='$id'");

if (mysqli_num_rows($get_user) > 0) {
    $user = mysqli_fetch_assoc($get_user);
} else {
    header('Location: googlelogout.php');
    exit;
}
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
    *,
    *::before,
    *::after {
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
    }
    body{
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #a3e4d7;
        padding: 10px;
        margin: 0;
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
    .heading{
        text-align: center;
        color: #4d4d4d;
        text-transform: uppercase;
    }
    ._img{
        overflow: hidden;
        width: 100px;
        height: 100px;
        margin: 0 auto;
        border-radius: 50%;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    ._img > img{
        width: 100px;
        min-height: 100px;
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
    </style>
</head>
</head>
<body>


<div class="_container">
    <?php if (isset($user['name'], $user['email'])): ?>
        <div class="_info">
            <h4>Hi, <b><?php echo $user['name']; ?></b>. Welcome to our site.</h4>
            <p><?php echo $user['email']; ?></p>
        </div>
    <?php else: ?>
        <p>Error: User data not available.</p>
    <?php endif; ?>
</div>

<div class="icon-bar">
<a class="active" href="#home"><i class="fa fa-home"></i> Home</a>
        <a href="#about"><i class="fa fa-info-circle"></i> About</a>
        <a href="news.php"><i class="fa fa-newspaper-o"></i> News</a>
        <a href="#contact"><i class="fa fa-envelope"></i> Contact</a>
        <a href="staffgoogleprof.php"><i class="fa fa-user"></i> Profile</a>
        <a href="googlelogout.php"><i class="fa fa-sign-out"></i> Logout</a>
</div>

<!-- Content Section -->
<div class="content-section">
    <div class="button-wrapper">
            <!-- Clickable Image 1 -->
            <a href="events.php">
                <img src="event-volunteers.jpg" alt="Image 1">
                <div class="label">Events</div>
            </a>
            <!-- Clickable Image 2 -->
            <a href="main_page.php">
                <img src="Donate.jpg" alt="Image 2">
                <div class="label">Donation</div>
            </a>
            <!-- Clickable Image 3 -->
            <a href="feedback.php">
                <img src="feedback.png" alt="Image 3">
                <div class="label">Feedback</div>
            </a>
        </div>
</div>

</body>
</html>
