<?php
// Include studentstaffdb file
require_once "studentstaffdb.php";

// Define variables and initialize with empty values
$name = $password = $confirm_password = $category = "";
$name_err = $password_err = $confirm_password_err = $category_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validate username
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter a username.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["name"]))) {
        $name_err = "Username can only contain letters, numbers, and underscores.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM google WHERE name = ?";
        
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_name);
            
            // Set parameters
            $param_name = trim($_POST["name"]);
            
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);
                
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $name_err = "This username is already taken.";
                } else {
                    $name = trim($_POST["name"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate category (student or staff)
    if (empty(trim($_POST["category"]))) {
        $category_err = "Please select your category.";
    } else {
        $category = trim($_POST["category"]);
    }
    
    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";     
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";     
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting into the database
    if (empty($name_err) && empty($password_err) && empty($confirm_password_err) && empty($category_err)) {
        
        // Prepare an insert statement
        $sql = "INSERT INTO google (name, password, category) VALUES (?, ?, ?)";
         
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_password, $param_category);
            
            // Set parameters
            $param_name = $name;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_category = $category;
            
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to the login page
                header("location: googlelogin.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close the connection
    mysqli_close($link);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; background-color: #a3e4d7; }
        .wrapper{ width: 500px; padding: 30px; border: 2px solid #888; margin: 10% auto; background: white; }

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
            background-color: #0056b3; /* Darker blue on hover */
        }

        .radio-group {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <img src="logo.png" alt="Logo" width="150" height="150">
        <h2>Sign Up</h2>
        <p>Fill in details to sign up</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="form-group">
        <label>Username</label>
        <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
        <span class="invalid-feedback"><?php echo $name_err; ?></span>
    </div>  
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Role</label>
                <div class="radio-group">
                    <label><input type="radio" name="category" value="Student" <?php echo ($category == 'Student') ? 'checked' : ''; ?>> Student</label>
                    <label><input type="radio" name="category" value="Staff" <?php echo ($category == 'Staff') ? 'checked' : ''; ?>> Staff</label>
                    <label><input type="radio" name="category" value="Organization" <?php echo ($category == 'Organization') ? 'checked' : ''; ?>> Organization</label>
                </div>
                <span class="invalid-feedback"><?php echo $category_err; ?></span>
            </div>  
            <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Submit">
        <input type="reset" class="btn btn-secondary ml-2" value="Reset">
    </div>
    <p>Already have an account? <a href="googlelogin.php">Login here</a>.</p>
</form>
    </div>    
</body>
</html>
