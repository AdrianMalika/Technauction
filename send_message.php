<?php
session_start();
require_once 'connection.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the 'receiverId' and 'message' parameters are set and not empty
    if (isset($_POST["receiverId"]) && isset($_POST["message"]) && !empty($_POST["receiverId"]) && !empty($_POST["message"])) {
        // Get sender ID from session
        $senderId = $_SESSION["id"];
        $receiverId = $_POST["receiverId"];
        $message = $_POST["message"];

        // Prepare and execute SQL statement to insert message into the database
        $query = "INSERT INTO chat_messages (sender_id, receiver_id, message_content) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iis", $senderId, $receiverId, $message);

        if ($stmt->execute()) {
            // Message sent successfully
            http_response_code(200);
            exit("Message sent successfully");
        } else {
            // Error sending message
            http_response_code(500);
            exit("Error sending message");
        }
    } else {
        // Required parameters are missing or empty
        http_response_code(400);
        exit("Receiver ID and message content are required");
    }
} else {
    // Invalid request method
    http_response_code(405);
    exit("Method Not Allowed");
}
?>
