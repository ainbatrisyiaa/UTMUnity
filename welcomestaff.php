<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to the login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: googlelogin.php");
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
        /* General Styles */
        body {
            font: 14px sans-serif;
            text-align: center;
            background-color: #a3e4d7;
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
<body>

    <div class="icon-bar">
       <h5>Staff</h5>
        <a class="active" href="#home"><i class="fa fa-home"></i> Home</a>
        <a href="#about"><i class="fa fa-info-circle"></i> About</a>
        <a href="news.php"><i class="fa fa-newspaper-o"></i> News</a>
        <a href="#contact"><i class="fa fa-envelope"></i> Contact</a>
        <a href="staffprofile.php"><i class="fa fa-user"></i> Profile</a>
        <a href="reset-password.php"><i class="fa fa-key"></i> Reset Password</a>
        <a href="googlelogout.php"><i class="fa fa-sign-out"></i> Logout</a>
    </div>
    
    <!-- Content Section -->
    <div class="content-section">
    
        <h1 class="my-5">Hi, <b><?php echo isset($_SESSION["name"]) ? htmlspecialchars($_SESSION["name"]) : "User"; ?></b>. Welcome to our site.</h1>
        
        <div class="button-wrapper">
            <!-- Clickable Image 1 -->
            <a href="index1.php">
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
