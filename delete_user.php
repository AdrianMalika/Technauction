<?php
session_start();
require_once 'connection.php';

// Delete User
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Perform a secure deletion query (replace 'users' with your actual table name)
    $query = "DELETE FROM users WHERE Id = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("i", $userId);

        if ($stmt->execute()) {
            $_SESSION['success_messages'] = "User successfully deleted.";
        } else {
            $_SESSION['error_messages'] = "Error deleting user: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['error_messages'] = "Error in preparing the delete statement: " . $conn->error;
    }

    // Redirect back to the page where the user initiated the delete
    header("Location: Admin_delete.php");
    exit();
} else {
    $_SESSION['error_messages'] = "Invalid request.";
    // Redirect back to the page where the user initiated the delete
    header("Location: Admin_delete.php");
    exit();
}
?>
