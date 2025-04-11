<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit();
}

include 'db.php';

// Fetch all orders from the database
$query = "SELECT * FROM orders";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <link rel="stylesheet" href="admin_styles.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>Manage Orders</h2>

        <h3>All Orders</h3>
        <table>
            <tr>
                <th>product ID</th>
                <th>User ID</th>
                <th>Quantity</th>
                <th>Total Price</th>
                
                <th>Actions</th>
            </tr>
            <?php while ($order = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $order['id']; ?></td>
                    <td><?php echo $order['user_id']; ?></td>
                    <td><?php echo $order['quantity']; ?></td>
                    <td><?php echo $order['price']; ?></td>
                    
                    <td>
                        <a href="edit_order.php?id=<?php echo $order['order_id']; ?>">Edit</a> | 
                        <a href="delete_order.php?id=<?php echo $order['order_id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
