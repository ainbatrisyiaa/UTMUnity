<?php
require_once __DIR__ . '/vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Retrieve user input
    $user_id = isset($_GET["user_id"]) ? $_GET["user_id"] : null;
    $donate = isset($_GET["donate"]) ? floatval($_GET["donate"]) : 0;

    // Debugging: Output received data
    echo "User ID: " . $user_id . "<br>";
    echo "Donation Amount: " . $donate . "<br>";

    // Validate user input
    if (!$user_id || $donate <= 0) {
        echo "Invalid user ID or donation amount.";
        exit();
    }

    // Set your Stripe secret key
    $stripe_secret_key = "sk_test_51OHRDwDcpo1c0G9vaQ7LbJA8Gd21QaGtWlqEoqfbGQntc280L3cSs06yUe1SsaqhKAGoyAzmybsg2rIOgtDN1s9F00BuO1cSks";
    \Stripe\Stripe::setApiKey($stripe_secret_key);

    // Debugging: Output Stripe secret key
    echo "Stripe Secret Key: " . $stripe_secret_key . "<br>";

    // Create a Checkout Session
    try {
        $checkout_session = \Stripe\Checkout\Session::create([
            "mode" => "payment",
            "success_url" => "http://localhost/UTMUnity/thank_you.php?session_id={CHECKOUT_SESSION_ID}",
            "cancel_url" => "http://localhost/UTMUnity/Donationdetails.php",
            "locale" => "auto",
            "payment_method_types" => ["card","grabpay","fpx","alipay"],
            "line_items" => [
                [
                    "quantity" => 1,
                    "price_data" => [
                        "currency" => "myr",
                        "unit_amount" => $donate * 100, // Convert the amount to cents
                        "product_data" => [
                            "name" => "Donation",
                        ],
                    ],
                ],
            ],
        ]);

        // Debugging: Output success
        echo "Checkout session created successfully.<br>";

        // Redirect to the Checkout session
        header("Location: " . $checkout_session->url);
        exit();
    } catch (\Stripe\Exception\ApiErrorException $e) {
        // Stripe API Error
        echo 'Stripe API Error: ' . $e->getMessage();
        exit();
    } catch (\Exception $e) {
        // Other Errors
        echo 'Error: ' . $e->getMessage();
        exit();
    }
} else {
    // Handle invalid requests
    http_response_code(400);
    die("Invalid request");
}

?>
