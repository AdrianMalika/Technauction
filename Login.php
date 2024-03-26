<?php
session_start();

require_once 'Connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Email = $_POST["User_Email"];
    $Password = $_POST["password"];

    // Prepare and execute SQL statement to check user credentials
    $stmt = $conn->prepare("SELECT id, FirstName, LastName, email, password, status FROM users WHERE email=?");
    $stmt->bind_param("s", $Email);
    $stmt->execute();
    $stmt->bind_result($userId, $userFirstName, $userLastName, $userEmail, $storedHashedPassword, $userStatus);
    $stmt->fetch();

    // Validate user credentials and check if user is not blocked
    if ($storedHashedPassword !== null && password_verify($Password, $storedHashedPassword) && $userStatus !== 'blocked') {
        $_SESSION["id"] = $userId;
        $_SESSION["FirstName"] = $userFirstName;
        $_SESSION["LastName"] = $userLastName;
        $_SESSION["email"] = $userEmail;
        $_SESSION["isloggedin"] = true;
        $_SESSION["invalidCredentials"] = false;
        header("Location: index.php");
        exit();
    } else {
        if ($userStatus === 'blocked') {
            $_SESSION["blockedUser"] = true;
        } else {
            $_SESSION["invalidCredentials"] = true;
        }
        header("Location: sign-in.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
