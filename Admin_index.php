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
    <title>Reports</title>
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <link href="dist/css/style.min.css" rel="stylesheet">
    <link href="dist/css/deco.css" rel="stylesheet">

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
                            <ul class="dropdown-menu dropdown-menu-end user-dd animated" aria-labelledby="navbarDropdown">
                                                               <li><a class="dropdown-item" href="SendEmail.php"><i class="fa fa-envelope me-1 ms-1"></i>Send Email</a></li>
                                <li><a class="dropdown-item" href="Admin_graphReport.php"><i class="fa fa-power-off me-1 ms-1"></i>Graph report</a></li>
                                <li><a class="dropdown-item" href="logout.php"><i class="fa fa-power-off me-1 ms-1"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <?php require_once 'Sidebar_Admin.php'; ?>

        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">System Reports</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">System Reports</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <button id="generateBidReport" onclick="generateReport('bid')">Generate Bid Report</button>
                        <button id="generateItemReport" onclick="generateReport('item')">Generate Item Report</button>
                        <button id="generateBidderActivityReport" onclick="generateReport('bidder-activity')">Bidder Activity Report</button>
                        <div id="reportContainer"></div>
                    </div>
                </div>
            </div>

            <button id="printReport">Print/Save Report</button>

            <footer class="footer text-center">
                All Rights Reserved by Technauction. Designed and Developed by
                <a href="#">Technauction</a>.
            </footer>
        </div>

        <script src="assets/libs/jquery/dist/jquery.min.js"></script>
        <script src="assets/libs/jquery/dist/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="assets/extra-libs/sparkline/sparkline.js"></script>
        <script src="dist/js/waves.js"></script>
        <script src="dist/js/sidebarmenu.js"></script>
        <script src="dist/js/custom.min.js"></script>

        <script>
    document.getElementById("generateBidReport").addEventListener("click", function() {
        generateReport("bid");
    });

    document.getElementById("generateItemReport").addEventListener("click", function() {
        generateReport("item");
    });

    document.getElementById("generateBidderActivityReport").addEventListener("click", function() {
        generateReport("bidder");
    });

    document.getElementById("printReport").addEventListener("click", function() {
    printReport();
        });

        function printReport() {
            // Open a new window for printing
            var printWindow = window.open('', '_blank');
            // Get the content of the report container
            var reportContent = document.getElementById("reportContainer").innerHTML;
            // Include CSS styles
            var styles = document.head.getElementsByTagName("link");
            var styleContent = '';
            for (var i = 0; i < styles.length; i++) {
                if (styles[i].rel === "stylesheet") {
                    styleContent += styles[i].outerHTML;
                }
            }
            // Write the content and styles into the new window
            printWindow.document.write('<html><head><title>Report</title>' + styleContent + '</head><body>' + reportContent + '</body></html>');
            // Close the document after printing
            printWindow.document.close();
            // Print the window
            printWindow.print();
        }

    function generateReport(type) {
        // Show preloader
        document.querySelector('.preloader').style.display = 'block';

        // Send AJAX request to generate report
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "generate-report.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Parse JSON response
                    var response = JSON.parse(xhr.responseText);
                    // Display the generated report
                    document.getElementById("reportContainer").innerHTML = response.report;
                } else {
                    console.error("Failed to generate report: " + xhr.statusText);
                }
                // Hide preloader
                document.querySelector('.preloader').style.display = 'none';
            }
        };
        xhr.send("type=" + type); // Send the type of report to generate
    }
</script>


</body>


</html>
