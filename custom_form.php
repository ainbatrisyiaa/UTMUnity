<!DOCTYPE HTML>
<html lang="en">

<head>
    <link rel="stylesheet" href="feedbackpage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Form</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="text"],
        select,
        button,
        input[type="date"],
        input[type="time"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        .optionsInput {
            display: none;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 4px;
        }

        .button2 {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 4px;
            align-self: flex-end;
            margin-top: 10px; /* Add some margin for spacing */
            margin-left: auto; /* Align to the right */
        }

        button:hover {
            background-color: #45a049;
        }

        p {
            margin-top: 0;
        }

        .questionSection {
            width: 100%;
            margin-bottom: 20px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }

        h1 {
            text-align: center;
        }

        /* Style for open and close date/time fields */
        label[for="open_date"],
        label[for="close_date"],
        label[for="open_time"],
        label[for="close_time"] {
            display: inline-block;
            width: 48%;
            margin-bottom: 10px;
        }

        input[name="open_date"],
        input[name="close_date"],
        input[name="open_time"],
        input[name="close_time"] {
            display: inline-block;
            width: 48%;
            box-sizing: border-box;
            padding: 8px;
            margin-bottom: 10px;
            margin-right: 4%;
        }

        /* Additional style for date and time labels */
        label[for="open_date"],
        label[for="close_date"],
        label[for="open_time"],
        label[for="close_time"] {
            font-weight: bold;
        }
    </style>
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

    <form action="insert_quest.php" method="post" id="myForm">
        <div id="questionsContainer">
            <!-- Initial question section -->

            <!-- Add open and close date/time fields -->
            <label>Open Date:</label>
            <input type="date" name="open_date" required>
            <label>Open Time:</label>
            <input type="time" name="open_time" required>

            <label>Close Date:</label>
            <input type="date" name="close_date" required>
            <label>Close Time:</label>
            <input type="time" name="close_time" required>
            <!-- End of open and close date/time fields -->

            <h1>Feedback Form</h1>

            <label>EVENT NAME:</label>
                <select name="event_name" id="event_id" required>
                    <?php
                    // Assuming you have a database connection established
                    $conn = mysqli_connect("localhost", "DevGenius", "UTMUnity67", "devgenius");

                    // Fetch events for the dropdown
                    $eventsQuery = "SELECT id, title FROM events_2";
                    $eventsResult = mysqli_query($conn, $eventsQuery);

                    if (!$eventsResult) {
                        die("Error fetching events: " . mysqli_error($conn));
                    }

                    // Check if any events are retrieved
                    if (mysqli_num_rows($eventsResult) > 0) {
                        while ($eventRow = mysqli_fetch_assoc($eventsResult)) {
                            $eventId = $eventRow['id'];
                            $eventName = $eventRow['title'];
                            echo "<option value='$eventName'>$eventName</option>";
                        }
                    } else {
                        echo "<option value='' disabled selected>No events available</option>";
                    }

                    // Close the database connection
                    mysqli_close($conn);
                    ?>
                </select>
            <label>ORGANIZER:</label>
            <input type='text' name='organizer'><br>

            <h2>Feedback Questions :</h2>
            <div class="questionSection">
                <label for="question">Question:</label>
                <input type="text" name="questions[]">

                <label for="answer_format">Select Answer Format:</label>
                <select class="answer_format" name="answer_formats[]" onchange="showOptionsInput(this)">
                    <option value="text">Text</option>
                    <option value="radio">Radio Button</option>
                    <option value="checkbox">Checkbox</option>
                </select>

                <div class="optionsInput">
                    <label for="options">Enter options (comma-separated):</label>
                    <input type='text' name='options[]'>
                </div>
            </div>
        </div>

        <button type="button" onclick="addQuestion()">Add Question</button><br><br>

        <input type="submit" class="button2" value="Publish Form">
    </form>

    <script>
        function addQuestion() {
            var questionsContainer = document.getElementById('questionsContainer');
            var questionSection = document.getElementsByClassName('questionSection')[0].cloneNode(true);

            // Clear the selected option in the cloned answer format dropdown
            questionSection.getElementsByClassName('answer_format')[0].selectedIndex = 0;

            // Hide options input for the cloned question
            questionSection.getElementsByClassName('optionsInput')[0].style.display = 'none';

            questionsContainer.appendChild(questionSection);
        }

        // Function to show/hide options input based on the selected answer format
        function showOptionsInput(selectElement) {
            var optionsInput = selectElement.parentElement.getElementsByClassName('optionsInput')[0];

            if (selectElement.value === "radio" || selectElement.value === "checkbox") {
                optionsInput.style.display = 'block';
            } else {
                optionsInput.style.display = 'none';
            }
        }

        // Attach onchange event to all answer_format select elements
        var answerFormatSelects = document.getElementsByClassName('answer_format');
        for (var i = 0; i < answerFormatSelects.length; i++) {
            answerFormatSelects[i].onchange = function () {
                showOptionsInput(this);
            };
        }
    </script>

</body>

</html>
