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
    <title>FAQ - Technauction</title>
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

        <header class="site-header section-padding d-flex justify-content-center align-items-center">
            <div class="container">
                <div class="row">

                    <div class="col-lg-10 col-12">
                        <h1>
                            <span class="d-block text-primary">Frequently Asked Questions</span>
                            <span class="d-block text-dark">about Technauction</span>
                        </h1>
                    </div>
                </div>
            </div>
        </header>

        <section class="faq section-padding">
            <div class="container">
                <div class="row">

                    <div class="col-lg-8 col-12">
                        <h2>General Info.</h2>

                        <div class="accordion" id="accordionGeneral">
                            <!-- Question 1 -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionGeneralOne" aria-expanded="true" aria-controls="accordionGeneralOne">
                                        What is Technauction?
                                    </button>
                                </h2>

                                <div id="accordionGeneralOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionGeneral">

                                    <div class="accordion-body">
                                        <p class="large-paragraph"><strong>Technauction</strong> is an online auction platform designed to provide a seamless and secure bidding experience. It enables users to list items, place bids, and participate in auctions, creating a dynamic and interactive marketplace.</p>

                                        <p class="large-paragraph">For more details, explore the features and functionalities of Technauction on our website.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Question 2 -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionGeneralTwo" aria-expanded="false" aria-controls="accordionGeneralTwo">
                                        How can I participate in auctions on Technauction?
                                    </button>
                                </h2>

                                <div id="accordionGeneralTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionGeneral">

                                    <div class="accordion-body">
                                        <p class="large-paragraph">To participate in auctions on Technauction, you need to register on our platform. Once registered, you can browse auction listings, place bids, and engage in real-time bidding activities. Explore the auction section for ongoing and upcoming events.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Question 3 -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionGeneralThree" aria-expanded="false" aria-controls="accordionGeneralThree">
                                        How does Technauction ensure the security of transactions?
                                    </button>
                                </h2>

                                <div id="accordionGeneralThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionGeneral">

                                    <div class="accordion-body">
                                        <p class="large-paragraph">Technauction prioritizes the security of transactions. We implement robust encryption and authentication measures to safeguard user data and financial transactions. Our platform follows industry best practices to ensure a secure and trustworthy environment for online auctions.</p>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <h2 class="mt-5">About <span>our services</span></h2>

                        <div class="accordion" id="accordionProduct">
                            <!-- Question 4 -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionProductOne" aria-expanded="true" aria-controls="accordionProductOne">
                                        How do I list items for auction on Technauction?
                                    </button>
                                </h2>

                                <div id="accordionProductOne" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionProduct">

                                    <div class="accordion-body">
                                        <p class="large-paragraph">Listing items on Technauction is easy. After registering and logging in, navigate to your seller dashboard. Follow the simple steps to create a new auction listing, providing details such as item description, starting bid, and auction duration.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Question 5 -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFive">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionProductTwo" aria-expanded="false" aria-controls="accordionProductTwo">
                                        What categories are available for item listings?
                                    </button>
                                </h2>

                                <div id="accordionProductTwo" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionProduct">

                                    <div class="accordion-body">
                                        <p class="large-paragraph">Technauction offers a variety of categories for item listings, ensuring easy searching and navigation. Sellers can choose the most relevant category for their items, making it convenient for bidders to discover and engage with the auctions.</p>
                                    </div>
                                </div>
                            </div>

                        </div>

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
