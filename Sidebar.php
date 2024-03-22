<?php
// Assuming $_SESSION['new_notifications'] is set elsewhere in your code
$hasNewProducts = isset($_SESSION['new_products']) && $_SESSION['new_products'];
// Now you can include your sidebar code
?>
<aside class="left-sidebar" data-sidebarbg="skin5">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="pages-profile.php" aria-expanded="false">
                        <i class="mdi mdi-account-network"></i>
                        <span class="hide-menu">Profile</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="Monitor.php" aria-expanded="false">
                        <i class="mdi mdi-arrange-bring-forward"></i>
                        <span class="hide-menu">Monitor</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="notifications.php" aria-expanded="false">
                        <i class="mdi mdi-bell-ring"></i>
                        <span class="hide-menu">Notifications<?php echo isset($_SESSION['new_products']) && $_SESSION['new_products'] ? '<span class="notification-dot"></span>' : ''; ?></span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="List_Product.php" aria-expanded="false">
                        <i class="mdi mdi-cart-plus"></i>
                        <span class="hide-menu">Add Item for Sell</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="Manage_Product.php" aria-expanded="false">
                        <i class="mdi mdi-package-variant"></i>
                        <span class="hide-menu">Your listings</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="LogOut.php" aria-expanded="false">
                        <i class="mdi mdi-logout"></i>
                        <span class="hide-menu">Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

