<?php
session_start();

require_once 'Connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Email = $_POST["User_Email"];
    $Password = $_POST["password"];

    // Check if session variables for login attempts exist


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

        // Reset login attempts and last login attempt time
        $_SESSION['loginAttempts'] = 0;
        $_SESSION['lastLoginAttempt'] = time();

        header("Location: index.php");
        exit();
    } else {
        if ($userStatus === 'blocked') {
            $_SESSION["blockedUser"] = true;
        } else {
            $_SESSION["invalidCredentials"] = true;
        }

        // Increment login attempts and update last login attempt time
        $_SESSION['loginAttempts']++;
        $_SESSION['lastLoginAttempt'] = time();

        header("Location: sign-in.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
