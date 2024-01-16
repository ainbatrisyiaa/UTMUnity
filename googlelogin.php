<?php
session_start();
require 'studentstaffdb.php';
require 'google-api-php-client-2.4.0/vendor/autoload.php';

// Creating a new Google client instance
$client = new Google_Client();
$client->setClientId('420005998744-2r8ft5v6v6hqub65mi00t2ueg2o30oav.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/UTMUnity/googlelogin.php');
$client->addScope("email");
$client->addScope("profile");

// Database connection
$db_connection = mysqli_connect("localhost", "DevGenius", "UTMUnity67", "devgenius");
if (!$db_connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$name = $email = ""; // Initialize variables

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if (!isset($token["error"])) {
        $client->setAccessToken($token['access_token']);
        // Getting profile information
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();

        // Storing data into the database
        $id = mysqli_real_escape_string($db_connection, $google_account_info->id);
        $name = mysqli_real_escape_string($db_connection, trim($google_account_info->name));
        $email = mysqli_real_escape_string($db_connection, $google_account_info->email);

        // Checking if the user already exists or not
        $get_user = mysqli_query($db_connection, "SELECT `oauth_id`, `category` FROM `google` WHERE `oauth_id`='$id'");

        if (mysqli_num_rows($get_user) > 0) {
            $row = mysqli_fetch_assoc($get_user);
            $_SESSION['loggedin'] = $id;
            $_SESSION['category'] = $row['category'];
            redirectUser();
        } else {
            // Redirect to category_selection.php after successful login
            header("Location: category_selection.php?id=$id&name=$name&email=$email");
            exit;
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
        redirectUsers();
        exit;
    }
}
function redirectUser() {
    switch ($_SESSION["category"]) {
        case 'Student':
            header("location: studenthome.php");
            break;
        case 'Staff':
            header("location: staffhome.php");
            break;
        case 'Organization':
            header("location: orgzhome.php");
            break;
        default:
            header("location: test.php");
            break;
    }
    exit;
}
// Function to redirect user based on category
function redirectUsers() {
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
            header("location: test.php");
            break;
    }
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name_err = $password_err = '';

    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter name.";
    } else {
        $name = trim($_POST["name"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty($name_err) && empty($password_err)) {
        $sql = "SELECT id, name, password, category FROM google WHERE name = ?";

        if ($stmt = mysqli_prepare($db_connection, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_name);

            $param_name = $name;

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $id, $name, $hashed_password, $category);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["name"] = $name;
                            $_SESSION["category"] = $category;
                            redirectUsers();
                        } else {
                            $login_err = "Invalid name or password.";
                        }
                    }
                } else {
                    $login_err = "Invalid username or password.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($db_connection);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
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
                <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                <span class="invalid-feedback"><?php echo $name_err; ?></span>
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
