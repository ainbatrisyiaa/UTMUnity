<?php
//session_start();
	require("configuration.php");
	
	/*if(!isset($_SESSION["login_info"])){
		header("location:index2.php");
	}*/

$reminders = [];
$current_datetime = date("Y-m-d H:i:s");

# Select upcoming reminders
$sql = "SELECT * FROM reminders WHERE CONCAT(event_date, ' ', event_time) > '{$current_datetime}'";
$res = $con->query($sql);

if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        $reminders[] = $row;
    }
}

# Send reminders via email
foreach ($reminders as $reminder) {
    $to = 'jelizajustine@graduate.utm.my'; // Replace with the actual recipient email address
    $subject = "Upcoming Event Reminder";
    $message = "<h3>Reminder for Event: {$reminder["event_name"]}</h3>";
    $message .= "<p>Date: {$reminder["event_date"]}</p>";
    $message .= "<p>Time: {$reminder["event_time"]}</p>";
    $header = "From: jelizajustine@graduate.utm.my" . "\r\n";
    $header .= "X-Mailer: PHP/" . phpversion() . "\r\n";
    $header .= "Content-type: text/html; charset=iso-8859-1";

    $response = mail($to, $subject, $message, $header);

    if ($response == true) {
        // Update the reminder status, e.g., mark it as sent
        $sql = "UPDATE reminders SET status = 'sent' WHERE ID = '{$reminder["ID"]}'";
        $con->query($sql);
    } else {
        echo "Mail send failed for event: {$reminder["event_name"]}";
    }
}

$notifications = []; // Define $notifications as an empty array

?>

<!DOCTYPE html>
<html lang="en">
    <?php include "header1.php";?>
    <body>
        <?php include "navbar.php"; ?>
        <div class='container mt-4'>
            <div class='row'>
                <div class='col-md-4'>
                    <?php foreach ($notifications as $row):?>
                      <div class="alert alert-primary mb-3 pt-4 pb-4" href="#"><?php echo $row; ?></div>
                    <?php endforeach;?>
                </div>
                <div class='col-md-8'>
                    <div class="jumbotron">
                        <h1 class="display-4">Event Reminder</h1>
                        <hr class="my-4">
                        <p class="lead">Welcome to UTM Unity - Volunteer & Serve website. Stay tuned to our upcoming events. </p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>