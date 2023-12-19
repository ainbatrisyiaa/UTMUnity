<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Page</title>
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

        .event {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
            cursor: pointer;
        }

        .event img {
            max-width: 70%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <header>
        <h1>Charity</h1>
    </header>

    <!-- Events List -->
    <div class="event" onclick="redirectToEvent('event_details.php')">
        <img src="animals.png" alt="Event A">
        <h2>Guardians of the Wild: Save Animals Life</h2>
    </div>

    <div class="event" onclick="redirectToEvent('event_details2.php')">
        <img src="poor.png" alt="Event B">
        <h2>Hearts United: Meet Poor People</h2>
    </div>

    <div class="event" onclick="redirectToEvent('event_details3.php')">
        <img src="tree.jpg" alt="Event C">
        <h2>Roots of Change: The Tree Planting Movement</h2>
    </div>

</div>

<script>
    // JavaScript function to redirect to individual event pages
    function redirectToEvent(eventPage) {
        window.location.href = eventPage;
    }
</script>

</body>
</html>


