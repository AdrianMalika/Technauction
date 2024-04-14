
<?php
session_start();
require_once 'Connection.php';

// Check if admin or regular user is logged in
if (!isset($_SESSION["isloggedin"]) && !isset($_SESSION["isloggedin1"])) {
    header("Location: sign-in.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
    // Get the product ID from the POST data
    $product_id = $_POST['product_id'];

    // Delete the bid for the product for the logged-in user
    $stmt = $conn->prepare("DELETE FROM bids WHERE product_id = ? AND user_id = ?");
    $stmt->bind_param("ii", $product_id, $_SESSION['id']);
    $stmt->execute();

    // Redirect back to the product details page
    header("Location: product-detail.php?product_id=' . $row['Id'] . '");
    exit();
} else {
    // Redirect back to the products page if the form is not submitted properly
    header("Location: products.php");
    exit();
}
?>
