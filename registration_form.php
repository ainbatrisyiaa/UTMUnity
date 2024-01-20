
<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Registration Form for Events</title>
		<link rel="stylesheet" href="style.css">
		
		<script>
			
			function showSuccessPopup() {
				alert('Registration Successful!');
				window.location.href = 'index1.php';
			}

  
			function handleSubmit(event) {
    
				event.preventDefault();

   
				showSuccessPopup();
			}
		</script>

	</head>
	
	<body>
	
	
		<section class="container">
			<header>Registration Form</head>
			<form action="process_form.php" method="post" class="form" onsubmit="handleSubmit(event)">
				<div class="input-box">
					<label>Full Name</label>
					<input type="text" name="full_name" placeholder="Enter full name" required />
				</div>
				
				<div class="input-box">
					<label>Email Address</label>
					<input type="text" name="email" placeholder="Enter email address" required />
				</div>
				
				<div class="column">
					<div class="input-box">
					<label>Phone Number</label>
					<input type="number" name="phone_number" placeholder="Enter phone number" required />
					</div>
				</div>
				
				

				
				<div class="participant-box">
					<label>Participant</label>
					<div class="participant-option">
						<div class="participant">
							<input type="radio" id="check-UTMStudent" name="participant_type"  value="UTM Student" checked />
							<label for="check-UTMStudent">UTM Student</label>
						</div>
						<div class="participant">
							<input type="radio" id="check-staff" name="participant_type" value="Staff"  />
							<label for="check-staff">Staff</label>
						</div>
						<div class="participant">
							<input type="radio" id="check-UTMVolunteerClub" name="participant_type" value="UTM Volunteer Club" />
							<label for="check-UTMVolunteerClub">UTM Volunteer Club</label>
						</div>
					</div>
				</div>
				
				<div class="input-box">
					<label>Student ID (for UTM students only) <br>
					*Put N/A if not applicable</label>
					<input type="text" name="student_id" placeholder="Enter ID" required />
				</div>
				
				<div class="input-box">
					<label>Staff ID (for UTM staffs only) <br>
					*Put N/A if not applicable</label>
					<input type="text" name="staff_id" placeholder="Enter ID" required />
				</div>
				
				<div class="input-box event_name">
    <label>Event Name</label>
    <div class="select-box">
        <select name="event_name">
            <option hidden>Event Name</option>

            <?php
            // Connect to your database (replace placeholders with your actual database credentials)
            $servername = "localhost";
            $username = "DevGenius";
            $password = "UTMUnity67";
            $dbname = "devgenius";

            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch events from the database
            $sql = "SELECT title FROM events_2";
            $result = $conn->query($sql);

            // Display events in dropdown
            while ($row = $result->fetch_assoc()) {
                echo "<option>" . $row['title'] . "</option>";
            }

            // Close the database connection
            $conn->close();
            ?>

        </select>
    </div>
</div>
				<div class="input-box">
					<label>Medical Information (Please specify any allergies or medical <br>
					conditions) <br>
					*Put N/A if not applicable</label>
					<input type="text" name="medical_info" placeholder="Enter medical information" required />
				</div>
				
				<button type="Submit">Submit</button>
			</form>
								
		</section>
		
	</body>
	
</html>