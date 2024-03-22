<?php
session_start();
require_once 'connection.php';

// Delete Product
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Perform a secure deletion query (replace 'products' with your actual table name)
    $query = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("i", $productId);

        if ($stmt->execute()) {
            $_SESSION['success_messages'] = "Product successfully deleted.";
        } else {
            $_SESSION['error_messages'] = "Error deleting product: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['error_messages'] = "Error in preparing the delete statement: " . $conn->error;
    }

    // Redirect back to the page where the user initiated the delete
    header("Location:  Manage_Product.php");
    exit();
} else {
    $_SESSION['error_messages'] = "Invalid request.";
    // Redirect back to the page where the user initiated the delete
    header("Location: Manage_Product.php");
    exit();
}
?>
