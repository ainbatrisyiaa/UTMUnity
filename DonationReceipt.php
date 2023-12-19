<!DOCTYPE HTML>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Receipt</title><head>
    <style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .confirmation-container {
        width: 300px;
        background-color: #ffffff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .logo {
        width: 80px;
        height: 80px;
        margin-bottom: 20px;
    }

    h2 {
        color: #8d4004;
        margin-bottom: 10px;
    }

    .thank-you {
        font-size: 18px;
        color: #8d4004;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .confirmation-details {
        font-size: 16px;
        color: #6C757D;
        margin-bottom: 20px;
    }

    .back-to-home {
        text-decoration: none;
        color: #ffffff;
        background-color: #228B22;
        padding: 10px 20px;
        border-radius: 5px;
        transition: background-color 0.3s;
        display: inline-block;
    }

    .back-to-home:hover {
        background-color: #CC6640;
    }
</style>

</head>

<body>
    <?php
    // Retrieve user details from the URL parameter
  
    if (isset($_GET["user_id"])) {
        $user_id = $_GET["user_id"];
    } else {
        // Handle the case when "user_id" is not set, for example, redirect the user or show an error message.
        echo "User ID is not provided.";
        exit(); // Stop further execution to avoid the fatal error below.
    }
    
    // Assuming you have a database connection
    $servername = "localhost";
    $username = "localhost";
    $password = "donationform";
    $dbname = "donationdetails";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve user details from the database
    $result = $conn->query("SELECT * FROM UserDetails WHERE user_id = $user_id");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    ?>
        <!-- Your receipt HTML with dynamic data -->
        <div class="receipt-container">
            <img src="volunteerlogo.png" alt="Logo" class="logo">
            <h2>Donation Details</h2>

            <div class="thank-you">Please reconfirm the details before proceeding with payment.</div>
            <p class="event-name"><strong>Event: </strong><?php echo $row["event_name"]; ?></p>
            <p class="donor-name"><strong>Donor Name: </strong><?php echo $row["first_name"] . " " . $row["last_name"]; ?></p>

        
            <p class="amount-details"><strong>Amount: </strong> $<?php echo number_format($row["donate"], 2); ?></p>

            <!-- Rest of your receipt HTML -->

            <a href="paymentgetaway.php?user_id=<?php echo $user_id; ?>&donate=<?php echo $row['donate']; ?>" class="back-to-home">Proceed to Payment</a>
        </div>
    <?php
    } else {
        echo "User not found";
    }

    $conn->close();
    ?>

    <script>
        // JavaScript to display the current date
        const currentDate = new Date();
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('current-date').textContent = currentDate.toLocaleDateString('en-US', options);

        // JavaScript to generate a random transaction ID
        const transactionId = Math.random().toString(36).substr(2, 10);
        document.getElementById('transaction-id').textContent = transactionId;
    </script>
</body>

</html>