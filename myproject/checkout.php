<?php
session_start();

// Redirect to login page if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Connect to the database
$conn = new mysqli("localhost", "root", "", "shopping_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user info (optional: show it on the checkout page)
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user_result = $stmt->get_result();
$user_info = $user_result->fetch_assoc();

// Handle checkout form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $shipping_address = $_POST['shipping_address'];
    $total_amount = 0;

    // Calculate the total amount for the order
    foreach ($_SESSION['cart'] as $item) {
        $total_amount += $item['price'] * $item['quantity'];
    }

    // Insert order into the orders table
    $order_sql = "INSERT INTO orders (user_id, total_amount, shipping_address) VALUES (?, ?, ?)";
    $order_stmt = $conn->prepare($order_sql);
    $order_stmt->bind_param("ids", $user_id, $total_amount, $shipping_address);

    if ($order_stmt->execute()) {
        $order_id = $conn->insert_id; // Get the last inserted order ID

        // Insert order items into the order_items table
        foreach ($_SESSION['cart'] as $item) {
            $order_item_sql = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
            $order_item_stmt = $conn->prepare($order_item_sql);
            $order_item_stmt->bind_param("iiid", $order_id, $item['id'], $item['quantity'], $item['price']);
            $order_item_stmt->execute();
        }

        // Clear the cart after checkout
        unset($_SESSION['cart']); // Empty the cart

        // Redirect to a success page or products page
        header("Location: success.php"); // You can create a success page for order confirmation
        exit();
    } else {
        echo "Error placing the order!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Mani's Shoppee</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
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
        .checkout-container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .checkout-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .checkout-container .form-group {
            margin-bottom: 15px;
        }
        .checkout-container label {
            font-size: 16px;
            font-weight: bold;
        }
        .checkout-container input, .checkout-container textarea {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .checkout-container button {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
        }
        .checkout-container button:hover {
            background-color: #45a049;
        }
        .order-summary {
            margin-top: 40px;
        }
        .order-summary table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .order-summary th, .order-summary td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        .order-summary th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>

<header>
    <h1>Mani's Shoppee</h1>
</header>

<div class="checkout-container">
    <h2>Checkout</h2>

    <!-- Order Summary Table -->
    <div class="order-summary">
        <h3>Order Summary</h3>
        <table>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
            <?php
            $total_amount = 0;
            foreach ($_SESSION['cart'] as $item):
                $total_amount += $item['price'] * $item['quantity'];
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                    <td>$<?php echo number_format($item['price'], 2); ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <h3>Total: $<?php echo number_format($total_amount, 2); ?></h3>
    </div>

    <!-- Checkout Form -->
    <form method="POST" action="checkout.php">
        <div class="form-group">
            <label for="shipping_address">Shipping Address:</label>
            <textarea name="shipping_address" rows="4" required placeholder="Enter your shipping address..."></textarea>
        </div>

        <button type="submit">Place Order</button>
    </form>
</div>

</body>
</html>
