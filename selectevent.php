<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Event Selection</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add your custom styles if needed -->
    <style>
        body {
            font: solid black;
            background-color: #a3e4d7;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100vh;
        }

        form {
            width: 100%;
            max-width: 500px;
            background-color: transparent; /* Set background color to transparent */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .form-group {
            margin-bottom: 10px; /* Adjust spacing between form elements */
        }

        .btn-primary {
            padding: 5px 10px; /* Adjust padding for a smaller button */
            font-size: 14px; /* Adjust font size if needed */
        }
    </style>
</head>
<body>
    <form action="orgzdonate.php" method="post">
        <h3 class="text-center">View Event Donation</h3>

        <div class="form-group">
            <label>Select an Event you want to view:</label>
            <select name="selected_event" class="form-control">
                <option value="select">Please select one</option>
                <option value="event1">Planting Tree is Fun</option>
                <!-- Add more options as needed -->
            </select>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Go">
        </div>
    </form>
</body>
</html>
