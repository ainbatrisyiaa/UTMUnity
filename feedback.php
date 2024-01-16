<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="feedbackpage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="fb_style.css">
    <title>Your Feedback Page</title>
    <style>
        body {
            margin: 0;
            height: 100%;
            font-family: Arial, Helvetica, sans-serif;
            background-image: url("output-onlinepngtools.png"); /* Use url() to specify the background image */
            background-size: cover; /* Optional: Adjust the background size as needed */
            background-repeat: no-repeat; /* Optional: Specify whether the background image should repeat */
            background-position: center center;
            background-color: rgba(255, 255, 255, 0.3); /* Set the background color with opacity (0.5 for 50% opacity) */
        }
    </style>
</head>
<body>

<div class="header">
    <a href="#default" class="logo">
        <img id="first-logo" src="utm-logo.png" alt="UTM Logo">
        <img id="second-logo" src="vol-club.png" alt="Volunteer Club Logo">
    </a>
    <div class="header-right">
        <a href="welcome.php">About Us</a>
        <a href="index1.php">Get Involved</a>
        <a href="main_page.php">Donate</a>
        <a href="feedback.php">Feedback</a>
        <a href="studentgoogleprof.php"><i class="fas fa-user profile-icon"></i></a>
    </div>
</div>

<!-- Slideshow container -->
<div class="slideshow-container">
    <div class="mySlides fade">
        <div class="numbertext">1 / 3</div>
        <img src="img2.jpg" alt="Slide 1" class="slide-image">
        <div class="text">HarmonyQuest: Bridging Cultures Through Volunteering</div>
    </div>

    <div class="mySlides fade">
        <div class="numbertext">2 / 3</div>
        <img src="img3.jpeg" alt="Slide 2" class="slide-image">
        <div class="text">EcoCycle: Renewing Communities Through Recycling</div>
    </div>

    <div class="mySlides fade">
        <div class="numbertext">3 / 3</div>
        <img src="img4.jpg" alt="Slide 3" class="slide-image">
        <div class="text">Beach Cleanup Initiative</div>
    </div>

    <!-- Next and previous buttons -->
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>

<!-- The dots/circles -->
<div style="text-align:center">
    <span class="dot" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
    <span class="dot" onclick="currentSlide(3)"></span>
</div>

<div class="text-fb">
    <div class="text-fb" style="color: #333;">
        <h1>Volunteering Feedback</h1>
        <p>This feedback is valuable for organizations to enhance volunteer satisfaction, identify successful practices, and address any challenges, ultimately fostering a more rewarding and effective volunteer environment.</p>
    </div>
        <a href="view_form.php" class="feedback-button">Give Feedback</a>
</div>
<script src="slide.js"></script>
</body>
</html>
