<?php 
	function number_suffix($number){
		$ends = array('th','st','nd','rd','th','th','th','th','th','th');
		 if ((($number % 100) >= 11) && (($number%100) <= 13)){
			return $number. 'th';
		 }else{
			return $number.$ends[$number % 10];
		 }
	}
	
	$notifications = [];
	$current_datetime = date("Y-m-d H:i:s");
	$sql = "SELECT * FROM reminders WHERE CONCAT(event_date, ' ', event_time) > '{$current_datetime}'";
	$res = $con->query($sql);

	if ($res->num_rows > 0) {
		while ($row = $res->fetch_assoc()) {
			$notifications[] = "<i class='fa fa-bell'></i> Upcoming Event: <b>{$row["event_name"]}</b><br>Date: <b>{$row["event_date"]}</b>, Time: <b>{$row["event_time"]}</b>";
		}
	}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand" href="notification.php">Volunteering Events Reminder</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav ml-auto">
			<li class="nav-item">
				<a class="nav-link" href="notification.php"><span class='fa fa-home'></span> Home</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="add_reminder.php"><span class='fa fa-plus'></span> Add Reminder</a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					<span class='fa fa-bell'></span>(<?php echo count($notifications);?>)
				</a>
				<?php if(count($notifications)>0): ?>
					<div class="dropdown-menu dropdown-menu-right p-2" aria-labelledby="navbarDropdown">
						<?php foreach($notifications as $row):?>
							<a class="dropdown-item pt-3 pb-3 alert alert-success" href="#"><?php echo $row; ?></a>
						<?php endforeach;?>
					</div>
				<?php endif; ?>
			</li>
		</ul>
	</div>
</nav>
