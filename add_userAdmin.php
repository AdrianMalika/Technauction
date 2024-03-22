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
    <title>Monitor Products</title>
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
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user me-1 ms-1"></i>My Profile</a>
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
                        <h4 class="page-title">Add Admin</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Admin</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xlg-9">
                    <div class="card">
                        <div class="card-body">

                    <!-- Display Error Messages -->
                    <?php
                         if (isset($_SESSION['password_not_strong1'])) {
                           echo "<p class= 'wrong'>{$_SESSION['password_not_strong1']}</p>";
                             unset($_SESSION['password_not_strong1']);
                               }

                        if (isset($_SESSION['Email_taken1'])) {
                            echo "<p class= 'wrong'>{$_SESSION['Email_taken1']}</p>";
                                unset($_SESSION['Email_taken1']);
                                }

                        if (isset($_SESSION['registration_error1'])) {
                             echo "<p class= 'wrong'>{$_SESSION['registration_error1']}</p>";
                                 unset($_SESSION['registration_error1']);
                                 }

                        if (isset($_SESSION['registration_success1'])) {
                             echo "<p>{$_SESSION['registration_success1']} </p>";
                                 unset($_SESSION['registration_success1']);
                                   }
                    ?>

                    <form class="form-horizontal form-material mx-2" method="POST" action="Add_Admin.php">
                        <br>
                    <label for="UserName" class="form-label">User Name</label>
                     <div class="form-floating mb-3">
                            <input type="text" name="UserName" id="UserName" class="form-control" required>
                        </div>
<br>
                        <label for="User_Email" class="form-label">Email address</label>
                        <div class="form-floating mb-3"> 
                            <input type="email" name="email" id="User_Email" pattern="[^ @]*@[^ @]*" class="form-control" required>
                        </div>
<br>
                        <label for="User_password" class="form-label">Password</label>
                        <div class="form-floating mb-3 ">
                            <input type="password" name="password" id="User_password" class="form-control" required>
                        </div>
<br>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success text-white">Add Admin</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

            <footer class="footer text-center">
                All Rights Reserved by Nice admin. Designed and Developed by
                <a href="https://www.wrappixel.com">WrapPixel</a>.
            </footer>
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
