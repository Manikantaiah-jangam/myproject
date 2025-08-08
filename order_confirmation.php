<?php
session_start();
$user_id = $_SESSION['user_id'];
$conn = new mysqli("localhost", "root", "", "shopping_db");

// Fetch the latest order for the user
$sql = "SELECT o.id, o.total_amount, o.shipping_address, o.created_at 
        FROM orders o 
        WHERE o.user_id = ? 
        ORDER BY o.created_at DESC LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$order_result = $stmt->get_result();
$order = $order_result->fetch_assoc();

$order_id = $order['id'];

// Fetch order items
$order_items_sql = "SELECT oi.product_id, oi.quantity, p.name, oi.price 
                    FROM order_items oi
                    JOIN products p ON oi.product_id = p.id
                    WHERE oi.order_id = ?";
$order_items_stmt = $conn->prepare($order_items_sql);
$order_items_stmt->bind_param("i", $order_id);
$order_items_stmt->execute();
$order_items_result = $order_items_stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - Mani's Shoppee</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }
        header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
        }
        main {
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .order-details {
            margin-bottom: 20px;
        }
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
        }
    </style>
</head>
<body>

<header>
    <h1>Order Confirmation</h1>
</header>

<main>
    <h2>Thank you for your order!</h2>
    <div class="order-details">
        <p><strong>Order ID:</strong> <?php echo $order['id']; ?></p>
        <p><strong>Total Amount:</strong> $<?php echo number_format($order['total_amount'], 2); ?></p>
        <p><strong>Shipping Address:</strong> <?php echo htmlspecialchars($order['shipping_address']); ?></p>
        <p><strong>Order Date:</strong> <?php echo $order['created_at']; ?></p>
    </div>

    <h3>Order Items:</h3>
    <table>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
        </tr>
        <?php while ($item = $order_items_result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($item['name']); ?></td>
                <td><?php echo $item['quantity']; ?></td>
                <td>$<?php echo number_format($item['price'], 2); ?></td>
                <td>$<?php echo number_format($item['quantity'] * $item['price'], 2); ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</main>

<footer>
    <p>About Us | Contact Us | Company Details</p>
</footer>

</body>
</html>
