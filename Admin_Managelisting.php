<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
session_start();

if (!isset($_SESSION["isloggedin1"])) {
    header("Location: sign-in.php");
    exit(); // Added exit() to stop script execution after redirection
}

require_once 'connection.php';

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
    <title>Manage Products</title>
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

    <div id="main-wrapper" data-navbarbg="skin6" data-theme="light" data-layout="vertical" data-sidebartype="full"
        data-boxed-layout="full">
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
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#"
                                id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="assets/images/users/user.png" alt="user" class="rounded-circle" width="31">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end user-dd animated" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user me-1 ms-1"></i>My
                                    Profile</a>
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
                <div class="row">
                    <?php
                    $query = "SELECT p.id, p.image, p.Title, p.price,p.starting_price, p.description, p.state, p.category, u.Email AS user_email, CONCAT(u.FirstName, ' ', u.LastName) AS user_name
                    FROM products p
                    JOIN users u ON p.owner_id = u.Id
                    ORDER BY p.id DESC";
                


                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                        $product_details = $result->fetch_all(MYSQLI_ASSOC);
                        foreach ($product_details as $product_detail) {
                            echo '<br>';
                            echo '<div class="col-lg-4 col-10">';
                            echo '<div class="product-thumb">';
                            echo '<a href="product-detail.php">';
                            echo '<img src="' . $product_detail['image'] . '" class="img-fluid product-image" style="width: 500px; height: 300px; object-fit: cover;">';
                            echo '</a>';
                            echo '<div class="product-info">';
                            echo '<div class="title-price-row">';
                            echo '<h5 class="product-title mb-0">';
                            echo '<a href="product-detail.php" class="product-title-link">' . $product_detail['Title'] . '</a>';
                            echo '</h5>';
                            echo '<div class="price-row">';
                            echo '<span class="bid-label">Starting Bid:</span>';
                            echo '<span class="product-price">MK' . $product_detail['starting_price'] . '</span>';
                            echo '</div>';
                            echo '</div>';
                            echo '<div class="move_price">';
                            echo '<span class="bid-label">Current Bid Price:</span>';
                            echo '<span class="product-price">MK' . $product_detail['price'] . '</span>';
                            echo '</div>';
                            echo '<p class="product-p">' . $product_detail['description'] . '</p>';
                            echo '<p class="product-condition">Condition: ' . $product_detail['state'] . '</p>';
                            echo '<p class="product-category">Category: ' . $product_detail['category'] . '</p>';
                            echo '<p class="product-posted-by">Posted by: ' . $product_detail['user_name'] . ' (' . $product_detail['user_email'] . ')</p>';
                            echo '</div>';
                            echo '<div class="product-details">';
                            echo '<a href="Admin_deletelisting.php?id=' . $product_detail['id'] . '" class="btn btn-danger btn-sm product-button mt-2" onclick="return confirmDelete()">Delete</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '<br>';
                            echo '</div>';
                        }
                    } else {
                        echo '<div class="col-12"><p>No products available.</p></div>';
                    }

                    $conn->close();
                    ?>
                </div>
            </div>


            <footer class="footer text-center">
                All Rights Reserved by Nice admin. Designed and Developed by
                <a href="https://www.wrappixel.com">WrapPixel</a>.
            </footer>
        </div>
    </div>

    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this item?");
        }
    </script>
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <script src="dist/js/waves.js"></script>
    <script src="dist/js/sidebarmenu.js"></script>
    <script src="dist/js/custom.min.js"></script>
</body>

</html>
