<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit();
}

include 'db.php';

// Example query to fetch order count (replace with actual queries for managing products, categories, etc.)
$query = "SELECT COUNT(*) as total_orders FROM orders";
$result = mysqli_query($conn, $query);
$order_count = mysqli_fetch_assoc($result)['total_orders'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        /* General styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

/* Login Page */
.login-container {
    width: 300px;
    margin: 100px auto;
    padding: 20px;
    background-color: white;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

.login-container input {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.login-container button {
    width: 100%;
    padding: 10px;
    background-color: #28a745;
    border: none;
    color: white;
    font-size: 16px;
    cursor: pointer;
    border-radius: 4px;
}

.login-container button:hover {
    background-color: #218838;
}

.login-container .error {
    color: red;
    font-size: 14px;
}

/* Admin Dashboard */
.dashboard-container {
    width: 80%;
    margin: 50px auto;
    padding: 30px;
    background-color: white;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    text-align: center;
}

.admin-links {
    margin-top: 20px;
}

.admin-links a {
    display: inline-block;
    margin: 10px;
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 4px;
}

.admin-links a:hover {
    background-color: #0056b3;
}

        </style>
</head>
<body>
    <div class="dashboard-container">
        <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
        <p>Total Orders: <?php echo $order_count; ?></p>

        <div class="admin-links">
            <a href="manage_products.php">Manage Products</a>
            <a href="manage_categories.php">Manage Categories</a>
            <a href="manage_orders.php">Manage Orders</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
