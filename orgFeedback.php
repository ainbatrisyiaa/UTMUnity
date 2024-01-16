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
            background-image: url("output-onlinepngtools.png");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            background-color: rgba(255, 255, 255, 0.3);
            color: #333; /* Set text color */
        }

        .event-card-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap; /* Allow wrapping to the next line on smaller screens */
            margin: 20px auto;
            max-width: 800px; /* Set a maximum width for the container */
        }

        .event-card {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 15px;
            margin: 10px;
            background-color: #fff;
            transition: transform 0.3s ease-in-out;
        }

        .event-card:hover {
            transform: scale(1.02);
        }

        .big-button {
            text-decoration: none;
            color: #333;
            display: block;
            transition: background-color 0.3s ease-in-out;
        }

        .big-button:hover {
            background-color: #f0f0f0;
        }

        h2 {
            color: #007BFF;
            margin-bottom: 10px;
        }

        p {
            margin: 0;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 50px;
            margin-bottom: 10px;
        }

        .intro-text {
            text-align: center;
            margin-bottom: 20px;
            margin-left: 100px;
            margin-right: 100px;
        }
    </style>
</head>
<body>

<div class="header">
    <a href="#default" class="logo">
        <img id="first-logo" src="utm-logo.png">
        <img id="second-logo" src="vol-club.png">
    </a>
    <div class="header-right">
        <a href="admin.php">Home</a>
        <a href="admin_page.php">Donate</a>
        <a href="orgFeedback.php">Feedback</a>
    </div>
</div>

<div class="intro-text">
    <h1>Volunteering Feedback</h1>
    <p>This feedback is valuable for organizations to enhance volunteer satisfaction, identify successful practices, and address any challenges, 
        ultimately fostering a more rewarding and effective volunteer environment.</p>
</div>

<div class="event-card-container">
    <a href="custom_form.php" class="big-button">
        <div class="event-card">
            <h2>Customize Form</h2>
            <p>Click here to customize the feedback form for this event.</p>
        </div>
    </a>

    <a href="fb_view.php" class="big-button">
        <div class="event-card">
            <h2>View Feedback</h2>
            <p>Click here to view feedback from participants of this event.</p>
        </div>
    </a>

    <a href="fb_analysis.php" class="big-button">
        <div class="event-card">
            <h2>Feedback Statistics</h2>
            <p>Click here to see statistics and analysis of feedback for this event.</p>
        </div>
    </a>
</div>
</body>
</html>
