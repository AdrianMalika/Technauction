<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
session_start();

require_once 'connection.php';

// Function to add notification for all users except the current user
function addNotificationForAllExceptCurrentUser($message, $currentUserId, $productId) {
    global $conn;
    $timestamp = date('Y-m-d H:i:s');
    
    // Insert notification for all users except the current user
    $query = "INSERT INTO notifications (user_id, message, timestamp, product_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        $_SESSION['error_message'] = "Error in preparing the SQL statement.";
        error_log("SQL Error: " . $conn->error);
        return false;
    }
    $stmt->bind_param("isss", $currentUserId, $message, $timestamp, $productId); // Corrected parameter order and added product_id
    if (!$stmt->execute()) {
        $_SESSION['error_message'] = "Error in executing the SQL statement.";
        error_log("SQL Error: " . $stmt->error);
        return false;
    }
    $stmt->close();
    return true;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = isset($_POST["Title"]) ? $_POST["Title"] : null;
    $startingPrice = isset($_POST["StartingPrice"]) ? $_POST["StartingPrice"] : null; // Added starting price field
    $condition = isset($_POST["state"]) ? $_POST["state"] : null;
    $category = isset($_POST["Category"]) ? $_POST["Category"] : null;
    $description = isset($_POST["Description"]) ? $_POST["Description"] : null;
    $userId = isset($_SESSION['id']) ? $_SESSION['id'] : null;

    // Validate input data more thoroughly
    if (!$name || !is_numeric($startingPrice) || !$condition || !$category || !$description || !$userId) {
        $_SESSION['error_message'] = "Invalid input data.";
        header("Location: List_Product.php");
        exit();
    }

    // Set the initial price to be the same as the starting price
    $price = $startingPrice;

    // Check if the image file was uploaded successfully
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES["image"]["tmp_name"];
        $imageFileName = $_FILES["image"]["name"];
        $uploadPath = "items/" . $imageFileName;

        // Additional checks for file upload
        if (move_uploaded_file($imageTmpPath, $uploadPath)) {
            $auctionEndTime = $_POST['auction_end_time'];

            // Convert the string to a DateTime object
            $auctionEndDateTime = new DateTime($auctionEndTime);

            // Format the DateTime object to MySQL DATETIME format
            $formattedAuctionEndTime = $auctionEndDateTime->format('Y-m-d H:i:s');

            // Include the end time in your INSERT query
            $query = "INSERT INTO products (Title, Price, starting_price, state, category, description, owner_id, image, end_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);

            if ($stmt) {
                $stmt->bind_param("sssssssss", $name, $price, $startingPrice, $condition, $category, $description, $userId, $uploadPath, $formattedAuctionEndTime);

                if ($stmt->execute()) {
                    $newProductId = $conn->insert_id; // Get the ID of the newly inserted product
                    $stmt->close();
                    // Notification message
                    $newProductMessage = "A new product has been added: $name. Click here to view it.";
                    // Send notification to all users except the current user
                    addNotificationForAllExceptCurrentUser($newProductMessage, $userId, $newProductId); // Pass the new product ID
                    $_SESSION['success_message'] = "Property Successfully Added";
                    $_SESSION['new_products'] = true;
                } else {
                    $_SESSION['error_message'] = "Error in executing the SQL statement.";
                    // Log detailed error information
                    error_log("SQL Error: " . $stmt->error);
                }
            } else {
                $_SESSION['error_message'] = "Error in preparing the SQL statement.";
                // Log detailed error information
                error_log("SQL Error: " . $conn->error);
            }
        } else {
            $_SESSION['error_message'] = "Failed to move uploaded image.";
        }
    } else {
        // Handle file upload errors
        switch ($_FILES["image"]["error"]) {
            case UPLOAD_ERR_INI_SIZE:
                $_SESSION['error_message'] = "Image upload failed. The uploaded file exceeds the upload_max_filesize directive in php.ini.";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $_SESSION['error_message'] = "Image upload failed. The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.";
                break;
            case UPLOAD_ERR_PARTIAL:
                $_SESSION['error_message'] = "Image upload failed. The uploaded file was only partially uploaded.";
                break;
            case UPLOAD_ERR_NO_FILE:
                $_SESSION['error_message'] = "Image upload failed. No file was uploaded.";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $_SESSION['error_message'] = "Image upload failed. Missing a temporary folder.";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $_SESSION['error_message'] = "Image upload failed. Failed to write file to disk.";
                break;
            case UPLOAD_ERR_EXTENSION:
                $_SESSION['error_message'] = "Image upload failed. A PHP extension stopped the file upload.";
                break;
            default:
                $_SESSION['error_message'] = "Image upload failed. Unknown error.";
                break;
        }
    }

    header("Location: List_Product.php");
    exit();
}
?>
