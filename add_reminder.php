<?php
require("configuration.php");

/*session_start();
	require("configuration.php");
	
	if(!isset($_SESSION["login_info"])){
		header("location:index2.php");
	} */
?>

<!DOCTYPE html>
<html lang="en">
    <?php include "header1.php";?>
    <body>
        <?php include "navbar.php"; ?>
        <div class='container mt-4'>
            <div class='row'>
                <div class='col-md-4'>
                    <h3 class='text-muted text-center'>ADD REMINDER</h3>
                    <?php 
                        if(isset($_POST["add_reminder"])){
                            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                            $event_name = mysqli_real_escape_string($con, $_POST["event_name"]);
                            $event_date = date("Y-m-d", strtotime($_POST["event_date"]));
                            $event_time = $_POST["event_time"];
                            
                            $sql = "INSERT INTO reminders (event_name, event_date, event_time) VALUES ('{$event_name}', '{$event_date}', '{$event_time}')";
                            if($con->query($sql)){
                                echo "<div class='alert alert-success'>Reminder Added Successfully</div>";
                            } else {
                                echo "<div class='alert alert-danger'>Failed to Add Reminder. Please Try Again.</div>";
                            }
                        }
                    ?>
                    <form action='add_reminder.php' method='post' autocomplete='off'>
                        <div class="form-group">
                            <label>Event Name</label>
                            <input type="text" class="form-control" name='event_name' placeholder="Event Name" required>
                        </div>
                        <div class="form-group">
                            <label>Event Date</label>
                            <input type="date" class="form-control" name='event_date' required>
                        </div>
                        <div class="form-group">
                            <label>Event Time</label>
                            <input type="time" class="form-control" name='event_time' required>
                        </div>
                        <div class="form-group">
                            <input type='submit' name='add_reminder' value='Add Reminder' class='btn btn-primary'>
                        </div>
                    </form>
                </div>
                <div class='col-md-8'>
                    <table class='table table-bordered mt-5'>
                        <thead>
                            <tr>
                                <td>S.No</td>
                                <td>Event Name</td>
                                <td>Event Date</td>
                                <td>Event Time</td>
                                <td>Delete</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $sql = "SELECT * FROM reminders ORDER BY ID DESC";
                                $res = $con->query($sql);
                                if($res->num_rows > 0){
                                    $i = 0;
                                    while($row = $res->fetch_assoc()){
                                        $i++;
                                        echo "
                                        <tr>
                                            <td>{$i}</td>
                                            <td>{$row["event_name"]}</td>
                                            <td>{$row["event_date"]}</td>
                                            <td>{$row["event_time"]}</td>
                                            <td><a href='delete_reminder.php?id={$row["ID"]}' class='btn btn-sm btn-danger' onclick='return confirm(\"Are You Sure ?\")'>Delete</a></td>
                                        </tr>";
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
