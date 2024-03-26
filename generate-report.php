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
        $query = "SELECT 
        p.Id AS product_id, 
        COALESCE(COUNT(b.id), 0) AS num_bids, 
        COALESCE(MAX(b.bid_amount), p.starting_price) AS winning_bid_price, 
        COALESCE(SUM(b.bid_amount), 0) AS total_revenue, 
        COALESCE(AVG(b.bid_amount), 0) AS average_bid_amount 
    FROM 
        products p 
    LEFT JOIN 
        bids b ON p.Id = b.product_id 
    GROUP BY 
        p.Id
    ";
    
        $result = mysqli_query($conn, $query);
    
        // Check if the query was successful
        if ($result) {
            // Initialize variable to store item report HTML
            $itemReport = '<h3>Item Report</h3><div class="table-responsive"><table class="table table-bordered table-striped"><thead><tr><th>Product ID</th><th>Number of Bids</th><th>Winning Bid Price (MK)</th><th>Total Revenue (MK)</th><th>Average Bid Amount (MK)</th></tr></thead><tbody>';
    
            // Check if there are any rows returned
            if (mysqli_num_rows($result) > 0) {
                // Loop through each row and display the data
                while ($row = mysqli_fetch_assoc($result)) {
                    // Format bid amounts to 2 decimal places with "MK"
                    $winningBidPriceMK = number_format($row['winning_bid_price'], 2) . ' MK'; 
                    $totalRevenueMK = number_format($row['total_revenue'], 2) . ' MK'; 
                    $averageBidAmountMK = number_format($row['average_bid_amount'], 2) . ' MK'; 
    
                    $itemReport .= "<tr><td>{$row['product_id']}</td><td>{$row['num_bids']}</td><td>{$winningBidPriceMK}</td><td>{$totalRevenueMK}</td><td>{$averageBidAmountMK}</td></tr>";
                }
            } else {
                // If no data available
                $itemReport .= '<tr><td colspan="5">No data available</td></tr>';
            }
    
            $itemReport .= '</tbody></table></div>';
    
            // Return the generated report
            echo json_encode(['report' => $itemReport]);
        } else {
            // Return error response if the query fails
            echo 'Failed to fetch item data.';
        }
    }
    
elseif ($type === 'bidder') {
        // Retrieve data from the database
        $query = "SELECT b.user_id, CONCAT(u.FirstName, ' ', u.LastName) AS FullName, COUNT(*) AS num_bids, 
                  SUM(b.bid_amount) AS total_bid_amount, AVG(b.bid_amount) AS average_bid_amount 
                  FROM bids b 
                  JOIN users u ON b.user_id = u.id 
                  GROUP BY b.user_id";
    
        $result = mysqli_query($conn, $query);
    
        // Check if there are any rows returned
        if (mysqli_num_rows($result) > 0) {
            // Initialize variable to store bidder activity report HTML
            $bidderReport = '<h3>Bidder Activity Report</h3><div class="table-responsive"><table class="table table-bordered table-striped"><thead><tr><th>User ID</th><th>Full Name</th><th>Number of Bids</th><th>Total Bid Amount (MK)</th><th>Average Bid Amount (MK)</th></tr></thead><tbody>';
    
            // Loop through each row and display the data
            while ($row = mysqli_fetch_assoc($result)) {
                // Format bid amounts to 2 decimal places with "MK"
                $totalBidAmountMK = number_format($row['total_bid_amount'], 2) . ' MK'; 
                $averageBidAmountMK = number_format($row['average_bid_amount'], 2) . ' MK'; 
    
                $bidderReport .= "<tr><td>{$row['user_id']}</td><td>{$row['FullName']}</td><td>{$row['num_bids']}</td><td>{$totalBidAmountMK}</td><td>{$averageBidAmountMK}</td></tr>";
            }
            $bidderReport .= '</tbody></table></div>';
    
            // Return the generated report
            echo json_encode(['report' => $bidderReport]);
        } else {
            // Return error response if no data available
            echo 'No data available';
        }
    }
}

// Close the database connection
mysqli_close($conn);
?>
