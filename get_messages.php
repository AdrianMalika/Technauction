<?php
session_start();
require_once 'connection.php';

// Get user ID from session
$userId = $_SESSION["id"];

// Prepare and execute SQL statement to retrieve messages for the logged-in user
$query = "SELECT sender_id, message_content FROM chat_messages WHERE receiver_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

// Fetch messages and store them in an array
$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = [
        "sender_id" => $row["sender_id"],
        "message_content" => $row["message_content"]
    ];
}

// Return messages as JSON
header('Content-Type: application/json');
echo json_encode($messages);
?>
