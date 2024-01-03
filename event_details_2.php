<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #a3e4d7;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            overflow: hidden;
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            border-radius: 10px 10px 0 0;
        }

        .event-details {
            margin: 20px;
            padding: 20px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .event img {
            max-width: 70%; /* Set the maximum width to 70% */
            height: auto; /* Maintain the aspect ratio */
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .event-name {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .donate-button {
            margin: 20px;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
    <header>
        <h2>Charity</h2>
    </header>

    <!-- Event Details -->
    <div class="event-details">
        <div class="event">
            <img src="poor.png" alt="Event B">
            <div class="event-name">Meet The Poor</div>
        </div>
        
        <p>Meet Poor People Campaign is not just an initiative; it is a heartfelt endeavor to break down barriers, challenge stereotypes, and foster genuine connections. Through genuine human encounters and shared stories, we aim to unveil the resilience, strength, and beauty that exist in every individual, regardless of their economic circumstances.</p>
    </div>

    <!-- Donate Now Button -->
    <button class="donate-button" onclick="redirectToDonation('Event Title')">Donate Now</button>

</div>

<script>
    // JavaScript function to redirect to donation_page.php with selected event
    function redirectToDonation(eventName) {
        window.location.href = 'Donationdetails_2.php?event=' + encodeURIComponent(eventName);
    }
</script>

</body>
</html>

=======
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #a3e4d7;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            overflow: hidden;
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            border-radius: 10px 10px 0 0;
        }

        .event-details {
            margin: 20px;
            padding: 20px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .event img {
            max-width: 70%; /* Set the maximum width to 70% */
            height: auto; /* Maintain the aspect ratio */
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .event-name {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .donate-button {
            margin: 20px;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
    <header>
        <h2>Charity</h2>
    </header>

    <!-- Event Details -->
    <div class="event-details">
        <div class="event">
            <img src="poor.png" alt="Event B">
            <div class="event-name">Meet The Poor</div>
        </div>
        
        <p>Meet Poor People Campaign is not just an initiative; it is a heartfelt endeavor to break down barriers, challenge stereotypes, and foster genuine connections. Through genuine human encounters and shared stories, we aim to unveil the resilience, strength, and beauty that exist in every individual, regardless of their economic circumstances.</p>
    </div>

    <!-- Donate Now Button -->
    <button class="donate-button" onclick="redirectToDonation('Event Title')">Donate Now</button>

</div>

<script>
    // JavaScript function to redirect to donation_page.php with selected event
    function redirectToDonation(eventName) {
        window.location.href = 'Donationdetails_2.php?event=' + encodeURIComponent(eventName);
    }
</script>

</body>
</html>

>>>>>>> origin/ainbatrisyiaa/devgenius
