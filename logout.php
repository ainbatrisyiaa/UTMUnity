<!--?php 
	session_start();
	unset($_SESSION["login_info"]);
	header("location:index2.php");
?>