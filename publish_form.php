<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="feedbackpage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .notes{
            margin-left: 50px;
            margin-top: 30px;
            text-align: left;
            background-color: aliceblue;
        }

        body{
            background-color: aliceblue;
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

<div class="notes">

    <h1>Form Published Successfully!</h1>

    <p>Your form has been published. Thank you for your submission!</p>

    <?php
        // Assuming you have a function to sanitize and validate the identifier
        function validateFormIdentifier($identifier) {
            // Implement your validation logic here
            // For example, you might check if it starts with 'form_' or has a specific format
            return $identifier;
        }

        // Get the form identifier from the URL
        $formIdentifier = isset($_GET['form_id']) ? validateFormIdentifier($_GET['form_id']) : null;

        if ($formIdentifier) {
            // Assuming your website is hosted at http://example.com
            $formURL = "http://example.com/forms/$formIdentifier";

            // Display the form URL
            echo "Your form URL: <a href='$formURL'>$formURL</a>";
        } else {
            echo "Invalid form identifier.";
        }
    ?>

</div>
</div>
</body>
</html>