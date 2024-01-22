<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            text-align: center;
            padding-top: 50px;
        }

        .receipt-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #8d4004;
            margin-bottom: 10px;
        }

        .receipt-text {
            font-size: 18px;
            color: #6C757D;
            margin-bottom: 20px;
        }

        .back-to-home {
            text-decoration: none;
            color: #ffffff;
            background-color: #2E8B57;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
            display: inline-block;
            margin-top: 20px;
        }

        .back-to-home:hover {
            background-color: #CC6640;
        }
    </style>
</head>

<body>
    <div class="receipt-container">
        <h1>Donation Receipt</h1>
        <p class="receipt-text">Thank you for your generous donation.</p>
        <p class="receipt-text">Details:</p>
        <p class="receipt-text">Name: AIN BATRISYIA BINTI NORAZLAN</p>
        <p class="receipt-text">Email: ain.batrisyia@graduate.utm.my</p>
        <p class="receipt-text">Donation Amount: $15.00</p>
        <p class="receipt-text">Event: Planting Tree Is Fun</p>
        <!-- Add other details as needed -->

        <a href="thank_you.php" class="back-to-home">Back</a>
    </div>
</body>
</html>
