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

$sql = "CREATE TABLE responses (
  id INT AUTO_INCREMENT PRIMARY KEY,
  event_id INT NOT NULL,
  question_id INT NOT NULL,
  response TEXT NOT NULL,
  FOREIGN KEY (event_id) REFERENCES events(id),
  FOREIGN KEY (question_id) REFERENCES questions(id)
)";

// $sql2 = "CREATE TABLE Questions (
//         id INT AUTO_INCREMENT PRIMARY KEY,
//         event_id INT NOT NULL,
//         question_text TEXT NOT NULL,
//         answer_format VARCHAR(50) NOT NULL,
//         options TEXT,
//         FOREIGN KEY (event_id) REFERENCES Events(id)
//     )";

if (mysqli_query($conn, $sql)) {
    echo "Tables Responses created successfully";
  } else {
    echo "Error creating Events table: " . mysqli_error($conn);
}

// if (mysqli_query($conn, $sql2)) {
//   echo "Tables Questions created successfully";
// } else {
//   echo "Error creating Questions table: " . mysqli_error($conn);
// }

mysqli_close($conn);
?>