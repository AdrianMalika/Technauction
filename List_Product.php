<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if user is logged in
if (!isset($_SESSION["isloggedin"])) {
    header("Location: sign-in.php");
    exit();
}

require_once 'connection.php';

// Function to add notification for all users except the current user
function addNotificationForAllExceptCurrentUser($message, $userId) {
    global $conn;
    $timestamp = date('Y-m-d H:i:s');
    
    // Insert notification for all users except the current user
    $query = "INSERT INTO notifications (user_id, message, timestamp) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Prepare error: " . $conn->error);
    }
    $stmt->bind_param("iss", $userId, $message, $timestamp); // corrected parameter order
    if (!$stmt->execute()) {
        die("Execute error: " . $stmt->error);
    }
    $stmt->close();
}


// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['Title'];
    $startingPrice = $_POST['StartingPrice'];
    $state = $_POST['state'];
    $category = $_POST['Category'];
    $description = $_POST['Description'];
    $auctionEndTime = $_POST['auction_end_time'];


    $userId = isset($_SESSION['id']) ? $_SESSION['id'] : null;
    $newProductMessage = "A new product has been added: $title. Click here to view it.";
       
    // Send notification to all users except the current user
    addNotificationForAllExceptCurrentUser($newProductMessage, $userId);

    $_SESSION['success_message'] = "Product added successfully!";
    header("Location: add_product.php");
    exit();
}
?>




<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Nice lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Nice admin lite design, Nice admin lite dashboard bootstrap 5 dashboard template">
        <meta name="description"
        content="Nice Admin Lite is powerful and clean admin dashboard template, inspired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>Add Product</title>
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <link href="dist/css/style.min.css" rel="stylesheet">
    <link href="dist/css/deco.css" rel="stylesheet">
</head>

<body>
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <!-- Main wrapper - style you can find in pages.scss -->
    <div id="main-wrapper" data-navbarbg="skin6" data-theme="light" data-layout="vertical" data-sidebartype="full" data-boxed-layout="full">
        <!-- Topbar header - style you can find in pages.scss -->
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header" data-logobg="skin5">
                  
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                        <i class="ti-menu ti-close"></i>
                    </a>

                    <div class="navbar-brand">      
                            <!-- Logo icon -->
                            <a class="navbar-brand" href="index.php">
                            <b class="logo-icon">
                                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                                <!-- Dark Logo icon -->
                                <img src="assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
                                <!-- Light Logo icon -->
                                <img src="assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />
                            </b>
                                <strong class='icontext'>Technauction</strong>
                            </a>
                    </div>
                </div>

                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin6">
                    <ul class="navbar-nav float-start me-auto">
                        
                    </ul>

                    <ul class="navbar-nav float-end">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="assets/images/users/user.png" alt="user" class="rounded-circle" width="31">
                            </a>

                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <aside class="left-sidebar" data-sidebarbg="skin5">
            <?php require_once 'Sidebar.php'; ?>
        </aside>

        <div class="page-wrapper">
        <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Monitor Products</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Monitor Products</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <!-- Start Page Content -->
                <div class="row">
                    <!-- Column -->
                    
                    <div class="col-lg-12 col-xlg-12 ">
                        <div class="card">
                            <div class="card-body">
                                <?php
                                if (isset($_SESSION['error_message'])) {
                                    echo '<p class="alert alert-danger">' . $_SESSION['error_message'] . '</p>';
                                    unset($_SESSION['error_message']);
                                }

                                if (isset($_SESSION['success_message'])) {
                                    echo '<p class="alert alert-success">' . $_SESSION['success_message'] . '</p>';
                                    unset($_SESSION['success_message']);
                                }
                                ?>

                                <form class="form-horizontal form-material mx-2" action="add_product.php" method="POST" enctype="multipart/form-data">
                                  <div class="form-group">
                                  <div class="form-floating my-4 select-group">
                                            <input type="text" name="Title" id="title" class="form-control"  required>
                                            <label for="title">Title</label>
                                        </div>

                                        <div class="form-floating my-4 select-group">
                                            <input type="number" name="StartingPrice" id="StartingPrice" class="form-control"  required>
                                            <label for="StartingPrice">Price(Mk)</label>
                                        </div>

                                        <div class="form-floating my-4 select-group">
                                        <select name="state" id="state" class="form-control" required>
                                            <option value="" disabled selected>Select Condition</option>
                                            <option value="New">New</option>
                                            <option value="Used - like new">Used -like new</option>
                                            <option value="Used - good">Used -good</option>
                                            <option value="Used - fier">Used -fier</option>
                                        </select>
                                        <label for="Condition">Condition</label>                                       
                                        </div>

                                        
                                        <div class="form-floating my-4 select-group">
                                       <select name="Category" id="Category" class="form-control" required>
                                        <option value="" disabled selected>Select Category</option>
                                            <option value="Accessories">Accessories</option>
                                            <option value="Clothes">Clothes</option>
                                            <option value="Books">Books</option>
                                            <option value="Art">Art</option>
                                            <option value="Watches">Watches</option>
                                            <option value="Appliance">Appliance</option>
                                            <option value="Electronics">Electronics</option>
                                            <option value="Others">Others</option>
                                        </select>
                                        <label for="Category">Category</label>  
                                        </div>


                                        <div class="form-floating my-4">
                                            <input type="text" name="Description" id="Description" class="form-control"  required>
                                            <label for="Description">Description</label>
                                        </div>

                                        <div class="form-floating my-4">
                                        <input type="file" id="image" name="image"  accept="image/*" required="required" >
                                        </div>

                                        <div class="form-group">
                                            <label for="auction_end_time">Auction End Time:</label>
                                            <input type="datetime-local" id="auction_end_time" name="auction_end_time" class="form-control" required>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                
                                                <button type="submit" class="btn btn-success text-white">Add product</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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