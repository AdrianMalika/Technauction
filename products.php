<?php
session_start();

$category = isset($_GET['category']) ? $_GET['category'] : 'all';

require_once 'connection.php';

$query = "SELECT * FROM products";

if ($category !== 'all') {
    $query .= " WHERE category = '$category'";
}

$query .= " ORDER BY id DESC";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>PRODUCT</title>
    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha384-oG2/nCEd5Pz6KrCA1EL1GY3sPhe8pt6p3F5yvITZn3FUVAHF3e7N2AMr1gSJCvTC" crossorigin="anonymous">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/slick.css"/>
    <link href="css/tooplate-little-fashion.css" rel="stylesheet">
    <link href="dist/css/looks.css" rel="stylesheet">
</head>
<body>
 
    <!-- Navigation Section -->
    <?php require_once 'nav.php'; ?>

    <!-- Header Section -->
    <header class="site-header section-padding d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-12">
                    <h1>
                        <span class="d-block text-primary">Choose your</span>
                        <span class="d-block text-dark">favorite stuffs</span>
                    </h1>
                </div>
            </div>
        </div>
    </header>
        <!-- Category links/buttons -->
        <div class="category-links">
            <a href="products.php?category=all">All</a>
            <a href="products.php?category=Accessories">Accessories</a>
            <a href="products.php?category=clothing">Clothing</a>
            <a href="products.php?category=Books">Books</a>
            <a href="products.php?category=Art">Art</a>
            <a href="products.php?category=watches">Watches</a>
            <a href="products.php?category=appliance">Appliance</a>
            <a href="products.php?category=electronics">Electronics</a>
            <!-- Add more category links as needed -->
        </div>

        <div class="search-form">
            <input type="search" id="search-box" placeholder="Search here..">
            <label for="search-box" class="fas fa-search"></label>
        </div>


    <!-- Product section -->
    <section class="products section-padding">
    <div class="container">
        <div class="row" id="product-container">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-lg-4 col-10">';
                    echo '<div class="product-thumb">';
                    echo '<a href="product-detail.php?product_id=' . $row['Id'] . '">';
                    echo '<img src="' . $row['image'] . '" class="img-fluid product-image" style="width: 500px; height: 300px; object-fit: cover;">';
                    echo '</a>';
                    echo '<div class="product-info">';
                    echo '<div class="title-price-row">';
                    echo '<h5 class="product-title mb-0">';
                    echo '<a href="product-detail.php" class="product-title-link">' . $row['Title'] . '</a>';
                    echo '</h5>';
                    echo '<div class="price-row">';
                    echo '<span class="bid-label">Starting Bid:</span>';
                    echo '<span class="product-price">MK' . $row['starting_price'] . '</span>';
                    echo '</div>';
                    echo '</div>';
                    echo '<p class="product-p">' . $row['description'] . '</p>';
                    echo '</div>';
                    echo '<div class="product-details">';
                    echo '<a href="product-detail.php?product_id=' . $row['Id'] . '" class="product-title-link" style="color: white;">Place Bid</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<div class="col-12"><p>No products available for this category.</p></div>';
            }
            ?>
        </div>
    </div>
</section>


    <!-- Footer Section -->
    <?php require_once 'footer.php'; ?>

    <!-- JAVASCRIPT FILES -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/Headroom.js"></script>
    <script src="js/jQuery.headroom.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/custom.js"></script>

    <!-- Add this JavaScript code at the end of your HTML body -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get references to the search input and the product container
            var searchBox = document.getElementById('search-box');
            var productContainer = document.getElementById('product-container');

            // Add event listener to the search input
            searchBox.addEventListener('input', function () {
                var searchTerm = searchBox.value.toLowerCase(); // Convert search query to lowercase for case-insensitive comparison

                // Loop through each product and check if it matches the search query
                Array.from(productContainer.children).forEach(function (product) {
                    var productName = product.querySelector('.product-title').textContent.toLowerCase(); // Get product name and convert to lowercase
                    var productDescription = product.querySelector('.product-p').textContent.toLowerCase(); // Get product description and convert to lowercase

                    // If the product name or description contains the search query, display the product; otherwise, hide it
                    if (productName.includes(searchTerm) || productDescription.includes(searchTerm)) {
                        product.style.display = 'block';
                    } else {
                        product.style.display = 'none';
                    }
                });
            });
        });
    </script>

</body>
</html>
