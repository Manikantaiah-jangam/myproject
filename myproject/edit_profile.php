<?php
session_start();
include('db_connection.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// Fetch the user data
$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Handle form submission for updating profile
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $age = $_POST['age'];

    // Update the user details in the database
    $updateQuery = "UPDATE users SET name = '$name', email = '$email', mobile = '$mobile', age = '$age' WHERE username = '$username'";
    if (mysqli_query($conn, $updateQuery)) {
        echo "Profile updated successfully!";
        header("Location: profile.php"); // Redirect to profile page after updating
    } else {
        echo "Error updating profile.";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile | MyShopping</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<main>
    <div class="edit-profile-container">
        <h2>Edit Profile</h2>

        <form method="POST" action="edit_profile.php">
            <div class="input-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            </div>

            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>

            <div class="input-group">
                <label for="mobile">Mobile Number:</label>
                <input type="text" name="mobile" id="mobile" value="<?php echo htmlspecialchars($user['mobile']); ?>">
            </div>

            <div class="input-group">
                <label for="age">Age:</label>
                <input type="number" name="age" id="age" value="<?php echo htmlspecialchars($user['age']); ?>">
            </div>

            <button type="submit" class="save-btn">Save Changes</button>
        </form>
    </div>
</main>

</body>
</html>
