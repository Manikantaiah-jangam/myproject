<?php
session_start();

// Ensure that the user has just completed an order by checking if the session for cart is empty
if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    // Redirect to products page if the user somehow bypasses the checkout and comes to success page directly
    header("Location: products.php");
    exit();
}

// Optionally, you can display user order details or a success message
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Successful - Mani's Shoppee</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        header {
            background-color: #333;
            color: white;
            padding: 15px 30px;
            text-align: center;
        }

        header h1 {
            margin: 0;
        }

        .success-container {
            background-color: white;
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .success-container h2 {
            color: #4CAF50;
            font-size: 28px;
            margin-bottom: 20px;
        }

        .success-container p {
            font-size: 18px;
            color: #333;
        }

        .success-container a {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            font-size: 18px;
        }

        .success-container a:hover {
            background-color: #45a049;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>

<header>
    <h1>Mani's Shoppee</h1>
</header>

<div class="success-container">
    <h2>Order Successful!</h2>
    <p>Thank you for your purchase! Your order has been successfully placed.</p>
    <p>We will process your order and ship it to your provided address soon.</p>
    <a href="products.php">Continue Shopping</a>
    <br>
    <a href="logout.php">Logout</a>
</div>

<footer>
    <p>About Us | Contact Us | Company Details</p>
</footer>

</body>
</html>
