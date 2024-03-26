<?php
session_start();
require_once 'connection.php';

// Block/Unblock User
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Fetch user details
    $query = "SELECT *, IF(status = 'blocked', 1, 0) AS Blocked FROM users WHERE Id = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("i", $userId);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                $user = $result->fetch_assoc();
                $newStatus = $user['Blocked'] ? 0 : 1; // Toggle status (0 for unblocked, 1 for blocked)

                // Update user status
                $updateQuery = "UPDATE users SET Blocked = ? WHERE Id = ?";
                $updateStmt = $conn->prepare($updateQuery);
                if ($updateStmt) {
                    $updateStmt->bind_param("ii", $newStatus, $userId);

                    if ($updateStmt->execute()) {
                        $_SESSION['success_messages'] = "User status successfully updated.";
                    } else {
                        $_SESSION['error_messages'] = "Error updating user status: " . $updateStmt->error;
                    }

                    $updateStmt->close();
                } else {
                    $_SESSION['error_messages'] = "Error in preparing the update statement: " . $conn->error;
                }
            } else {
                $_SESSION['error_messages'] = "User not found.";
            }
        } else {
            $_SESSION['error_messages'] = "Error fetching user details: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['error_messages'] = "Error in preparing the fetch statement: " . $conn->error;
    }

    // Redirect back to the page where the user initiated the block
    header("Location: Admin_deleteUser.php");
    exit();
} else {
    $_SESSION['error_messages'] = "Invalid request.";
    // Redirect back to the page where the user initiated the block
    header("Location: Admin_deleteUser.php");
    exit();
}
?>
