<?php
session_start();
require 'studentstaffdb.php';

// Check if the user is already logged in
if (isset($_SESSION['loggedin'])) {
    header('Location: home.php');
    exit;
}

require 'google-api-php-client-2.4.0/vendor/autoload.php';

// Creating a new Google client instance
$client = new Google_Client();
// Enter your Client ID
$client->setClientId('420005998744-2r8ft5v6v6hqub65mi00t2ueg2o30oav.apps.googleusercontent.com');
// Enter your Client Secret
$client->setClientSecret('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');
// Enter the Redirect URL
$client->setRedirectUri('http://localhost/ad_project/googlelogin.php');
// Adding scopes for email & profile information
$client->addScope("email");
$client->addScope("profile");

// Database connection
$db_connection = mysqli_connect("localhost", "DevGenius", "UTMUnity67", "devgenius");
if (!$db_connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if (!isset($token["error"])) {
        $client->setAccessToken($token['access_token']);
        // Getting profile information
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();

        // Storing data into the database
        $id = mysqli_real_escape_string($db_connection, $google_account_info->id);
        $full_name = mysqli_real_escape_string($db_connection, trim($google_account_info->name));
        $email = mysqli_real_escape_string($db_connection, $google_account_info->email);
        $profile_pic = mysqli_real_escape_string($db_connection, $google_account_info->picture);

        // Checking if the user already exists or not
        $get_user = mysqli_query($db_connection, "SELECT `oauth_id` FROM `google` WHERE `oauth_id`='$id'");

        if (mysqli_num_rows($get_user) > 0) {
            $_SESSION['loggedin'] = $id;
            header('Location: home.php');
            exit;
        } else {
            // If the user does not exist, insert the user
            $insert = mysqli_query($db_connection, "INSERT INTO `google`(`oauth_id`,`full_name`,`email`) VALUES('$id','$full_name','$email')");

            if ($insert) {
                $_SESSION['loggedin'] = $id;
                header('Location: home.php');
                exit;
            } else {
                echo "Sign up failed! (Something went wrong).";
            }
        }
    } else {
        header('Location: googlelogin.php');
        exit;
    }
} else {
    // Google Login URL
    $google_login_url = $client->createAuthUrl();

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

            if ($stmt = mysqli_prepare($db_connection, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);

                // Set parameters
                $param_username = $username;

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    // Store result
                    mysqli_stmt_store_result($stmt);

                    // Check if username exists, if yes, then verify the password
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

                                // Redirect user to the welcome page
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
                                        header("location: welcome.php");
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
        mysqli_close($db_connection);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Google</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #a3e4d7;
            padding: 10px;
            margin: 0;
        }

        ._container {
            max-width: 400px;
            background-color: #ffffff;
            padding: 20px;
            margin: 0 auto;
            border: 1px solid #cccccc;
            border-radius: 2px;
        }

        ._container.btn {
            text-align: center;
        }

        .heading {
            text-align: center;
            color: #4d4d4d;
            text-transform: uppercase;
        }

        .login-with-google-btn {
            transition: background-color 0.3s, box-shadow 0.3s;
            padding: 12px 16px 12px 42px;
            border: none;
            border-radius: 3px;
            box-shadow: 0 -1px 0 rgb(0 0 0 / 4%), 0 1px 1px rgb(0 0 0 / 25%);
            color: #ffffff;
            font-size: 14px;
            font-weight: 500;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif;
            background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTgiIGhlaWdodD0iMTgiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj48cGF0aCBkPSJNMTcuNiA5LjJsLS4xLTEuOEg5djMuNGg0LjhDMTMuNiAxMiAxMyAxMyAxMiAxMy42djIuMmgzYTguOCA4LjggMCAwIDAgMi42LTYuNnoiIGZpbGw9IiM0Mjg1RjQiIGZpbGwtcnVsZT0ibm9uemVybyIvPjxwYXRoIGQ9Ik05IDE4YzIuNCAwIDQuNS0uOCA2LTIuMmwtMy0yLjJhNS40IDUuNCAwIDAgMS04LTIuOUgxVjEzYTkgOSAwIDAgMCA4IDV6IiBmaWxsPSIjMzRBODUzIiBmaWxsLXJ1bGU9Im5vbnplcm8iLz48cGF0aCBkPSJNOSAzLjZjMS4zIDAgMi41LjQgMy40IDEuM0wxNSAyLjNBOSA5IDAgMCAwIDEgNWwzIDIuNGE1LjQgNS40IDAgMCAxIDUtMy43eiIgZmlsbD0iI0VBNDMzNSIgZmlsbC1ydWxlPSJub256ZXJvIi8+PHBhdGggZD0iTTAgMGgxOHYxOEgweiIvPjwvZz48L3N2Zz4=);
            background-color: #4a4a4a;
            background-repeat: no-repeat;
            background-position: 12px 11px;
            text-decoration: none;
        }

        .login-with-google-btn:hover {
            box-shadow: 0 -1px 0 rgba(0, 0, 0, 0.04), 0 2px 4px rgba(0, 0, 0, 0.25);
        }

        .login-with-google-btn:active {
            background-color: #000000;
        }

        .login-with-google-btn:focus {
            outline: none;
            box-shadow: 0 -1px 0 rgba(0, 0, 0, 0.04), 0 2px 4px rgba(0, 0, 0, 0.25), 0 0 0 3px #c8dafc;
        }

        .login-with-google-btn:disabled {
            filter: grayscale(100%);
            background-color: #ebebeb;
            box-shadow: 0 -1px 0 rgba(0, 0, 0, 0.04), 0 1px 1px rgba(0, 0, 0, 0.25);
            cursor: not-allowed;
        }

        .wrapper {
            width: 500px;
            padding: 30px;
            border: 2px solid #888;
            margin: 10% auto;
            background: white;
        }

        .button-wrapper {
            text-align: center;
        }

        .button-wrapper input[type=button] {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin: 5px;
        }

        .button-wrapper input[type=button]:hover {
            background-color: #0056b3;
        }
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
            
            <p> OR login with

            <div class="_container btn">
                <a type="button" class="login-with-google-btn" href="<?php echo $google_login_url; ?>">
                    Sign in with Google
                </a>
            </div>

        <p>Don't have an account? <a href="userregister.php">Sign up now</a>.</p>
        </form>
    </div>
</body>

</html>
<?php

?>