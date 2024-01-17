<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #a3e4d7;
            margin: 0;
            padding: 0;
            text-align: center;
            padding-top: 50px;
        }

        .thank-you-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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

        .thank-you-text {
            font-size: 18px;
            color: #6C757D;
            margin-bottom: 20px;
        }

        .back-to-home,
        .view-receipt {
            text-decoration: none;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
            display: inline-block;
            margin-right: 10px;
        }

        .back-to-home {
            background-color: #2E8B57;
        }

        .view-receipt {
            background-color: #007BFF;
        }

        .back-to-home:hover {
            background-color: #CC6640;
        }

        .view-receipt:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="thank-you-container">
        <h2>Thank You for Your Contribution</h2>
        <p class="thank-you-text"><i>Alone we can do so little; together we can do so much.</i></p>
        <p class="thank-you-text"><strong>– Helen Keller</strong></p>
        <a href="studenthome.php" class="back-to-home">Back to Home</a>
        <!-- Add the "View Receipt" link/button -->
        <a href="receipt.php" class="view-receipt">View Receipt</a>
    </div>
</body>
</html>
