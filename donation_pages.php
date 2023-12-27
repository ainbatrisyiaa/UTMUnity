<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #a3e4d7;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 10px;
        }

        input, select {
            margin-bottom: 20px;
            padding: 8px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        .logos {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .logo {
            max-width: 45%;
        }

        .logo img {
            max-width: 100%;
            height: auto;
        }

        .logo1 img {
            max-width: 150px;
        }

        .logo2 img {
            max-width: 90px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="logos">
        <div class="logo logo1">
            <img src="utmlogo.png" alt="Logo 1">
        </div>
        <div class="logo logo2">
            <img src="volunteerlogo.png" alt="Logo 2">
        </div>
    </div>

    <form id="donationForm" action="process_donation.php" method="post">
    <!-- Add an event name input -->
    <label for="event_name">Event Name:</label>
    <input type="text" id="event_name" name="event_name" value="Save Animals Life" readonly>

   
    <!-- Include hidden fields required by your payment gateway -->
    <input type="hidden" name="merchant_id" value="merchant-id">
    <input type="hidden" name="payment_amount" id="payment_amount" value="0">

		<label for="name">Name:</label>
        <input type="text" id="name" name="name" placeholder="Enter your name" required>

        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>

    <label for="amount">Amount:</label>
    <select id="amountSelect" name="amount" required onchange="updatePaymentAmount()">
        <option value="choose">Choose Amount</option>
        <option value="1">RM1</option>
        <option value="5">RM5</option>
        <option value="10">RM10</option>
        <option value="20">RM20</option>
        <option value="50">RM50</option>
        <option value="100">RM100</option>
    </select>

    <input type="submit" value="Proceed to Payment">
</form>

<script>
    // JavaScript function to set the payment amount based on the selected amount
    function updatePaymentAmount() {
        var selectedAmount = document.getElementById('amountSelect').value;
        document.getElementById('payment_amount').value = selectedAmount;
    }
</script>

</div>

<script>
    // JavaScript function to set the payment amount based on the selected amount
    document.getElementById('amount').addEventListener('change', function() {
        var selectedAmount = this.value;
        document.getElementById('payment_amount').value = selectedAmount;
    });

    // JavaScript function to redirect based on payment method
    document.getElementById('donationForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting

        // Add the following code to check if an amount is selected
        var selectedAmount = document.getElementById('payment_amount').value;
        if (selectedAmount === '0' || selectedAmount === 'choose') {
            alert('Please choose a valid donation amount.');
        return;
    }
    });
</script>


</body>
</html>






