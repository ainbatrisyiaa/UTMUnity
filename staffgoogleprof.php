<?php
session_start();
require 'studentstaffdb.php';

// Database connection
$db_connection = mysqli_connect("localhost", "DevGenius", "UTMUnity67", "devgenius");
if (!$db_connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the user is logged in
if (!isset($_SESSION['loggedin'])) {
    header('Location: main.php');
    exit;
}

// Fetch user information from the database
$id = $_SESSION['loggedin'];
$get_user = mysqli_query($db_connection, "SELECT * FROM `google` WHERE `oauth_id`='$id'");

if (mysqli_num_rows($get_user) > 0) {
    $user = mysqli_fetch_assoc($get_user);
} else {
    header('Location: googlelogout.php');
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = mysqli_real_escape_string($db_connection, $_POST['full_name']);
    $phone_number = mysqli_real_escape_string($db_connection, $_POST['phone_number']);
    $studentstaffid = mysqli_real_escape_string($db_connection, $_POST['studentstaffid']);

    $update_query = "UPDATE `google` SET `full_name`='$full_name', `phone_number`='$phone_number', `studentstaffid`='$studentstaffid' WHERE `oauth_id`='$id'";
    $update_result = mysqli_query($db_connection, $update_query);

    if ($update_result) {
        // Refresh user data after update
        $get_user = mysqli_query($db_connection, "SELECT * FROM `google` WHERE `oauth_id`='$id'");
        $user = mysqli_fetch_assoc($get_user);
    } else {
        echo "Error updating user information.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Information</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #a3e4d7;
            padding: 10px;
            margin: 0;
        }

        .form-container {
            max-width: 400px;
            background-color: #ffffff;
            padding: 20px;
            margin: 0 auto;
            border: 1px solid #cccccc;
            border-radius: 1px;
            margin-top: 120px;
        }

        .form-container h4 {
            text-align: center;
            color: #4d4d4d;
            text-transform: uppercase;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h4>Staff Information</h4>

    <?php if (isset($user['name'], $user['email'])): ?>
        <form method="post" action="">
            <div class="form-group text-center">
                <label for="Username">Name:</label>
                <input type="text" class="form-control" id="name" value="<?php echo htmlspecialchars($user['name']); ?>" readonly>
            </div>
            <div class="form-group text-center">
                <label for="full_name">Full Name:</label>
                <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
            </div>
            <div class="form-group text-center">
                <label for="Phone">Phone Number:</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($user['phone_number']); ?>" required>
            </div>
            <div class="form-group text-center">
                <label for="Student Email">Email:</label>
                <input type="text" class="form-control" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" readonly>
            </div>
            <div class="form-group text-center">
                <label for="name">Student ID:</label>
                <input type="text" class="form-control" id="studentstaffid" name="studentstaffid" value="<?php echo htmlspecialchars($user['studentstaffid']); ?>" required>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">Update Information</button>
            </div>
        </form>
    <?php else: ?>
        <p>Error: User data not available.</p>
    <?php endif; ?>
</div>

<!-- Additional content... -->

</body>
</html>
