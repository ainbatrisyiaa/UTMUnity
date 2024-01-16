<!-- category_selection.php -->
<!DOCTYPE html>
<html lang="en">
<head>
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f5f5f5;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
    }

    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    h3 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    p {
        font-size: 18px;
        margin-bottom: 20px;
    }

    input[type="radio"] {
        margin: 0 5px; /* Adjusted margin to provide space between radio buttons */
    }

    input[type="button"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        border-radius: 5px;
    }

    input[type="button"]:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>
    <form id="categoryForm">
        <h3>Hi, Welcome New User!</h3>
        <p>Please choose your category to proceed:</p>
        <input type="radio" id="student" name="category" value="student">
        <label for="student">Student</label>
        <input type="radio" id="staff" name="category" value="staff">
        <label for="staff">Staff</label>
        <input type="radio" id="organization" name="category" value="organization">
        <label for="organization">Organization</label>
        <p></p>
        <input type="button" value="Submit" onclick="submitForm()">
    </form>

    <script>
        function submitForm() {
            var form = document.getElementById("categoryForm");
            var selectedCategory = form.querySelector('input[name="category"]:checked');

            if (selectedCategory) {
                var userCategory = selectedCategory.value;

                // Insert the user with the specified category
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "insert_user.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        var response = xhr.responseText;
                        if (response === "success") {
                            // Redirect based on the selected category
                            switch (userCategory.toLowerCase()) {
                                case "student":
                                    window.location.href = "studenthome.php";
                                    break;
                                case "staff":
                                    window.location.href = "staffhome.php";
                                    break;
                                case "organization":
                                    window.location.href = "orgzhome.php";
                                    break;
                                default:
                                    alert("Invalid category selected.");
                                    break;
                            }
                        } else {
                            alert("Sign up failed! (Something went wrong).");
                        }
                    }
                };

                xhr.send("id=" + encodeURIComponent('<?php echo $_GET['id']; ?>') + "&name=" + encodeURIComponent('<?php echo $_GET['name']; ?>') + "&email=" + encodeURIComponent('<?php echo $_GET['email']; ?>') + "&category=" + encodeURIComponent(userCategory));
            } else {
                alert("Please select a category.");
            }
        }
    </script>
</body>
</html>
