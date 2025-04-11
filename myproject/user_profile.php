<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "shopping_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user data
$user_id = $_SESSION['user_id'];
$sql = "SELECT username, email, name, address FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found!";
    exit();
}

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit();
    }

    $update_sql = "UPDATE users SET name = ?, email = ?, address = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sssi", $name, $email, $address, $user_id);

    if ($update_stmt->execute()) {
        echo "<script>alert('Profile updated successfully!');</script>";
        header("Location: user_profile.php");
        exit();
    } else {
        echo "Error updating profile!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile - Mani's Shoppee</title>
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

        header h1 {
            margin: 0;
            font-size: 2.5rem;
        }

        .top-bar {
            background-color: #fff;
            padding: 10px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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

        main {
            width: 60%;
            margin: 40px auto;
            padding: 30px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        main h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"], input[type="email"], textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
            height: 100px;
        }

        button[type="submit"] {
            background-color: #2980b9;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 16px;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #1c4f7c;
        }

        .continue-button {
            text-align: center;
            margin-top: 20px;
        }

        .continue-button a {
            display: inline-block;
            padding: 12px 25px;
            background-color: #27ae60;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .continue-button a:hover {
            background-color: #1e8449;
        }

        footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 40px;
        }

        @media (max-width: 768px) {
            main {
                width: 90%;
            }
        }

        @media (max-width: 480px) {
            header h1 {
                font-size: 1.8rem;
            }

            .top-bar {
                flex-direction: column;
                align-items: flex-start;
            }

            .top-bar a {
                margin-left: 0;
                margin-right: 15px;
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>Mani's Shoppee</h1>
</header>

<div class="top-bar">
    <div>
        <a href="user_profile.php">My Profile</a>
        <a href="cart.php">Cart</a>
    </div>
    <div>
        <a href="logout.php">Logout</a>
    </div>
</div>

<main>
    <h2>Update Your Profile</h2>
    <form method="POST" action="user_profile.php">
        <label for="name">Full Name:</label>
        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

        <label for="address">Address:</label>
        <textarea name="address" id="address" required><?php echo htmlspecialchars($user['address']); ?></textarea>

        <button type="submit">Update Profile</button>
    </form>

    <div class="continue-button">
        <a href="products.php">Continue Shopping</a>
    </div>
</main>

<footer>
    <p>&copy; 2025 Mani's Shoppee | All Rights Reserved</p>
</footer>

</body>
</html>
