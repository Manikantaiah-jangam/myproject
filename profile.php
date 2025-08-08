<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

// Include the database connection
include('db_connection.php');

// Fetch the user data from the database
$username = $_SESSION['username']; // Get the logged-in user's username

// Query to fetch user details from the database
$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);

if ($result) {
    $user = mysqli_fetch_assoc($result); // Fetch the user details as an associative array
} else {
    echo "Error fetching user details.";
    exit();
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile | MyShopping</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<main>
    <div class="profile-container">
        <h2>User Profile</h2>
        
        <div class="profile-details">
            <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <p><strong>Age:</strong> <?php echo htmlspecialchars($user['age']); ?></p>
            <p><strong>Mobile Number:</strong> <?php echo htmlspecialchars($user['mobile']); ?></p>
        </div>
        
        <a href="edit_profile.php" class="edit-btn">Edit Profile</a>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</main>

</body>
</html>
