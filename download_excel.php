<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';

// Include PhpSpreadsheet classes
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

//var_dump($feedbackData);
//var_dump($questionOptionsMap);

// Retrieve feedback data and question options from session
session_start();
if (isset($_SESSION['feedbackData'], $_SESSION['questionOptionsMap'])) {
    $feedbackData = $_SESSION['feedbackData'];
    $questionOptionsMap = $_SESSION['questionOptionsMap'];

    downloadExcel($feedbackData, $questionOptionsMap);
} else {
    echo "Error: Missing feedback data or question options map.<br>";
}

// Function to download responses as an Excel file
function downloadExcel($feedbackData, $questionOptionsMap) {
    // Create a new PhpSpreadsheet instance
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Add headers
    $sheet->setCellValue('A1', 'Question');
    $sheet->setCellValue('B1', 'Options');
    $sheet->setCellValue('C1', 'Responses');

    // Iterate through questions and responses
    $row = 2;
    foreach ($feedbackData['questions'] as $question) {
        $questionId = $question['id'];
        $questionText = $question['question_text'];
        $questionOptions = $questionOptionsMap[$questionId];
        $responses = $feedbackData['responses'][$questionId];

        // Add data to the Excel sheet
        $sheet->setCellValue('A' . $row, $questionText);
        $sheet->setCellValue('B' . $row, implode(', ', $questionOptions));
        $sheet->setCellValue('C' . $row, implode(', ', $responses));

        $row++;
    }

    // Create a temporary file to store the Excel data
    $tempFilePath = tempnam(sys_get_temp_dir(), 'feedback_report');
    $writer = new Xlsx($spreadsheet);
    $writer->save($tempFilePath);

    // Check if the file is successfully created
    if (!file_exists($tempFilePath)) {
        // Handle the error appropriately (e.g., log, show a user-friendly message)
        echo "Error: Excel file creation failed.<br>";
        exit;
    }

    // Set headers for file download
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="feedback_report.xlsx"');
    header('Cache-Control: max-age=0');
    header('Content-Length: ' . filesize($tempFilePath));

    // Output the Excel file to the browser
    ob_start();
    if (readfile($tempFilePath) !== false) {
        ob_clean();
    } else {
        ob_end_clean();
        echo "Error: Failed to send Excel file to the browser.<br>";
    }

    // Delete the temporary file
    if (unlink($tempFilePath)) {
        echo "Temporary file successfully deleted.<br>";
    } else {
        echo "Error: Failed to delete the temporary file.<br>";
    }

    // Stop script execution
    exit;
}
?>
