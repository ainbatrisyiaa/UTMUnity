<?php
function generateUniqueIdentifier() {
    // Generate a unique identifier based on the current timestamp
    // You can customize this based on your specific requirements
    return uniqid('form_', true);
}

function isFormOpen($openDateTime, $closeDateTime, $customCloseDateTime) {
    $currentTime = time();
    $openTime = strtotime($openDateTime);
    $closeTime = strtotime($customCloseDateTime);

    return ($currentTime >= $openTime && $currentTime <= $closeTime);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve additional form data
    $fullName = $_POST['your_name'];
    $eventName = $_POST['event_name'];
    $organizer = $_POST['organizer'];
    $openDateTime = $_POST['open_date'] . ' ' . $_POST['open_time'];
    
    // Use the custom close date if provided, otherwise use the fixed close date
    $closeDateTime = isset($_POST['custom_close_date']) ? $_POST['custom_close_date'] . ' ' . $_POST['close_time'] : $_POST['close_date'] . ' ' . $_POST['close_time'];

    // Check if the form is open for feedback
    if (!isFormOpen($openDateTime, $closeDateTime, $customCloseDateTime)) {
        echo "Sorry, the feedback form is currently closed.";
        exit();
    }

    // Process form data and generate a unique identifier
    $uniqueIdentifier = generateUniqueIdentifier();

    // You can now use these values as needed, for example, store them in a database.

    // Redirect to the form_published.php page with the unique identifier
    header("Location: form_published.php?form_id=$uniqueIdentifier");
    exit();
}
?>
