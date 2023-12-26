<?php
session_start();
require_once "studentstaffdb.php";
require 'vendor/autoload.php';

// Redirect logged-in users to the appropriate landing page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    switch ($_SESSION["category"]) {
        case 'Student':
            header("location: welcome.php");
            break;
        case 'Staff':
            header("location: welcomestaff.php");
            break;
        case 'Organization':
            header("location: orgzwelcome.php");
            break;
        default:
            header("location: welcome.php");
            break;
    }
    exit;
}


use League\OAuth2\Client\Provider\Google;

$provider = new Google([
    'clientId'     => '420005998744-if4ddc117g39gr4vemd1ngsrf13t740g.apps.googleusercontent.com',
    'clientSecret' => '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',
    'redirectUri'  => 'http://localhost/ad_project/test.php', // Update with your actual redirect URI
]);

$login_err = $username = $username_err = $password_err = '';

// Process form data when submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, username, password, category FROM studentstaff WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $category);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["category"] = $category;

                            // Redirect user to welcome page
                            switch ($category) {
                                case 'Student':
                                    header("location: welcome.php");
                                    break;
                                case 'Staff':
                                    header("location: welcomestaff.php");
                                    break;
                                case 'Organization':
                                    header("location: orgzwelcome.php");
                                    break;
                                default:
                                    header("location: welcome.php"); // Redirect to a default welcome page if category is not recognized
                                    break;
                            }
                        } else {
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else {
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}


// Generate Google OAuth URL

$authUrl = $provider->getAuthorizationUrl();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { font: 14px sans-serif; background-color: #a3e4d7; }
        .wrapper { width: 500px; padding: 30px; border: 2px solid #888; margin: 10% auto; background: white; }
        .button-wrapper { text-align: center; }
        .button-wrapper input[type=button] { background-color: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; margin: 5px; }
        .button-wrapper input[type=button]:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <div class="wrapper">
        <img src="logo.png" alt="Logo" width="150" height="150">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>

        <?php 
        if (!empty($login_err)) {
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Or log in with:</p>
            <div class="button-wrapper">
                <input type="button" onclick="window.location='<?php echo $authUrl; ?>'" value="Google">
            </div>
            <p>Don't have an account? <a href="userregister.php">Sign up now</a>.</p>
        </form>
    </div>
</body>
</html>

