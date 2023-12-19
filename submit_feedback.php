<?php
session_start();

if (empty($_SESSION['formConfig'])) {
    header("Location: custom.php");
    exit();
}

$formConfig = $_SESSION['formConfig'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $responses = array();

    foreach ($formConfig['questions'] as $key => $question) {
        $responses[] = $_POST['response' . $key];
    }

    // Process responses as needed (save to database, etc.)

    // Clear session data
    unset($_SESSION['formConfig']);

    echo "Feedback submitted successfully";
} else {
    header("Location: custom.php");
    exit();
}
?>
