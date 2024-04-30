

<nav class="navbar navbar-expand-lg">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <a class="navbar-brand" href="index.php">
                        <strong><span>Techn</span>auction</strong>
                    </a>

                    <div class="d-lg-none">
                        <a href="sign-in.html" class="bi-person custom-icon me-3"></a>

                        <a href="product-detail.php" class="bi-bag custom-icon"></a>
                    </div>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php">Home</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="products.php">Products</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="about.php">About Us</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="faq.php">Help Guide</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="contact.php">Contact</a>
                            </li>
                        </ul>

                        <div class="d-none d-lg-block">
                        <?php 
                        if (isset($_SESSION["id"]) || isset($_SESSION["user_id"])) {
                            echo '<a href="pages-profile.php" class="bi-person custom-icon me-2"style="font-size: 18px;"> Profile</a>';
                        } else {
                            echo '<a href="sign-in.php" class="bi-person custom-icon me-2" style="font-size: 18px;">Login</a>';

                        }
                        ?>

                            <!-- <a href="product-detail.php" class="bi-bag custom-icon"></a> -->
                        </div>
                    </div>
                </div>
            </nav>