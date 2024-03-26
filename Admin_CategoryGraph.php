<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION["isloggedin1"])) {
    header("Location: sign-in.php");
    exit(); 
}

require_once 'connection.php';

// Initialize all categories with count 0
$categories = ['Accessories', 'Clothing', 'Books', 'Art', 'Watches', 'Appliance', 'Electronics', 'Others'];
$categoryData = array_fill_keys($categories, 0);

// Query to get count of products in each category
$query = "SELECT category, COUNT(*) AS count FROM products GROUP BY category";
$result = mysqli_query($conn, $query);

// Update counts for categories with products
while ($row = mysqli_fetch_assoc($result)) {
    $categoryData[$row['category']] = $row['count'];
}

// Close the database connection
mysqli_close($conn);
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
                        <h4 class="page-title">Category Graph</h4>
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
                <a class="graph-link" href="Admin_graphReport.php">View System Graph</a>
            </div>

            <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12">
                    <canvas id="biddingChart" width="700" height="330"></canvas>
                   </div>
                </div>
            </div>

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
    // Category data from PHP
    var categoryData = <?php echo json_encode($categoryData); ?>;

    // Create chart
    const ctx = document.getElementById('biddingChart').getContext('2d');
    const biddingChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: Object.keys(categoryData), // Category names
            datasets: [{
                label: 'Number of Products',
                data: Object.values(categoryData), // Counts of products in each category
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Number of Products',
                        font: {
                            weight: 'bold' // Make the title bold
                        }
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Category',
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