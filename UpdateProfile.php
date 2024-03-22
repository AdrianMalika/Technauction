<?php
session_start();

require_once 'Connection.php';

// Get user input
$firstName = $_POST["FirstName"];
$lastName = $_POST["LastName"];
$email = $_POST["email"];
$password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password

// Update user information
$updateQuery = "UPDATE users SET FirstName=?, LastName=?, Email=?, Password=? WHERE id=?";
$stmt = $conn->prepare($updateQuery);
$stmt->bind_param("ssssi", $firstName, $lastName, $email, $password, $_SESSION["id"]);

// Execute the update query
if ($stmt->execute()) {
    $_SESSION['update_success'] = "Profile updated successfully!";
} else {
    $_SESSION['update_error'] = "Error updating profile. Please try again.";
}

// Close the statement and connection
$stmt->close();
$conn->close();

    // Redirect back to profile page
    header("Location: pages-profile.php");
    exit();
?>
