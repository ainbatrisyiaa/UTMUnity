<?php
$servername = "localhost";
$username = "DevGenius";
$password = "UTMUnity67";
$dbname = "devgenius";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Select database
mysqli_select_db($conn, $dbname);

$sql = "CREATE TABLE forms (
  id INT AUTO_INCREMENT PRIMARY KEY,
  event_id INT NOT NULL,
  organizer VARCHAR(255),
  open_date DATE,
  open_time TIME,
  close_date DATE,
  close_time TIME,
  FOREIGN KEY (event_id) REFERENCES events_2(id)
)";

$sql1 = "CREATE TABLE questions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  form_id INT NOT NULL,
  event_id INT NOT NULL,
  question_text TEXT NOT NULL,
  answer_format VARCHAR(50) NOT NULL,
  options TEXT,
  FOREIGN KEY (form_id) REFERENCES forms(id),
  FOREIGN KEY (event_id) REFERENCES events_2(id)
)";

$sql2 = "CREATE TABLE responses (
  id INT AUTO_INCREMENT PRIMARY KEY,
  form_id INT NOT NULL,
  question_id INT NOT NULL,
  event_id INT NOT NULL,
  response TEXT NOT NULL,
  FOREIGN KEY (form_id) REFERENCES forms(id),
  FOREIGN KEY (question_id) REFERENCES questions(id),
  FOREIGN KEY (event_id) REFERENCES events_2(id)
)";

if (mysqli_query($conn, $sql)) {
    echo "Tables Forms created successfully";
  } else {
    echo "Error creating Forms table: " . mysqli_error($conn);
}

if (mysqli_query($conn, $sql1)) {
  echo "Tables Questions created successfully";
} else {
  echo "Error creating Questions table: " . mysqli_error($conn);
}

if (mysqli_query($conn, $sql2)) {
  echo "Tables Responses created successfully";
} else {
  echo "Error creating Responses table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>