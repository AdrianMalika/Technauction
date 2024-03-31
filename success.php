<?php
// Check if the payment was successful (you may need to adjust this condition based on your payment processing mechanism)
$payment_successful = true; // For demonstration purposes, assuming payment is always successful

if ($payment_successful) {
    require_once 'Connection.php'; // Include database connection
    
    // Get the notification ID from the URL parameter
    if (isset($_GET["notification_id"]) && is_numeric($_GET["notification_id"])) {
        $notification_id = $_GET["notification_id"];
        
        // Update the payment status for the specific notification
        $query = "UPDATE admin_notifications SET Paid = 'Paid' WHERE id = ?";
        $stmt = $conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param('i', $notification_id);
            if ($stmt->execute()) {
                $stmt->close();
            } else {
                // Handle execution error
                die('Error: Failed to execute the query');
            }
        } else {
            // Handle preparation error
            die('Error: Failed to prepare the statement');
        }
    } else {
        // Handle case where notification ID is not provided or invalid
        die('Error: Notification ID is missing or invalid');
    }
} else {
    // Handle case where payment is not successful
    die('Error: Payment was not successful');
}
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <title>Payment Successful</title>
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <link href="dist/css/style.min.css" rel="stylesheet">
    <link href="dist/css/deco.css" rel="stylesheet">
</head>
<style>
    /* Center the text vertically and horizontally */
.page-wrapper {
    display: flex;
    align-items: center; /* Center vertically */
    justify-content: center; /* Center horizontally */
    height: 207px; /* Ensure the container takes up the full viewport height */
    text-align: center; /* Center the text */
}

/* Add margin to the paragraph */
.page-wrapper p {
    margin-top: 20px;
}

/* Style the link */
.page-wrapper a {
    color: blue; /* Change link color */
    text-decoration: underline; /* Add underline */
}

</style>
<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-5 align-self-center">
                </div>
                <div class="col-7 align-self-center">
                    <div class="d-flex align-items-center justify-content-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="page-wrapper">
    <div>
        <h1>Payment Successful!</h1>
        <p>Thank you for your payment.</p>
        <p>You can expect your order to be processed shortly.</p>
        <p>Click <a href="process_payment.php">here</a> to go to the home page.</p>
    </div>
</div>

    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <script src="dist/js/waves.js"></script>
    <script src="dist/js/sidebarmenu.js"></script>
    <script src="dist/js/custom.min.js"></script>
</body>

</html>
