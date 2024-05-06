<?php
session_start();

// Check if the user is not logged in, then redirect to sign-in page
if (!isset($_SESSION["isloggedin"])) {
    header("Location: sign-in.php");
    exit(); // Added exit() to stop script execution after redirection
}

require_once 'Connection.php';

// Get the logged-in user's ID
$user_id = $_SESSION['id'];

// Fetch notifications for the logged-in user
$notifications = array();
$query = "SELECT * FROM admin_notifications WHERE user_id = ? ORDER BY id DESC"; // Modified query to use user_id
$stmt = $conn->prepare($query);
if (!$stmt) {
    die('Error in preparing statement: ' . $conn->error);
}
$stmt->bind_param('i', $user_id);
if (!$stmt->execute()) {
    die('Error in executing statement: ' . $stmt->error);
}
$result = $stmt->get_result();

// Check if there are notifications
if ($result->num_rows > 0) {
    // Loop through each notification and store it in the $notifications array
    while ($row = $result->fetch_assoc()) {
        $notifications[] = $row;
    }
} else {
    // No notifications found
    $notifications[] = array('message' => 'No notifications found', 'created_at' => '');
}

$stmt->close();
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <title>Payment</title>
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
                        <h4 class="page-title">Make Payment</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Make Payment</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>


        <!-- Notification list -->
        <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Product Won</th>
                                        <th>Date Won</th>
                                        <th>Status(Paid/ Not Paid)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($notifications as $notification) : ?>
                                        <tr>
                                            <td><?php echo nl2br($notification['message']); ?></td>
                                            <td><?php echo $notification['created_at']; ?></td>
                                            <td><?php echo isset($notification['Paid']) ? $notification['Paid'] : ''; ?></td>
                                            <td>
                                                <?php if (isset($notification['Paid']) && $notification['Paid'] != 'Paid') : ?>
                                                    <form method="post" action="checkout.php">
                                                        <input type="hidden" name="notification_id" value="<?php echo $notification['id']; ?>">
                                                        <button type="submit">Pay</button>
                                                    </form>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
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
