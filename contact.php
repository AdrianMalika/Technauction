<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Contact Us - Technauction</title>
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

        <header class="site-header section-padding-img site-header-image">
            <div class="container">
                <div class="row">

                    <div class="col-lg-10 col-12 header-info">
                    <h1>
                            <span class="d-block text-primary">Say hello to us</span>
                            <span class="d-block text-dark">love to hear you</span>
                        </h1>
                    </div>
                </div>
            </div>

            <img src="images/header/positive-european-woman-has-break-after-work.jpg" class="header-image img-fluid" alt="">
        </header>



        <section class="contact section-padding">
            <div class="container">
                <div class="row">

                 <!-- Display success message -->
                    <?php
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
                    <div class="col-lg-6 col-12">
                        <h2 class="mb-4">Let's <span>Connect</span></h2>

                        <form class="contact-form me-lg-5 pe-lg-3" role="form" method="POST" action="send_message.php">

                            <div class="form-floating">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Full name" required>

                                <label for="name">Full name</label>
                            </div>

                            <div class="form-floating my-4">
                                <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Email address" required>

                                <label for="email">Email address</label>
                            </div>

                            <div class="form-floating mb-4">
                                <textarea id="message" name="message" class="form-control" placeholder="Leave a message" required style="height: 160px"></textarea>

                                <label for="message">Leave a message</label>
                            </div>

                            <div class="col-lg-5 col-6">
                                <button type="submit" class="form-control">Send</button>
                            </div>
                        </form>
                    </div>

                    <div class="col-lg-6 col-12 mt-5 ms-auto">
                        <div class="row">
                            <div class="col-6 border-end contact-info">
                                <h6 class="mb-3">New Business</h6>

                                <a href="mailto:hello@technauction.com" class="custom-link">
                                    hello@technauction.com
                                    <i class="bi-arrow-right ms-2"></i>
                                </a>
                            </div>

                            <div class="col-6 contact-info">
                                <h6 class="mb-3">Main Office</h6>

                                <a href="mailto:info@technauction.com" class="custom-link">
                                    info@technauction.com
                                    <i class="bi-arrow-right ms-2"></i>
                                </a>
                            </div>

                            <div class="col-6 border-top border-end contact-info">
                                <h6 class="mb-3">Our Address</h6>

                                <p class="text-muted">Vi ctoria avenue Street, Blantyre,Malawi</p>
                            </div>

                            <div class="col-6 border-top contact-info">
                                <h6 class="mb-3">Follow Us</h6>

                                <ul class="social-icon">

                                    <li><a href="#" class="social-icon-link bi-messenger"></a></li>

                                    <li><a href="#" class="social-icon-link bi-youtube"></a></li>

                                    <li><a href="#" class="social-icon-link bi-instagram"></a></li>

                                    <li><a href="#" class="social-icon-link bi-whatsapp"></a></li>
                                </ul>
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
