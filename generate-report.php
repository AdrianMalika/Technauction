<?php
// Include connection to the database
require_once 'connection.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['type'])) {
    $type = $_POST['type'];

    // Generate bid report
    if ($type === 'bid') {
        // Retrieve bid data from the database
        $query = "SELECT b.id, b.user_id, b.product_id, b.bid_amount, b.created_at, u.FirstName, u.LastName
        FROM bids b
        JOIN users u ON b.user_id = u.id
        ORDER BY b.created_at DESC";

        $result = mysqli_query($conn, $query);

        if ($result) {
            // Initialize variables to store the bid report HTML and highest bidders data
            $bidReport = '<h3>Bid Report</h3><div class="table-responsive"><table class="table table-bordered table-striped"><thead><tr><th>Bid ID</th><th>First Name</th><th>Last Name</th><th>Product ID</th><th>Bid Amount</th><th>Created At</th></tr></thead><tbody>';
            $highestBiddersHTML = '';

            // Fetch highest bidder for each item and calculate total money made each day
            $highestBidders = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $productId = $row['product_id'];
                $bidAmount = $row['bid_amount'];
                $createdDate = date('Y-m-d', strtotime($row['created_at']));

                // Update highest bidder
                if (!isset($highestBidders[$productId]) || $bidAmount > $highestBidders[$productId]['bid_amount']) {
                    $highestBidders[$productId] = $row;
                }

                // Generate HTML for each bid
                $bidAmountMK = number_format($row['bid_amount'], 2) . ' MK'; 
                $bidReport .= "<tr><td>{$row['id']}</td><td>{$row['FirstName']}</td><td>{$row['LastName']}</td><td>{$row['product_id']}</td><td>{$bidAmountMK}</td><td>{$row['created_at']}</td></tr>";
            }
            $bidReport .= '</tbody></table></div>';

            // Display highest bidders for each item in a table
            $bidReport .= '<h3>Highest Bidders for Each Item</h3><div class="table-responsive"><table class="table table-bordered table-striped"><thead><tr><th>Product ID</th><th>Highest Bidder</th><th>Bid Amount</th></tr></thead><tbody>';
            foreach ($highestBidders as $productId => $bidder) {
                $bidAmountMK = number_format($bidder['bid_amount'], 2) . ' MK'; 
                $highestBiddersHTML .= "<tr><td>{$productId}</td><td>{$bidder['FirstName']} {$bidder['LastName']}</td><td>{$bidAmountMK}</td></tr>";
            }
            $bidReport .= $highestBiddersHTML;
            $bidReport .= '</tbody></table></div>';

            // Return the generated report
            echo json_encode(['report' => $bidReport]);
        } else {
            // Return error response if query fails
            echo 'Failed to fetch bid data.';
        }
    } elseif ($type === 'item') {
        // Retrieve data from the database
        $query = "SELECT product_id, COUNT(*) AS num_bids, SUM(bid_amount) AS total_revenue, AVG(bid_amount) AS average_bid_amount FROM bids GROUP BY product_id";
        $result = mysqli_query($conn, $query);

        // Check if there are any rows returned
        if (mysqli_num_rows($result) > 0) {
            // Initialize variable to store item report HTML
            $itemReport = '<h3>Item Report</h3><div class="table-responsive"><table class="table table-bordered table-striped"><thead><tr><th>Product ID</th><th>Number of Bids</th><th>Total Revenue</th><th>Average Bid Amount</th></tr></thead><tbody>';

            // Loop through each row and display the data
            while ($row = mysqli_fetch_assoc($result)) {
                $itemReport .= "<tr><td>{$row['product_id']}</td><td>{$row['num_bids']}</td><td>{$row['total_revenue']}</td><td>{$row['average_bid_amount']}</td></tr>";
            }
            $itemReport .= '</tbody></table></div>';

            // Return the generated report
            echo json_encode(['report' => $itemReport]);
        } else {
            // Return error response if no data available
            echo 'No data available';
        }
    } else {
        // Return error response if the type parameter is invalid
        echo 'Invalid report type.';
    }
} else {
    // Return error response if the request method is not POST or type parameter is missing
    echo 'Invalid request.';
}

// Close the database connection
mysqli_close($conn);
?>
