<?php
session_start();
require_once 'Connection.php';

// Check if admin or regular user is logged in
if (!isset($_SESSION["isloggedin"]) && !isset($_SESSION["isloggedin1"])) {
    header("Location: sign-in.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['product_id'])) {
    // Use prepared statement to prevent SQL injection
    $product_id = $_GET['product_id'];
  
    $stmt = $conn->prepare("SELECT 
    products.*, CONCAT(users.FirstName, ' ', users.LastName) AS highest_bidder,
    bids.user_id AS highest_bidder_id, products.Id AS product_id
    FROM products
    LEFT JOIN (
        SELECT product_id, MAX(bid_amount) AS max_bid
        FROM bids
        GROUP BY product_id
    ) AS max_bids ON products.Id = max_bids.product_id
    LEFT JOIN bids ON max_bids.product_id = bids.product_id AND max_bids.max_bid = bids.bid_amount
    LEFT JOIN users ON bids.user_id = users.id
    WHERE products.Id = ?");

    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        $highestBidderId = $product['product_id']; // Corrected variable name

        // Get the end time from the product details fetched from the database
        $endTimestamp = strtotime($product['end_time']);
        $now = time();

        // Adjust for timezone difference (if any)
        $endTimestampAdjusted = $endTimestamp - (2 * 3600); // Adjusting for 2 hours difference, change this value as per your timezone difference

        // Check if the auction has ended
        $auctionEnded = $endTimestampAdjusted < $now;

        if ($auctionEnded) {
            // Fetch highest bidder's email
            $highestBidderEmail = '';
            // Corrected variable name and added a check to ensure the key exists
            if (isset($product['highest_bidder_id'])) {
                $highestBidderId = $product['highest_bidder_id'];
                $stmt = $conn->prepare("SELECT Email FROM users WHERE id = ?");
                $stmt->bind_param("i", $highestBidderId);
                $stmt->execute();
                $stmt->store_result();
                if ($stmt->num_rows > 0) {
                    $stmt->bind_result($highestBidderEmail);
                    $stmt->fetch();
                }
            }

            // Construct notification message
            $notificationMessage = "Auction for product '{$product['Title']}' has ended.\n";
            // Changed $highestBidder to $product['highest_bidder']
            $notificationMessage .= "Highest Bidder: {$product['highest_bidder']}\n";
            $notificationMessage .= "Bidder Email: {$highestBidderEmail}\n";
            $notificationMessage .= "Bid Amount: MK{$product['price']}\n";
            $notificationMessage .= "Details: {$product['description']}\n";
            $notificationMessage .= "Condition: {$product['state']}";

            // Insert notification into admin notifications table
            $insertQuery = "INSERT INTO admin_notifications (admin_id, message, paid) VALUES (?, ?, 'NotPaid')";
            $stmt = $conn->prepare($insertQuery);
            $stmt->bind_param("is", $_SESSION['id'], $notificationMessage);
            $stmt->execute();
            $stmt->close();
        }
    } else {
        // Handle the case when the product is not found
        header("Location: products.php");
        exit();
    }
} else {
    // Handle the case when the product_id is not provided in the URL
    header("Location: products.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>PRODUCT DETAILS</title>
    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/slick.css"/>
    <link href="css/tooplate-little-fashion.css" rel="stylesheet">
</head>
<style>
.product-thumb {
    /* Ensure the container has a fixed width */
    width: 100%;
    /* Add any additional styling for the container */
}

.product-image {
    /* Ensure the image fills its container */
    width: 100%;
    height: 550px; /* Set the desired height */
    object-fit: cover; /* Ensure the whole image is visible without stretching */
}
</style>
<body>
<section class="preloader">
    <div class="spinner">
        <span class="sk-inner-circle"></span>
    </div>
</section>

<main>
    <?php require_once 'nav.php'; ?>
    <header class="site-header section-padding d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-12">
                    <h1>
                        <span class="d-block text-primary">We provide you</span>
                        <span class="d-block text-dark">Fashionable Stuffs</span>
                    </h1>
                </div>
            </div>
        </div>
    </header>

    <!-- Display notifications below the header -->
    <?php
    if (isset($_SESSION['notifications']) && is_array($_SESSION['notifications']) && !empty($_SESSION['notifications'])) {
        // If there are notifications, display them below the header
        echo '<div class="container mt-3">';
        foreach ($_SESSION['notifications'] as $notification) {
            $type = $notification['type'];
            $message = $notification['message'];
            echo '<div class="alert alert-' . $type . '" role="alert">' . $message . '</div>';
        }
        echo '</div>';

        // Clear all notifications after displaying
        unset($_SESSION['notifications']);
    }
    ?>
<div class="container mt-3">
    <!-- Product Detail Section -->
    <section class="product-detail section-padding">
        <div class="row">
            <div class="col-lg-6 col-12">
            <div class="product-thumb">
                <div class="image-wrapper">
                    <img src="<?php echo $product['image']; ?>" class="img-fluid product-image" alt="">
                </div>
            </div>
         </div>

            <div class="col-lg-6 col-12">
                <div class="product-info d-flex">
                    <div>
                        <h2 class="product-title mb-0"><?php echo $product['Title']; ?></h2>
                        <p class="lead mb-2">Condition: <?php echo $product['state']; ?></p>

                        <?php if (!empty($product['highest_bidder'])) : ?>
                            <p class="lead mb-2">Highest Bidder: <?php echo $product['highest_bidder']; ?></p>
                        <?php endif; ?>

                    </div>
                    <p class="product-price text-muted ms-auto mt-auto mb-5">Current Price: MK<?php echo $product['price']; ?></p>
                </div>

                <div class="product-description">
                    <strong class="d-block mt-4 mb-2">Description</strong>
                    <p class="lead mb-5"><?php echo $product['description']; ?></p>
                </div>

                <div class="col-lg-6 col-12">
                <!-- Display the countdown timer -->
                <div class="product-description">
                    <strong  class="d-block mt-4 mb-2">Remaining Time:</strong>
                    <div id="countdown"></div>
                </div>

                <?php if (!$auctionEnded) : ?>
                    <div class="product-cart-thumb row">
                    <div class="col-lg-6 col-12">
                        <div class="form-floating p-0">
                            <input type="text" name="Bid_amount" id="Bid_amount" class="form-control"
                                   placeholder="Amount" required>
                            <label for="Bid_amount">Amount</label>
                        </div>
                        <!-- Include the product_id in the bid form -->
                        <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                    </div>

                    <div class="col-lg-6 col-12 mt-4 mt-lg-0">
                        <!-- Add data attributes to store product_id and current bid -->
                        <button type="submit" class="btn custom-btn cart-btn place-bid-btn"
                                data-bs-toggle="modal" data-bs-target="#cart-modal"
                                data-product-id="<?php echo $product['product_id']; ?>"
                                data-current-bid="<?php echo $product['price']; ?>">
                            Place Bid
                        </button>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>
</main>

<?php require_once 'footer.php'; ?>

<!-- Add this script at the end of your HTML body -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var endTimestamp = <?php echo $endTimestampAdjusted; ?>;
        var countdownElement = document.getElementById('countdown');

        function updateCountdown() {
            var now = Math.floor(Date.now() / 1000); // Current timestamp in seconds
            var remainingTime = endTimestamp - now;

            if (remainingTime > 0) {
                var hours = Math.floor(remainingTime / 3600);
                var minutes = Math.floor((remainingTime % 3600) / 60);
                var seconds = remainingTime % 60;

                countdownElement.innerHTML = hours + 'h ' + minutes + 'm ' + seconds + 's';
            } else {
                countdownElement.innerHTML = 'Auction Ended';
            }
        }

        // Update countdown every second
        setInterval(updateCountdown, 1000);

        // Initial update
        updateCountdown();
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var placeBidBtn = document.querySelector('.place-bid-btn');

        placeBidBtn.addEventListener('click', function () {
            var productId = this.getAttribute('data-product-id');
            var currentBid = parseFloat(this.getAttribute('data-current-bid'));
            var bidAmountInput = document.getElementById('Bid_amount');
            var bidAmount = parseFloat(bidAmountInput.value);

            if (isNaN(bidAmount) || bidAmount <= currentBid) {
                alert('Please enter a valid bid amount greater than the current bid.');
                return;
            }
            // Redirect to process-bid.php with the bid details
            window.location.href = 'process-bid.php?product_id=' + productId + '&bid_amount=' + bidAmount;
        });
    });
</script>

<!-- JAVASCRIPT FILES -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/Headroom.js"></script>
<script src="js/jQuery.headroom.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/custom.js"></script>

</body>
</html>
