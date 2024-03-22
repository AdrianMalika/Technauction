<?php
session_start();

require_once 'Connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Email = $_POST["User_Email"];
    $Password = $_POST["password"];

    // Prepare and execute SQL statement to check user credentials
    $stmt = $conn->prepare("SELECT id, FirstName, LastName, email, password FROM users WHERE email=?");
    $stmt->bind_param("s", $Email);
    $stmt->execute();
    $stmt->bind_result($userId, $userFirstName, $userLastName, $userEmail, $storedHashedPassword);
    $stmt->fetch();

    // Validate user credentials
    if ($storedHashedPassword !== null && password_verify($Password, $storedHashedPassword)) {
        $_SESSION["id"] = $userId;
        $_SESSION["FirstName"] = $userFirstName;
        $_SESSION["LastName"] = $userLastName;
        $_SESSION["email"] = $userEmail;
        $_SESSION["isloggedin"] = true;
        $_SESSION["invalidCredentials"] = false;
        header("Location: index.php");
        exit();
    } else {
        $_SESSION["invalidCredentials"] = true;
        header("Location: sign-in.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
