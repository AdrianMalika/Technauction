<?php
require_once 'vendor/autoload.php';

// Set up Stripe API key
$stripe_secret_key = "sk_test_51OzC75BY9VoyjTsjXPbm5HVWUTCYf5CuDtaETyHvi3KHxSXCsQsN4rKz1z83hojqkeSuYlGcrdOOgCGj75dsa0tW000djgEinq";
\Stripe\Stripe::setApiKey($stripe_secret_key);

session_start();

// Check if the form is submitted and the notification ID is provided
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['notification_id'])) {
    $notification_id = $_POST['notification_id'];

    // Fetch notification details from the database based on $notification_id
    // Assuming you have established a database connection already

    // Example using PDO
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=technauction", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT * FROM admin_notifications WHERE id = ?");
        $stmt->execute([$notification_id]);
        $notification = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Create a checkout session with notification details
    if ($notification) {
        // Extracting bid amount from the message column
        preg_match('/Bid Amount:\s*MK(\d+)/', $notification['message'], $matches);
        $bid_amount_in_mk = $matches[1]; // Bid amount in MK

        // Ensure the bid amount is at least 50 cents in MK
        if ($bid_amount_in_mk < 50) {
            $bid_amount_in_mk = 50; // Set minimum amount to 50 cents in MK
        }

        // Convert bid amount from MK to cents
        $bid_amount_in_cents = $bid_amount_in_mk * 100; // Convert MK to cents

        // Create a checkout session with the adjusted bid amount
        $checkout_session = \Stripe\Checkout\Session::create([
            "mode" => "payment",
            "success_url" => "http://localhost/Technauction/success.php?notification_id=" . $notification_id,
            "cancel_url" => "http://localhost/Technauction/process_payment.php",
            "locale" => "auto",
            "line_items" => [
                [
                    "quantity" => 1,
                    "price_data" => [
                        "currency" => "MWK", // Use MWK as currency code for Malawi Kwacha
                        "unit_amount" => $bid_amount_in_cents, // Use adjusted bid amount in cents
                        "product_data" => [
                            "name" => "Payment Information",
                            "description" => $notification['message']
                        ]
                    ]
                ]
            ]
        ]);

        // Redirect user to checkout session URL
        http_response_code(303);
        header("Location: " . $checkout_session->url);
        exit(); // Stop script execution after redirection
    } else {
        // Notification not found for the provided ID, handle accordingly (redirect, error message, etc.)
        echo "Notification not found for the provided ID.";
    }
}
?>
