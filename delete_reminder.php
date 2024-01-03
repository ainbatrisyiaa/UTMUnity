 <!--?php 
	session_start();
	require("configuration.php");
	
	if(!isset($_SESSION["login_info"])){
		header("location:index2.php");
	}
	$sql="delete from reminders where ID='{$_GET["id"]}'";
	if($con->query($sql)){
		header("location:add_reminder.php");
	}
?> 

<?php
require("configuration.php");

// Remove session_start() and session check

if(isset($_GET["id"])){
    $sql = "DELETE FROM reminders WHERE ID = '{$_GET["id"]}'";
    if($con->query($sql)){
        header("location:add_reminder.php");
    } else {
        echo "Error deleting reminder: " . $con->error;
    }
} else {
    echo "Invalid request";
}
?>
