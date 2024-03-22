
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
        <title>SIGN UP</title>
        <!-- CSS FILES -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;700;900&display=swap" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-icons.css" rel="stylesheet">
        <link rel="stylesheet" href="css/slick.css"/>
        <link href="css/tooplate-little-fashion.css" rel="stylesheet">
    </head>
    
    <body>

        <section class="preloader">
            <div class="spinner">
                <span class="sk-inner-circle"></span>
            </div>
        </section>
    
        <main>

            <section class="sign-in-form section-padding">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-8 mx-auto col-12">

                            <h1 class="hero-title text-center mb-5">Sign Up</h1>

                           <div class="row">
                                <div class="col-lg-8 col-11 mx-auto">

                                    <!-- Display Error Messages -->
                                    <?php
                                    if (isset($_SESSION['invalidCredentials']) && $_SESSION['invalidCredentials']) {
                                        echo '<div class="password">';
                                        echo "<p>Wrong Password or Email</p>";
                                        echo '</div>';
                                    }

                                    if (isset($_SESSION['loginWait']) && $_SESSION['loginWait']) {
                                        echo '<div class="password">';
                                        echo "<p>Please wait 10 minutes before trying again.</p>";
                                        echo '</div>';
                                    }
                                    ?>  
                                    
                                  <form role="form" action="Add_Admin.php" method="post">
                                    <div class="form-floating mb-4 p-0">
                                        <input type="text" name="UserName" id="UserName" class="form-control" placeholder="User Name" required>
                                        <label for="UserName">User Name</label>
                                    </div>
                                    
                                    <div class="form-floating mb-4 p-0">
                                        <input type="email" name="email" id="User_Email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Email address" required>
                                        <label for="User_Email">Email address</label>
                                    </div>

                                    <div class="form-floating p-0">
                                        <input type="password" name="password" id="User_password" class="form-control" placeholder="Password" required>
                                        <label for="User_password">Password</label>
                                    </div>

                                    <button type="submit" class="btn custom-btn form-control mt-4 mb-3">
                                        Create account
                                    </button>
                                </form>

                                </div>
                            </div>
                            
                        </div>

                    </div>
                </div>
            </section>

        </main>

 

        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/Headroom.js"></script>
        <script src="js/jQuery.headroom.js"></script>
        <script src="js/slick.min.js"></script>
        <script src="js/custom.js"></script>

    </body>
</html>
