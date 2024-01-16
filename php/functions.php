<?php

	require "config.php";
	
	function dbConnect(){
		$mysqli = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
		IF($mysqli->connect_errno != 0){
			return FALSE;
		}else{
			return $mysqli;
		}
	}
	
	function getCategories(){
		$mysqli = dbConnect();
		$result = $mysqli->query("SELECT DISTINCT category FROM events_2");
		while($row = $result->fetch_assoc()){
			$categories[] = $row;
		}
		return $categories;
	}
	
	function getHomePageEvents($int){
		$mysqli = dbConnect();
		$result = $mysqli->query("SELECT * FROM events_2 ORDER BY rand() LIMIT $int");
		while($row = $result->fetch_assoc()){
			$data[] = $row;
		}
		return $data;
	}
	
	function getEventsByCategory($category){
		$mysqli = dbConnect();
		
		$stmt = $mysqli->prepare("SELECT * FROM events_2 WHERE category = ?"); 
		$stmt->bind_param("s", $category);
		$stmt->execute();
		$result = $stmt->get_result();
		$data = $result->fetch_all(MYSQLI_ASSOC);
		return $data;
	}
	
	function getEventByTitle($title){
		$mysqli = dbConnect();
		
		$stmt = $mysqli->prepare("SELECT * FROM events_2 WHERE title = ?");
		$stmt->bind_param("s", $title);
		$stmt->execute();
		$result = $stmt->get_result();
		$data = $result->fetch_all(MYSQLI_ASSOC);
		return $data;
	}
	
	// functions.php

	function addEvent($title, $category, $description, $details, $image)
	{
		$mysqli = dbConnect();
    
		$stmt = $mysqli->prepare("INSERT INTO events_2 (title, category, description, details, image) VALUES (?, ?, ?, ?, ?)");
		$stmt->bind_param("sssss", $title, $category, $description, $details, $image);
    
		return $stmt->execute();
	}

	function addEventToCalendar($title, $start_date, $start_time, $end_date, $end_time)
{
    $mysqli = dbConnect();

    $stmt = $mysqli->prepare("INSERT INTO calendar_event_master (event_name, event_start_date, event_start_time, event_end_date, event_end_time) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $title, $start_date, $start_time, $end_date, $end_time);

    return $stmt->execute();
}
