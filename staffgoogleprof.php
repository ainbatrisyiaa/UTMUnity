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
    <title>Staff Information</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font: solid black;
            background-color: #a3e4d7;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            width: 100%;
            max-width: 500px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div class="container">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <h2 class="text-center">Staff Profile</h2>
    <?php if (isset($user['name'], $user['email'])): ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group ">
                <label for="Username">Username:</label>
                <input type="text" class="form-control" id="name" value="<?php echo htmlspecialchars($user['name']); ?>" readonly>
            </div>
            <div class="form-group ">
                <label for="full_name">Full Name:</label>
                <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
            </div>
            <div class="form-group ">
                <label for="Phone">Phone Number:</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($user['phone_number']); ?>" required>
            </div>
            <div class="form-group ">
                <label for="Staff Email">Email:</label>
                <input type="text" class="form-control" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="name">Student ID:</label>
                <input type="text" class="form-control" id="studentstaffid" name="studentstaffid" value="<?php echo htmlspecialchars($user['studentstaffid']); ?>" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Update Information</button>
            </div>
        </form>
    <?php else: ?>
        <p>Error: User data not available.</p>
    <?php endif; ?>
</div>
</body>
</html>
