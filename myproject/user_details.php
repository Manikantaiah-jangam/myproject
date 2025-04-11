<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "shopping_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user details
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Update user details
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    // Update query
    $sql_update = "UPDATE users SET username='$username', email='$email', address='$address', phone='$phone' WHERE id='$user_id'";

    if ($conn->query($sql_update) === TRUE) {
        $_SESSION['username'] = $username;  // Update session variable
        header("Location: user_details.php");
        exit();
    } else {
        $error = "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - Mani's Shoppee</title>
    <style>
        /* Add styling similar to previous pages */
    </style>
</head>
<body>

<header>
    <!-- Header content -->
</header>

<main>
    <h2>User Profile</h2>

    <?php if (isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST" action="user_details.php">
        <label for="username">Username</label>
        <input type="text" name="username" value="<?php echo $user['username']; ?>" required><br>
        <label for="email">Email Address</label>
        <input type="email" name="email" value="<?php echo $user['email']; ?>" required><br>
        <label for="address">Address</label>
        <input type="text" name="address" value="<?php echo $user['address']; ?>" required><br>
        <label for="phone">Phone Number</label>
        <input type="tel" name="phone" value="<?php echo $user['phone']; ?>" required><br>
        <button type="submit">Update Profile</button>
    </form>
</main>

<footer>
    <!-- Footer content -->
</footer>

</body>
</html>
