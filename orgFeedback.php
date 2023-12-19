<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="feedbackpage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Add your CSS styles here or link to an external stylesheet */
        .content2 {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
        }

        /* Add your CSS styles here or link to an external stylesheet */
        .big-button {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .big-button:hover {
            background-color: #f0f0f0; /* Add a hover effect if needed */
        }

        .event-card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
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
    <a href="#about">About Us</a>
        <a href="#getIn">Get Involved</a>
        <a href="#donate">Donate</a>
        <a href="#contact">Contact</a>
        <i class="fas fa-user profile-icon"></i> <!-- Font Awesome user icon -->
    </div>
</div>

<div class="content">
    <a href="default" class="image">
        <img id="image" src="feedback.png">
    </a>

    <div class="text-overlay">
        <h1>Volunteering Feedback</h1>
        <p>This feedback is valuable for organizations to enhance volunteer satisfaction, identify successful practices, and address any challenges, 
            ultimately fostering a more rewarding and effective volunteer environment.</p>
    </div>
</div>

<div class="content2">
<h2>Latest Event</h2>
<p>Your feedback is important to us. Please share your thoughts and suggestions.</p>

<div class="event-cards-container">
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

    <a href="analysis.php" class="big-button">
        <div class="event-card">
            <h2>Feedback Statistics</h2>
            <p>Click here to see statistics and analysis of feedback for this event.</p>
        </div>
    </a>
</div>
    
    <!-- Worldwide Review Section -->
    <div class="worldwide-review">
        <h2>Worldwide Reviews</h2>
        <div class="event-cards-container">
            <div class="event-card">
                <h2>Review 1</h2>
                <p>Description of Review 1</p>
            </div>

            <div class="event-card">
                <h2>Review 2</h2>
                <p>Description of Review 2</p>
            </div>

            <div class="event-card">
                <h2>Review 3</h2>
                <p>Description of Review 3</p>
            </div>
        </div>
    </div>
</div>

</body>
</html>
