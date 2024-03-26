<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION["isloggedin1"])) {
    header("Location: sign-in.php");
    exit(); 
}

require_once 'connection.php';
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <title>Bidding System Graph Report</title>
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <link href="dist/css/style.min.css" rel="stylesheet">
    <link href="dist/css/deco.css" rel="stylesheet">
    <link href="dist/css/looks.css" rel="stylesheet">

</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper" data-navbarbg="skin6" data-theme="light" data-layout="vertical" data-sidebartype="full" data-boxed-layout="full">
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header" data-logobg="skin5">
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                        <i class="ti-menu ti-close"></i>
                    </a>

                    <div class="navbar-brand">
                        <!-- Logo icon -->
                        <a class="navbar-brand" href="index.php">
                            <strong class='icontext'>Technauction</strong>
                        </a>
                    </div>
                </div>

                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin6">
                    <ul class="navbar-nav float-start me-auto">
                        <li class="nav-item search-box">
                            <form class="app-search position-absolute">
                                <input type="text" class="form-control" placeholder="Search &amp; enter">
                                <a class="srh-btn">
                                    <i class="ti-close"></i>
                                </a>
                            </form>
                        </li>
                    </ul>

                    <ul class="navbar-nav float-end">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="assets/images/users/user.png" alt="user" class="rounded-circle" width="31">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end user-dd animated"
                                aria-labelledby="navbarDropdown">
                                                               <li><a class="dropdown-item" href="SendEmail.php"><i class="fa fa-envelope me-1 ms-1"></i>Send Email</a></li>
                                <li><a class="dropdown-item" href="Admin_graphReport.php"><i class="fa fa-power-off me-1 ms-1"></i>Graph report</a></li>
                                <li><a class="dropdown-item" href="logout.php"><i class="fa fa-power-off me-1 ms-1"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <?php require_once 'Sidebar_admin.php'; ?>

        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Bidding System Graph Report</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Graph Report</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="right">
                <a class="graph-link" href="Admin_CategoryGraph.php">View Category Graph</a>
            </div>

            

            <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12">
                    <canvas id="biddingChart" width="700" height="330"></canvas>
                   </div>
                </div>
            </div>


            <?php
                // Retrieve data from the database
                $queryTotalBids = "SELECT COUNT(*) AS total_bids FROM bids";
                $queryTotalRevenue = "SELECT SUM(bid_amount) AS total_revenue FROM bids";

                $resultTotalBids = mysqli_query($conn, $queryTotalBids);
                $resultTotalRevenue = mysqli_query($conn, $queryTotalRevenue);

                if ($resultTotalBids && $resultTotalRevenue) {
                    $rowTotalBids = mysqli_fetch_assoc($resultTotalBids);
                    $rowTotalRevenue = mysqli_fetch_assoc($resultTotalRevenue);

                    $totalBids = $rowTotalBids['total_bids'];
                    $totalRevenue = $rowTotalRevenue['total_revenue'];

                    // Assuming you don't have a 'successful' status column
                    // Set successfulBids to a fixed value or calculate based on your criteria
                    $successfulBids = 10; // Example value
                }
                ?>
        <footer class="footer text-center">
            All Rights Reserved by Technauction. Designed and Developed by
            <a href="#">Technauction</a>.
        </footer>
    </div>

    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <script src="dist/js/waves.js"></script>
    <script src="dist/js/sidebarmenu.js"></script>
    <script src="dist/js/custom.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    
    <script>
        // PHP code to retrieve data
        <?php
            require_once 'connection.php';
            $query = "SELECT DATE(created_at) AS bid_date, SUM(bid_amount) AS total_amount FROM bids GROUP BY DATE(created_at)";
            $result = mysqli_query($conn, $query);
            $data = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $data[$row['bid_date']] = $row['total_amount'];
            }
            mysqli_close($conn);
         
        ?>
        // JavaScript code to create the chart
        var canvas = document.getElementById('biddingChart');
var ctx = canvas.getContext('2d');

var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode(array_keys($data)); ?>,
        datasets: [{
            label: 'Total Bid Amount',
            data: <?php echo json_encode(array_values($data)); ?>,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Date',
                    font: {
                        weight: 'bold' // Make the title bold
                    }
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Total Bid Amount',
                    font: {
                        weight: 'bold' // Make the title bold
                    }
                }
            }
        }
    }
});

    </script>
</body>

</html>