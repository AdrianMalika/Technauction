<?php
session_start(); // Start the session

require_once 'connection.php';

$FirstName = $_POST["FirstName"];
$LastName = $_POST["LastName"];
$Email = $_POST["email"];
$Password = $_POST["password"];

// Check password strength
if (strlen($Password) < 6 || !preg_match('/[0-9]/', $Password) || !preg_match('/[a-zA-Z]/', $Password)){
    $_SESSION['password_not_strong'] = "Password must be at least 6 characters long and contain both letters and numbers.";
    header("Location: sign-up.php");
    exit();
}

// Check if the email is already taken
$checkStmt = $conn->prepare("SELECT ID FROM Users WHERE Email = ?");
$checkStmt->bind_param("s", $Email);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();

if ($checkResult->num_rows > 0) {
    $_SESSION['Email_taken'] = "Email is already taken. Please choose another email.";
    header("Location: sign-up.php");
    exit(); // Important to exit after redirect
}

// Hash the password
$hashedPassword = password_hash($Password, PASSWORD_DEFAULT);

// Insert the user into the database
$insertStmt = $conn->prepare("INSERT INTO users (FirstName, LastName, Email, Password) VALUES (?, ?, ?, ?)");
$insertStmt->bind_param("ssss", $FirstName, $LastName, $Email, $hashedPassword);

// Execute the statement
if ($insertStmt->execute()) {
    // Set success message
    $_SESSION['registration_success'] = "You have successfully registered!";
    header("Location: sign-up.php");
    exit();
} else {
    // Redirect with an error message
    $_SESSION['registration_error'] = "There was an error during registration. Please try again later.";
    header("Location: sign-up.php");
    exit();
}

// Close statements and the database connection
$checkStmt->close();
$insertStmt->close();
$conn->close();
?>
