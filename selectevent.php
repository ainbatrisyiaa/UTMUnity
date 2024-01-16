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
    <form id="eventForm">
        <h3 class="text-center">View Event Donation</h3>

        <div class="form-group">
            <label>Select an Event you want to view:</label>
            <select id="selectedEvent" class="form-control">
                <option value="" selected disabled>Select one</option>
                <option value="event1">Planting Tree is Fun</option>
                <option value="event2">Beach Cleanup Initiative</option>
                <!-- Add more options as needed -->
            </select>
        </div>

        <div class="form-group">
            <input type="button" class="btn btn-primary" value="Go" onclick="redirectToEvent()">
        </div>
    </form>

    <script>
        function redirectToEvent() {
            // Get the selected event value
            var selectedEvent = document.getElementById("selectedEvent").value;

            // Check if an event is selected
            if (selectedEvent === "") {
                // Display an error message if no event is selected
                alert("Please select an event before clicking Go.");
            } else {
                // Define mappings of events to their respective pages
                var eventPages = {
                    "event1": "orgzdonate.php",
                    "event2": "orgzdonate2.php"
                    // Add more mappings as needed
                };

                // Check if the selected event exists in the mappings
                if (eventPages[selectedEvent]) {
                    // Redirect to the selected event page
                    window.location.href = eventPages[selectedEvent];
                } else {
                    // Display an error message if the selected event is invalid
                    alert("Please select a valid event.");
                }
            }
        }
    </script>
</body>
</html>
