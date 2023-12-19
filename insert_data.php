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

$insertDataQuery = "INSERT INTO $eventTableName (open_date, open_time, close_date, close_time, your_name, ";

// Add columns for each question
foreach ($questions as $i => $question) {
    $answerFormat = $answerFormats[$i];
    $columnName = "question_" . ($i + 1);

    if ($answerFormat === "text") {
        $insertDataQuery .= "$columnName, ";
    } elseif ($answerFormat === "radio" || $answerFormat === "checkbox") {
        // Add columns for each option
        $optionsArray = explode(",", $options[$i]);
        foreach ($optionsArray as $option) {
            $optionColumnName = "${columnName}_$option";
            $insertDataQuery .= "$optionColumnName, ";
        }
    }
}

$insertDataQuery .= "created_at) VALUES ('$openDate', '$openTime', '$closeDate', '$closeTime', '$yourName', ";

// Add values for each question
foreach ($questions as $i => $question) {
    $answerFormat = $answerFormats[$i];
    $columnName = "question_" . ($i + 1);

    if ($answerFormat === "text") {
        $insertDataQuery .= "'${_POST["text_answers"][$i]}", ";
    } elseif ($answerFormat === "radio" || $answerFormat === "checkbox") {
        // Add values for each option
        $optionsArray = explode(",", $options[$i]);
        foreach ($optionsArray as $option) {
            $optionColumnName = "${columnName}_$option";
            $insertDataQuery .= isset($_POST["${answerFormat}_answers"][$i][$option]) ? '1' : '0';
            $insertDataQuery .= ", ";
        }
    }
}

}


$insertDataQuery .= "NOW())";

if ($conn->query($insertDataQuery) === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error inserting data: " . $conn->error;
}