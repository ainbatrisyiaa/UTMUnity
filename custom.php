<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formConfig = array(
        'title' => $_POST['title'],
        'event_details' => $_POST['event_details'],
        'questions' => array()
    );

    // Loop through posted questions and types
    foreach ($_POST['question'] as $key => $question) {
        $type = $_POST['type'][$key];
        $options = isset($_POST['options'][$key]) ? $_POST['options'][$key] : array();

        $formConfig['questions'][] = array(
            'question' => $question,
            'type' => $type,
            'options' => $options
        );
    }

    $_SESSION['formConfig'] = $formConfig;
    header("Location: custom_form.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="feedbackpage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form Builder</title>
</head>
<body>

<div class="header">
    <a href="#default" class="logo">
        <img id="first-logo" src="utm-logo.png">
        <img id="second-logo" src="vol-club.png">
    </a>
    <div class="header-right">
    <a href="#about">About Us</a>
        <a href="#getIn">Get Involved</a>
        <a href="#donate">Donate</a>
        <a href="#contact">Contact</a>
        <i class="fas fa-user profile-icon"></i> <!-- Font Awesome user icon -->
    </div>
</div>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="title">Form Title:</label>
    <input type="text" name="title" required><br>

    <label for="event_details">Event Details:</label>
    <textarea name="event_details" rows="4" required></textarea><br>

    <label for="questions">Add Questions:</label><br>
    <div id="questions">
        <input type="text" name="question[]" required>
        <select name="type[]">
            <option value="text">Text</option>
            <option value="radio">Radio</option>
            <option value="checkbox">Checkbox</option>
            <!-- Add more types as needed -->
        </select>

        <!-- Allow organizers to input options for radio buttons -->
        <input type="text" name="options[0][]" placeholder="Option 1">
        <input type="text" name="options[0][]" placeholder="Option 2">
        <!-- Add more options input fields as needed -->

        <br>
    </div>

    <button type="button" onclick="addQuestion()">Add Question</button><br>

    <input type="submit" value="Create Form">
</form>

<script>
    // Add this function to show options for the initial question when the page loads
    document.addEventListener("DOMContentLoaded", function () {
        var initialSelect = document.querySelector('select[name="type[]"]');
        showOptions(initialSelect);
    });

    function addQuestion() {
        var questionsDiv = document.getElementById("questions");
        var newQuestion = document.createElement("div");

        newQuestion.innerHTML =
            '<input type="text" name="question[]" required>' +
            '<select name="type[]" onchange="showOptions(this)">' +
            '<option value="text">Text</option>' +
            '<option value="radio">Radio</option>' +
            '<option value="checkbox">Checkbox</option>' +
            '</select>' +
            '<div class="options" style="display: none;">' +
            '<input type="text" name="options[' + (questionsDiv.childElementCount) + '][]" placeholder="Option 1">' +
            '<input type="text" name="options[' + (questionsDiv.childElementCount) + '][]" placeholder="Option 2">' +
            '</div>' +
            '<br>';

        questionsDiv.appendChild(newQuestion);
    }

    function showOptions(selectElement) {
        var optionsDiv = selectElement.nextElementSibling;
        if (selectElement.value === 'radio' || selectElement.value === 'checkbox') {
            optionsDiv.style.display = 'block';
        } else {
            optionsDiv.style.display = 'none';
        }
    }
</script>

</body>
</html>
