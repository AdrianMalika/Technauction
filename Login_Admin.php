<?php
session_start();

require_once 'Connection.php';

$Email = $_POST["User_Email"];
$Password = $_POST["password"];

// Check for login attempts and waiting period
if (isset($_SESSION['loginAttempts1']) && isset($_SESSION['lastLoginAttempt1'])) {
    $maxLoginAttempts = 3;
    $waitingPeriod = 2; // 2 seconds for testing, should be 10 minutes in production

    $lastLoginAttempt = $_SESSION['lastLoginAttempt1'];
    $currentTime = time();

    if (($currentTime - $lastLoginAttempt) < $waitingPeriod) {
        $_SESSION["loginWait1"] = true;
        header("Location: signin_admin.php");
        exit();
    } else {
        $_SESSION['loginAttempts1'] = 0;
        $_SESSION['lastLoginAttempt1'] = 3; // Reset last login attempt
    }
}

// Prepare and execute SQL statement to check admin credentials
$stmt = $conn->prepare("SELECT ID, password FROM admin WHERE Email=?");
if (!$stmt) {
    die("Prepare error: " . $conn->error);
}
$stmt->bind_param("s", $Email);

if (!$stmt->execute()) {
    die("Execute error: " . $stmt->error);
}

$stmt->bind_result($userId, $storedHashedPassword);
$stmt->fetch();

// Validate admin credentials
if ($storedHashedPassword !== null && password_verify($Password, $storedHashedPassword)) {
    $_SESSION["user_id"] = $userId;
    $_SESSION["isloggedin1"] = true;
    $_SESSION["invalidCredentials1"] = false;

    $_SESSION['loginAttempts1'] = 0;
    $_SESSION['lastLoginAttempt1'] = 0;

    header("Location: Admin_index.php");
    exit();
} else {
    $_SESSION["invalidCredentials1"] = true;
    $_SESSION["loginAttempts1"]++;
    $_SESSION['lastLoginAttempt1'] = time();
    header("Location: signin_admin.php");
    exit();
}

$stmt->close();
$conn->close();
?>
