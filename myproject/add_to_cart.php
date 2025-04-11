<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if product data is passed
if (isset($_GET['product_id'], $_GET['name'], $_GET['price'], $_GET['image'])) {
    $product_id = $_GET['product_id'];
    $name = $_GET['name'];
    $price = $_GET['price'];
    $image = $_GET['image'];

    // Create the product item
    $product = [
        'id' => $product_id,
        'name' => $name,
        'price' => $price,
        'image' => $image,
        'quantity' => 1, // Initially add 1 quantity
    ];

    // Initialize the cart if not set
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Add product to the cart
    $_SESSION['cart'][] = $product;

    // Redirect to cart page
    header("Location: cart.php");
    exit();
} else {
    echo "Invalid product data.";
}
?>
