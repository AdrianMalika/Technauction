<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home - Technauction</title>
    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/slick.css" />
    <link href="css/tooplate-little-fashion.css" rel="stylesheet">
</head>

<body>

    <section class="preloader">
        <div class="spinner">
            <span class="sk-inner-circle"></span>
        </div>
    </section>

    <main>

        <?php require_once 'nav.php'; ?>

        <section class="slick-slideshow">
            <div class="slick-custom">
                <img src="images/slideshow/download.webp" class="img-fluid" alt="">
                <div class="slick-bottom">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-10">
                                <h1 class="slick-title">Enhance Your Bidding Experience</h1>
                                <p class="lead text-white mt-lg-3 mb-lg-5">Discover the future of auctions with Technauction.</p>
                                <a href="about.php" class="btn custom-btn">Learn more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="slick-custom">
                <img src="images/slideshow/1.jpg" class="img-fluid" alt="">
                <div class="slick-bottom">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-10">
                                <h1 class="slick-title">Experience Innovation</h1>
                                <p class="lead text-white mt-lg-3 mb-lg-5">Discover unparalleled design and functionality for an enriched bidding adventure.</p>
                                <a href="product.html" class="btn custom-btn">Explore</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="slick-custom">
                <img src="images/slideshow/two-business-partners-working-together-office-computer.jpeg" class="img-fluid" alt="">
                <div class="slick-bottom">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-10">
                                <h1 class="slick-title">Connect with Technauction</h1>
                                <p class="lead text-white mt-lg-3 mb-lg-5">Join our community for a top-tier auction experience.</p>
                                <a href="faq.php" class="btn custom-btn">Connect</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="about section-padding">
            <div class="container">
                <div class="row">

                    <div class="col-12 text-center">
                        <h2 class="mb-5">Get started with <span>Technauction</span></h2>
                    </div>

                    <div class="col-lg-2 col-12 mt-auto mb-auto">
                        <ul class="nav nav-pills mb-5 mx-auto justify-content-center align-items-center" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Introduction</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-youtube-tab" data-bs-toggle="pill" data-bs-target="#pills-youtube" type="button" role="tab" aria-controls="pills-youtube" aria-selected="true">How we work?</button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-skill-tab" data-bs-toggle="pill" data-bs-target="#pills-skill" type="button" role="tab" aria-controls="pills-skill" aria-selected="false">Capabilities</button>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-10 col-12">
                        <div class="tab-content mt-2" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                                <div class="row">
                                    <div class="col-lg-7 col-12">
                                        <img src="images/pim-chu-z6NZ76_UTDI-unsplash.jpeg" class="img-fluid" alt="">
                                    </div>

                                    <div class="col-lg-5 col-12">
                                        <div class="d-flex flex-column h-100 ms-lg-4 mt-lg-0 mt-5">
                                            <h4 class="mb-3">Welcome to <span>Technauction</span></h4>

                                            <p>Technauction offers a unique online auction platform, providing an immersive and innovative bidding experience.</p>

                                            <p>Explore our platform's features and discover the future of online auctions.</p>

                                            <div class="mt-2 mt-lg-auto">
                                                <a href="about.php" class="custom-link mb-2">
                                                    Learn more about us
                                                    <i class="bi-arrow-right ms-2"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-youtube" role="tabpanel" aria-labelledby="pills-youtube-tab">

                                <div class="row">
                                    <div class="col-lg-7 col-12">
                                        <div class="ratio ratio-16x9">
                                        </div>
                                    </div>

                                    <div class="col-lg-5 col-12">
                                        <div class="d-flex flex-column h-100 ms-lg-4 mt-lg-0 mt-5">
                                            <h4 class="mb-3">Discover <span>Technauction</span></h4>

                                            <p>Take a behind-the-scenes look at Technauction and how our platform works.</p>

                                            <p>Learn about the unique features that make us stand out in the online auction industry.</p>

                                            <div class="mt-2 mt-lg-auto">
                                                <a href="faq.php" class="custom-link mb-2">
                                                    Join us on this journey
                                                    <i class="bi-arrow-right ms-2"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-skill" role="tabpanel" aria-labelledby="pills-skill-tab">
                                <div class="row">
                                    <div class="col-lg-7 col-12">
                                        <img src="images/cody-lannom-G95AReIh_Ko-unsplash.jpeg" class="img-fluid" alt="">
                                    </div>

                                    <div class="col-lg-5 col-12">
                                        <div class="d-flex flex-column h-100 ms-lg-4 mt-lg-0 mt-5">
                                            <h4 class="mb-3">Explore <span>Technauction</span></h4>

                                            <p>Technauction is equipped with cutting-edge capabilities to enhance your bidding experience.</p>

                                            <div class="skill-thumb mt-3">
                                                <strong>Immersive Bidding</strong>
                                                <span class="float-end">90%</span>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%;"></div>
                                                </div>

                                                <strong>Innovative Features</strong>
                                                <span class="float-end">80%</span>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div>
                                                </div>

                                                <strong>Community Engagement</strong>
                                                <span class="float-end">85%</span>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%;"></div>
                                                </div>
                                            </div>

                                            <div class="mt-2 mt-lg-auto">
                                                <a href="about.php" class="custom-link mb-2">
                                                    Discover more features
                                                    <i class="bi-arrow-right ms-2"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="front-product">
            <div class="container-fluid p-0">
                <div class="row align-items-center">

                    <div class="col-lg-6 col-12">
                        <img src="images/retail-shop-owner-mask-social-distancing-shopping.jpg" class="img-fluid" alt="">
                    </div>

                    <div class="col-lg-6 col-12">
                        <div class="px-5 py-5 py-lg-0">

                            <h2 class="mb-4"><span>Explore</span> Technauction</h2>

                            <p class="lead mb-4">Join us on this exciting journey and explore the future of online auctions.</p>

                            <a href="about.php" class="custom-link">
                                Explore Now
                                <i class="bi-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="featured-product section-padding">
            <div class="container">
                <div class="row">

                    <div class="col-12 text-center">
                        <h2 class="mb-5">Featured Products</h2>
                    </div>

                    <div class="col-lg-4 col-12 mb-3">
                        <div class="product-thumb">
                            <a href="product-detail.php">
                                <img src="images/product/evan-mcdougall-qnh1odlqOmk-unsplash.jpeg" class="img-fluid product-image" alt="">
                            </a>

                            <div class="product-top d-flex">
                                <span class="product-alert me-auto">New Arrival</span>

                                <a href="#" class="bi-heart-fill product-icon"></a>
                            </div>

                            <div class="product-info d-flex">
                                <div>
                                    <h5 class="product-title mb-0">
                                        <a href="product-detail.php" class="product-title-link">Tree pot</a>
                                    </h5>

                                    <p class="product-p">Original package design from house</p>
                                </div>

                                <small class="product-price text-muted ms-auto mt-auto mb-5">$25</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-12 mb-3">
                        <div class="product-thumb">
                            <a href="product-detail.php">
                                <img src="images/product/jordan-nix-CkCUvwMXAac-unsplash.jpeg" class="img-fluid product-image" alt="">
                            </a>

                            <div class="product-top d-flex">
                                <span class="product-alert">Low Price</span>

                                <a href="#" class="bi-heart-fill product-icon ms-auto"></a>
                            </div>

                            <div class="product-info d-flex">
                                <div>
                                    <h5 class="product-title mb-0">
                                        <a href="product-detail.php" class="product-title-link">Fashion Set</a>
                                    </h5>

                                    <p class="product-p">Costume Package</p>
                                </div>

                                <small class="product-price text-muted ms-auto mt-auto mb-5">$35</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-12">
                        <div class="product-thumb">
                            <a href="product-detail.php">
                                <img src="images/product/nature-zen-3Dn1BZZv3m8-unsplash.jpeg" class="img-fluid product-image" alt="">
                            </a>

                            <div class="product-top d-flex">
                                <a href="#" class="bi-heart-fill product-icon ms-auto"></a>
                            </div>

                            <div class="product-info d-flex">
                                <div>
                                    <h5 class="product-title mb-0">
                                        <a href="product-detail.php" class="product-title-link">Juice Drinks</a>
                                    </h5>

                                    <p class="product-p">Nature made another world</p>
                                </div>

                                <small class="product-price text-muted ms-auto mt-auto mb-5">$45</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 text-center">
                        <a href="about.php" class="view-all">View All Products</a>
                    </div>

                </div>
            </div>
        </section>

    </main>

    <?php require_once 'footer.php'; ?>

    <!-- JAVASCRIPT FILES -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/Headroom.js"></script>
    <script src="js/jQuery.headroom.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/custom.js"></script>

</body>

</html>
