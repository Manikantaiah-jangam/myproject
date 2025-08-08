<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Handle the remove product from cart
if (isset($_GET['remove_id'])) {
    $remove_id = $_GET['remove_id'];
    // Remove the product from the cart array
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $remove_id) {
            unset($_SESSION['cart'][$key]);
        }
    }
    // Reindex the array to avoid gaps in the keys
    $_SESSION['cart'] = array_values($_SESSION['cart']);
    header("Location: cart.php");
    exit();
}

// Handle the update quantity of the product in the cart
if (isset($_POST['update_quantity'])) {
    $update_id = $_POST['update_id'];
    $new_quantity = $_POST['quantity'];

    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $update_id) {
            $_SESSION['cart'][$key]['quantity'] = $new_quantity;
        }
    }
    header("Location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - Mani's Shoppee</title>
    <style>
        /* Add your styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
        }
        .cart-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        td img {
            width: 80px;
            height: 80px;
            object-fit: cover;
        }
        .checkout-btn {
            background-color: #FF5722;
            color: white;
            padding: 15px 30px;
            border: none;
            font-size: 18px;
            margin-top: 20px;
            cursor: pointer;
        }
        .checkout-btn:hover {
            background-color: #e64a19;
        }
        .update-btn, .remove-btn {
            padding: 5px 10px;
            background-color: #FF5722;
            color: white;
            border: none;
            cursor: pointer;
            margin-top: 5px;
        }
        .update-btn:hover, .remove-btn:hover {
            background-color: #e64a19;
        }
    </style>
</head>
<body>

<div class="cart-container">
    <h2>Your Cart</h2>
    <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_price = 0;
                foreach ($_SESSION['cart'] as $item):
                    $total_price += $item['price'] * $item['quantity'];
                ?>
                    <tr>
                        <td><img src="images/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>"></td>
                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                        <td>$<?php echo number_format($item['price'], 2); ?></td>
                        <td>
                            <form action="cart.php" method="POST">
                                <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" required>
                                <input type="hidden" name="update_id" value="<?php echo $item['id']; ?>">
                                <button type="submit" name="update_quantity" class="update-btn">Update</button>
                            </form>
                        </td>
                        <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                        <td><a href="cart.php?remove_id=<?php echo $item['id']; ?>"><button class="remove-btn">Remove</button></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h3>Total Price: $<?php echo number_format($total_price, 2); ?></h3>
        <a href="checkout.php"><button class="checkout-btn">Proceed to Checkout</button></a>
    <?php else: ?>
        <p>Your cart is empty!</p>
    <?php endif; ?>
</div>

</body>
</html>
