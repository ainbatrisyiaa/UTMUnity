<?php
// Include the database connection file (studentstaffdb.php)
require_once "studentstaffdb.php";

// Start or resume the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: userlogin.php");
    exit;
}

// Define variables and initialize with empty values
$name = $full_name = $phone_number = $email = "";
$name_err = $full_name_err = $phone_number_err = $email_err  = "";

// Fetch user profile from the database
$sql = "SELECT name, full_name, phone_number, email FROM google WHERE id = ?";
if ($stmt = mysqli_prepare($link, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $_SESSION["id"]);
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);
        mysqli_stmt_bind_result($stmt, $name, $full_name, $phone_number, $email);
        mysqli_stmt_fetch($stmt);
    }
    mysqli_stmt_close($stmt);
}

// Process form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter a name.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["name"]))) {
        $name_err = "Name can only contain letters, numbers, and underscores.";
    } else {
        $name = trim($_POST["name"]);
    }

    // Validate full name
    if (empty(trim($_POST["full_name"]))) {
        $full_name_err = "Please enter your full name.";
    } else {
        $full_name = trim($_POST["full_name"]);
    }

    // Validate phone number
    if (empty(trim($_POST["phone_number"]))) {
        $phone_number_err = "Please enter your phone number.";
    } else {
        $phone_number = trim($_POST["phone_number"]);
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email address.";
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Check input errors before updating the database
    if (empty($name_err) && empty($full_name_err) && empty($phone_number_err) && empty($email_err)) {
        // Update user profile in the database
        $sql = "UPDATE google SET name=?, full_name=?, phone_number=?, email=? WHERE id=?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssssi", $name, $full_name, $phone_number, $email, $_SESSION["id"]);

            if (mysqli_stmt_execute($stmt)) {
                // Profile updated successfully
                header("location: orgzprofile.php");
                exit;
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }
}

// Close the database connection
mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Organization Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add your custom styles if needed -->
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
            <h2 class="text-center">Organization Profile</h2>

            <div class="form-group">
                <label>Organization Username</label>
                <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                <span class="invalid-feedback"><?php echo $name_err; ?></span>
            </div>

            <div class="form-group">
                <label>Organization Name</label>
                <input type="text" name="full_name" class="form-control <?php echo (!empty($full_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $full_name; ?>">
                <span class="invalid-feedback"><?php echo $full_name_err; ?></span>
            </div>

            <div class="form-group">
                <label>Organization Phone Number</label>
                <input type="text" name="phone_number" class="form-control <?php echo (!empty($phone_number_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phone_number; ?>">
                <span class="invalid-feedback"><?php echo $phone_number_err; ?></span>
            </div>

            <div class="form-group">
                <label>Organization Email</label>
                <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>


            <div class="form-group">
                <input type="submit" class="btn btn-primary btn-block" value="Update Profile">
            </div>
        </form>
    </div>
</body>
</html>

