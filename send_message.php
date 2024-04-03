<?php
session_start();
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if all required fields are filled
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {
        // Sanitize user inputs
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);

        // Insert message into the database
        $query = "INSERT INTO messages (name, email, message) VALUES ('$name', '$email', '$message')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Set success message in session
            $_SESSION['update_success'] = "Message sent successfully";
        } else {
            // Set error message in session
            $_SESSION['update_error'] = "Failed to send message";
        }
    } else {
        // Missing required fields
        $_SESSION['update_error'] = "Please fill all required fields";
    }
}

// Redirect back to the contact page
header("Location: contact.php");
exit();
?>
