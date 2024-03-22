<?php
session_start();
require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['product_id']) && isset($_GET['bid_amount'])) {
    if (!isset($_SESSION['id'])) {
        // Redirect to login page if the user is not logged in
        header("Location: login.php");
        exit();
    }

    $user_id = $_SESSION['id'];
    $product_id = $_GET['product_id'];
    $bid_amount = $_GET['bid_amount'];

    // Check if the bid is greater than the current bid in the database
    $current_bid_query = "SELECT price FROM products WHERE Id = $product_id";
    $current_bid_result = $conn->query($current_bid_query);

    if ($current_bid_result->num_rows > 0) {
        $current_bid = $current_bid_result->fetch_assoc()['price'];

        if ($bid_amount > $current_bid) {
            // Insert bid into the bids table
            $insert_bid_query = "INSERT INTO bids (user_id, product_id, bid_amount) VALUES ($user_id, $product_id, $bid_amount)";
            $insert_bid_result = $conn->query($insert_bid_query);

            if ($insert_bid_result) {
                // Update the current bid in the products table
                $update_bid_query = "UPDATE products SET price = $bid_amount WHERE Id = $product_id";
                $update_bid_result = $conn->query($update_bid_query);

                if ($update_bid_result) {
                    // Push a success notification to the array
                    $_SESSION['notifications'][] = ['type' => 'success', 'message' => 'Bid placed successfully!'];
                } else {
                    // Push an error notification to the array
                    $_SESSION['notifications'][] = ['type' => 'error', 'message' => 'Error updating bid: ' . $conn->error];
                }
            } else {
                // Push an error notification to the array
                $_SESSION['notifications'][] = ['type' => 'error', 'message' => 'Error placing bid: ' . $conn->error];
            }
        } else {
            // Push an error notification to the array
            $_SESSION['notifications'][] = ['type' => 'error', 'message' => 'Bid amount must be greater than the current bid.'];
        }
    } else {
        // Push an error notification to the array
        $_SESSION['notifications'][] = ['type' => 'error', 'message' => 'Error fetching current bid: ' . $conn->error];
    }
} else {
    // Push an error notification to the array
    $_SESSION['notifications'][] = ['type' => 'error', 'message' => 'Invalid request.'];
}

// Redirect back to the product details page with query parameters
if (isset($_SESSION['notifications']) && is_array($_SESSION['notifications']) && !empty($_SESSION['notifications'])) {
    // If there are notifications, set the appropriate query parameter
    $redirectUrl = "product-detail.php?product_id=$product_id&" . ($_SESSION['notifications'][0]['type'] === 'success' ? 'success=bid_placed' : 'error=bid_failed');
} else {
    // If there are no notifications, redirect without additional parameters
    $redirectUrl = "product-detail.php?product_id=$product_id";
}

header("Location: $redirectUrl");
exit();
?>
