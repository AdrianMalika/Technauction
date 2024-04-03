<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION["isloggedin1"])) {
    header("Location: sign-in.php");
    exit(); 
}

require_once 'connection.php';

// Fetch feedback data from the database
$query = "SELECT * FROM messages";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5,
        css3 dashboard, bootstrap 5 dashboard, Nice lite admin bootstrap 5 dashboard template, frontend, responsive bootstrap 5 admin template,
         Nice admin lite design, Nice admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description" content="Nice Admin Lite is a powerful and clean admin dashboard template, inspired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>User Feedback</title>
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
                        <h4 class="page-title">User Feedback</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">User Feedback</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Display feedback data -->
            <div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">User Feedback</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Time</th> <!-- Added Time column -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Display feedback data
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["name"] . "</td>";
                                        echo "<td>" . $row["email"] . "</td>";
                                        echo "<td>" . $row["message"] . "</td>";
                                        echo "<td>" . $row["created_at"] . "</td>"; //Displaying Time 
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>No feedback available</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                                

            <!-- Footer Section -->
            <footer class="footer text-center">
                All Rights Reserved by Technauction. Designed and Developed by
                <a href="#">Technauction</a>.
            </footer>
        </div>

        <!-- JavaScript Section -->
        <script src="assets/libs/jquery/dist/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="assets/extra-libs/sparkline/sparkline.js"></script>
        <script src="dist/js/waves.js"></script>
        <script src="dist/js/sidebarmenu.js"></script>
        <script src="dist/js/custom.min.js"></script>
    </div>
</body>

</html>

<?php
// Close database connection
$conn->close();
?>
