<?php
session_start();

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Remove item with the matching product id from the session cart
    foreach ($_SESSION['cart'] as $index => $item) {
        if ($item['id'] == $product_id) {
            unset($_SESSION['cart'][$index]);  // Remove the item from the cart
            break;
        }
    }

    // Redirect back to the cart page
    header("Location: cart.php");
    exit();
}
?>
