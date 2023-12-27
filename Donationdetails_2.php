<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Form</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #a3e4d7;
        margin: 0;
        padding: 0;
    }

    .donation-container {
        max-width: 600px;
        margin: 50px auto;
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .details-container,
    .amount-container {
        flex: 1;
        padding: 30px;
        align-items: center;
    }

    .donation-form {
        display: flex;
        flex-direction: column;
    }

    .donation-form label {
        margin-bottom: 8px;
        font-weight: bold;
        display: block;
    }

    .donation-form input {
        width: 100%;
        padding: 10px; /* Adjusted padding */
        margin-bottom: 15px;
        border-radius: 8px;
        box-sizing: border-box;
        font-size: 16px;
        border: 1px solid #ccc;
    }

    input[type="submit"] {
        background-color: #2E8B57; /* Changed button color */
        color: white;
        padding: 15px;
        border: none;
        border-radius: 8px;
        font-size: 18px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    input[type="submit"]:hover {
        background-color: #228B22; /* Changed hover color */
    }

    .donation-option {
        display: inline-block;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: #2E8B57;
        color: white;
        text-align: center;
        line-height: 50px;
        margin: 5px;
        cursor: pointer;
        transition: transform 0.3s;
    }

    .donation-option:hover {
        transform: scale(1.1);
    }

    #other_amount {
        width: calc(100% - 16px);
        padding: 12px;
        margin-bottom: 15px;
        border-radius: 8px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        font-size: 16px;
    }

    .section-header {
        text-align: center;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 24px;
        color: #8fbc8f; /* Changed section header color */
        border-bottom: 2px solid #8fbc8f; /* Changed border color */
        padding-bottom: 10px;
        margin-bottom: 20px;
    }
</style>


</head>
<body>

<div class="donation-container">
    <div class="details-container">
        <form method="post" action="userdetails.php" class="donation-form">
            <div class="section-header">Your Details</div>
             <!-- Add an event name input -->
            <label for="event_name">Event Name:</label>
            <input type="text" id="event_name" name="event_name" value="Meet The Poor" readonly>

            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required>

            <label for="email">Email Address:</label>
            <input type="email" id="email_id" name="email_id" required>

            <label for="phone_number">Phone Number:</label>
            <input type="number" id="phone_number" name="phone_number" required>
    </div>

    <div class="amount-container">
        <div class="section-header">Choose Amount</div>
        <?php
        $donation_options = [5, 10, 15, 20, 50, 100];
        foreach ($donation_options as $option) {
            echo '<div class="donation-option" onclick="selectDonation(' . $option . ')">RM' . $option . '</div>';
        }
        ?>
        <p>
            <label for="other_amount">Amount:</label>
            <input type="number" id="other_amount" name="other_amount" min="1" value="<?php echo $donate > 0 ? $donate : ''; ?>"readonly>
            <br><br>
            <input type="submit" value="Donate Now">
        
            <input type="hidden" id="selected_donation" name="donate" value="<?php echo $donate; ?>">
        </p>
    </div>
    </form>
</div>

<script>
    function selectDonation(amount) {
        document.getElementById('selected_donation').value = amount;
        document.getElementById('other_amount').value = amount;
    }
</script>

</body>
</html>
