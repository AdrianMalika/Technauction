<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
session_start();

if (!isset($_SESSION["isloggedin"])) {
    header("Location: sign-in.php");
    exit(); // Added exit() to stop script execution after redirection
}

require_once 'connection.php';
;
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <title>User Profile</title>
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

        <?php require_once 'Sidebar.php'; ?>

        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Profile</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
              <div class="row">
                    <div class="col-lg-4 col-xlg-3">
                        <div class="card">
                            <div class="card-body">
                                <center class="mt-4">
                                    <img src="assets/images/users/user.png" class="rounded-circle" width="150" />
                                    <p class='profiletext'>
                                    <p class='profiletext'><?php echo isset($_SESSION['FirstName']) ? $_SESSION['FirstName'] : ''; ?> <?php echo isset($_SESSION['LastName']) ? $_SESSION['LastName'] : ''; ?></p>
                                    </p>
                                </center>
                            </div>
                                                        <div>
                                <hr>
                            </div>
                            <div class="card-body">
                                <small class="text-muted">Email address</small>
                                <p class='profiletext'><?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?></p>
                                <small class="text-muted pt-4 db">Social Profile</small>
                                <br />
                                <button class="btn btn-circle btn-secondary"><i class="mdi mdi-facebook"></i></button>
                                <button class="btn btn-circle btn-secondary"><i class="mdi mdi-twitter"></i></button>
                                <button class="btn btn-circle btn-secondary"><i class="mdi mdi-youtube-play"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-xlg-9">
                        <div class="card">
                            <div class="card-body">
                            <?php
                                // Display success message
                                if (isset($_SESSION['update_success'])) {
                                    echo '<div class="alert alert-success">' . $_SESSION['update_success'] . '</div>';
                                    unset($_SESSION['update_success']);
                                }

                                // Display error message
                                if (isset($_SESSION['update_error'])) {
                                    echo '<div class="alert alert-danger">' . $_SESSION['update_error'] . '</div>';
                                    unset($_SESSION['update_error']);
                                }
                                ?>
                                <form class="form-horizontal form-material mx-2" method="POST"action="UpdateProfile.php">
                                
                                <label for="FirstName">First Name</label>
                                <div class="form-floating mb-2 p-0">
                                            <input type="text" name="FirstName" id="FirstName" class="form-control" required>
                                        </div>

                                        <label for="LastName">Last Name</label>
                                        <div class="form-floating mb-3 p-0">
                                            <input type="text" name="LastName" id="LastName" class="form-control"  required>
                                        </div>

                                        <label for="email">Email</label>
                                    <div class="form-floating mb-3 p-0">
                                            <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control"  required>
                                        </div>

                                        <label for="password">Password</label>
                                        <div class="form-floating mb-3 p-0">
                                            <input type="password" name="password" id="password" class="form-control"  required>
                                        </div>
                               
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success text-white">Update Profile</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer text-center">
               
                <a href="https://www.wrappixel.com"></a>.
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
