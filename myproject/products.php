<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    $is_logged_in = false;
} else {
    $is_logged_in = true;
}

// Database connection
$conn = new mysqli("localhost", "root", "", "shopping_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all products from the database
$sql = "SELECT id, name, price, image FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Mani's Shoppee</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #2c3e50;
            color: white;
            padding: 20px 30px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        header a {
            text-decoration: none;
            color: white;
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .header-content img {
            height: 50px;
            margin-right: 15px;
        }

        .header-content h1 {
            margin: 0;
            font-size: 2.5rem;
        }

        .top-bar {
            background-color: #fff;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .top-bar input[type="text"] {
            padding: 10px;
            border-radius: 20px;
            border: 1px solid #ccc;
            width: 250px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .top-bar input[type="text"]:focus {
            border-color: #2980b9;
            box-shadow: 0 0 5px rgba(41, 128, 185, 0.3);
        }

        .top-bar a {
            color: #2980b9;
            text-decoration: none;
            font-weight: 500;
            margin-left: 15px;
            position: relative;
            transition: color 0.3s ease;
        }

        .top-bar a:hover {
            color: #1c4f7c;
        }

        .top-bar a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            background: #2980b9;
            bottom: -5px;
            transition: width 0.3s ease;
        }

        .top-bar a:hover::after {
            width: 100%;
        }

        .products-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            gap: 20px;
            padding: 30px;
        }

        .product-card {
            background-color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            width: 250px;
            overflow: hidden;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-10px);
        }

        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover img {
            transform: scale(1.1);
        }

        .product-card h3 {
            color: #333;
            margin: 10px 0;
        }

        .product-card .price {
            font-size: 18px;
            font-weight: bold;
            color: #27ae60;
            margin-bottom: 10px;
        }

        .product-card button {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .product-card button:hover {
            background-color: #c0392b;
        }

        footer {
            background-color: #2c3e50;
            color: white;
            padding: 20px 30px;
            text-align: center;
            margin-top: 30px;
        }

        footer a {
            color: #ecf0f1;
            text-decoration: none;
            margin: 0 15px;
            font-size: 16px;
        }

        footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .top-bar {
                flex-direction: column;
                align-items: flex-start;
            }

            .top-bar input[type="text"] {
                width: 100%;
                margin-bottom: 10px;
            }

            .products-container {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .header-content h1 {
                font-size: 1.8rem;
            }

            .top-bar {
                padding: 10px;
            }

            .product-card {
                width: 100%;
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>

<!-- Header with Logo and Clickable Title -->
<header>
    <a href="about_us.php">
        <div class="header-content">
            <img src="images/logo.png" alt="Logo">
            <h1>Mani's Shoppee</h1>
        </div>
    </a>
</header>

<!-- Top Navigation Bar -->
<div class="top-bar">
    <input type="text" placeholder="Search Products">
    <div>
        <?php if ($is_logged_in): ?>
            <a href="user_profile.php">Hello, <?php echo $_SESSION['username']; ?></a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php endif; ?>
        <a href="cart.php">Cart</a>
    </div>
</div>

<!-- Products Listing -->
<main>
    <h2 style="text-align:center; margin-top: 20px;">Our Products</h2>
    <div class="products-container">
        <?php while ($product = $result->fetch_assoc()): ?>
            <div class="product-card">
                <img src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                <p class="price">$<?php echo number_format($product['price'], 2); ?></p>
                <a href="add_to_cart.php?product_id=<?php echo $product['id']; ?>&name=<?php echo urlencode($product['name']); ?>&price=<?php echo $product['price']; ?>&image=<?php echo urlencode($product['image']); ?>">
                    <button>Add to Cart</button>
                </a>
            </div>
        <?php endwhile; ?>
    </div>
</main>

<!-- Footer -->
<footer>
    <p>&copy; 2025 Mani's Shoppee | All rights reserved.</p>
    <p>
        <a href="about_us.php">About Us</a> |
        <a href="contact_us.php">Contact Us</a> |
        <a href="privacy_policy.php">Privacy Policy</a>
    </p>
    <p>Email: manikanta@gmail.com | Phone: +123-456-7890</p>
</footer>

</body>
</html>

<?php
$conn->close();
?>
