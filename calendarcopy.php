<!DOCTYPE html>

<html lang="en">

<head>

	<meta charset="UTF-8">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<meta name="description" content="UTM Unity Volunteer & Serve provides volunteer and service opportunities at University Technology Malaysia (UTM)">
	
	<meta name="keywords" content="voluteer and service">
	
	<link rel="stylesheet" href="styles.css">
	
	<title> Volunteering Events </title>
	
	<style>
	
		footer{
			position: fixed;
			bottom: 0;
		}
		
	</style>
	
</head>

<body>

	<?php include "nav.php" ?>
	<?php include "header.php" ?>
	
	
	
	<main>
	
		<h2>Calendar</h2>
		

    <table id="event-calendar">
        <thead>
            <tr>
                <th>Event Name</th>
                <th>Date</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <!-- Calendar events will be dynamically added here -->
        </tbody>
    </table>

    <script>
        // Sample events data
        var events = [
            { name: 'Volunteer Event 1', date: '2023-12-01', description: 'Description for Event 1' },
            { name: 'Volunteer Event 2', date: '2023-12-15', description: 'Description for Event 2' },
            // Add more events as needed
        ];

        // Function to dynamically generate the event calendar in table format
        function generateEventCalendar() {
            var calendarTable = document.getElementById('event-calendar').getElementsByTagName('tbody')[0];

            // Clear any existing content in the calendar
            calendarTable.innerHTML = '';

            // Loop through the events and create table rows for each
            events.forEach(function (event) {
                var eventDate = new Date(event.date);
                var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                var formattedDate = eventDate.toLocaleDateString('en-US', options);

                var row = calendarTable.insertRow();
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);

                cell1.innerHTML = event.name;
                cell2.innerHTML = formattedDate;
                cell3.innerHTML = event.description;
            });
        }

        // Call the function to generate the calendar when the page loads
        generateEventCalendar();
    </script>
</main>

	
	<?php include "footer.php" ?>

	<script src="javascript/script.js"></script>

</body>
</html>
	