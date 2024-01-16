<!-- add_event.php -->

<?php require "php/functions.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event</title>
    <!--link rel="stylesheet" href="styles.css"-->
	<link rel="stylesheet" href="styles1.css">
</head>
<body>

    <!--?php include "nav.php" ?-->
    <?php include "header.php" ?>

    <main>
        <!--div class="left">
            <!-- Your existing categories display code here -->
        <!--/div-->

        <div class="right">
            <div class="section-title">Add New Event</div>
            <form action="process_add_event.php" method="post" enctype="multipart/form-data">
                <div class="input-box">
                    <label>Title</label>
                    <input type="text" name="title" placeholder="Enter event title" required />
                </div>

                <!-- Other event details input fields go here -->

                <div class="input-box">
                    <label>Category</label>
                    <input type="text" name="category" placeholder="Enter event category" required />
                </div>

                <div class="input-box">
                    <label>Description</label>
                    <textarea name="description" placeholder="Enter event description" required></textarea>
                </div>

                <div class="input-box">
                    <label>Details</label>
                    <textarea name="details" placeholder="Enter event details" required></textarea>
                </div>

                <div class="input-box">
                    <label>Image</label>
                    <input type="file" name="image" accept="image/*" required />
                </div>
				
				 <div class="input-box">
					<label>Start Date</label>
					<input type="date" name="event_start_date" placeholder="Enter event start date" required />
				</div>

				<div class="input-box">
					<label>Start Time</label>
					<input type="time" name="event_start_time" placeholder="Enter event start time" required />
				</div>

				<div class="input-box">
					<label>End Date</label>
					<input type="date" name="event_end_date" placeholder="Enter event end date" required />
				</div>

				<div class="input-box">
					<label>End Time</label>
					<input type="time" name="event_end_time" placeholder="Enter event end time" required />
				</div>
				
                <button type="submit">Add Event</button>
            </form>
        </div>
    </main>

    <?php include "footer.php" ?>

    <script src="javascript/script.js"></script>

</body>
</html>
