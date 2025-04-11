<?php
// Start session to check if the user is logged in
session_start();

// If user is not logged in, they should be redirected to login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<header>
    <nav>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="shop.php">Shop</a></li>
            <li><a href="cart.php">Cart</a></li>
            <li><a href="profile.php">Profile</a></li>
            <!-- Only show logout link if user is logged in -->
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>
