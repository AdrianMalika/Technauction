<?php
session_start(); // Start the session

require_once 'connection.php';

$UserName = $_POST["UserName"];
$Email = $_POST["email"];
$Password = $_POST["password"];

// Check password strength
if (strlen($Password) < 6 || !preg_match('/[0-9]/', $Password) || !preg_match('/[a-zA-Z]/', $Password)){
    $_SESSION['password_not_strong1'] = "Password must be at least 6 characters long and contain both letters and numbers.";
    header("Location: add_userAdmin.php");
    exit();
}

// Check if the email is already taken
$checkStmt = $conn->prepare("SELECT ID FROM admin WHERE Email = ?");
$checkStmt->bind_param("s", $Email);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();

if ($checkResult->num_rows > 0) {
    $_SESSION['Email_taken1'] = "Email is already taken. Please choose another email.";
    header("Location: add_userAdmin.php");
    exit(); // Important to exit after redirect
}

// Hash the password
$hashedPassword = password_hash($Password, PASSWORD_DEFAULT);

// Insert the user into the database
$insertStmt = $conn->prepare("INSERT INTO admin (Name, Email, Password) VALUES (?,?,?)");
$insertStmt->bind_param("sss", $UserName, $Email, $hashedPassword);

// Execute the statement
if ($insertStmt->execute()) {
    // Set success message
    $_SESSION['registration_success1'] = "You have successfully registered!";
    header("Location:add_userAdmin.php");
    exit();
} else {
    // Redirect with an error message
    $_SESSION['registration_error1'] = "There was an error during registration. Please try again later.";
    header("Location: add_userAdmin.php");
    exit();
}

// Close statements and the database connection
$checkStmt->close();
$insertStmt->close();
$conn->close();
?>
