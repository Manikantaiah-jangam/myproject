<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'db.php';

    // Sanitize and validate input
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Check if username already exists
    $checkQuery = "SELECT * FROM admins WHERE username = '$username'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        $error = "Username already exists!";
    } else {
        // Hash the password before storing it
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert new admin into the database
        $insertQuery = "INSERT INTO admins (username, password, email) VALUES ('$username', '$hashed_password', '$email')";

        if (mysqli_query($conn, $insertQuery)) {
            $success = "Admin registered successfully!";
            header("Location: admin_login.php"); // Redirect to login page after successful registration
            exit();
        } else {
            $error = "Error registering admin: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <style>
        /* General styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

/* Registration Page */
.register-container {
    width: 300px;
    margin: 100px auto;
    padding: 20px;
    background-color: white;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

.register-container input {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.register-container button {
    width: 100%;
    padding: 10px;
    background-color: #28a745;
    border: none;
    color: white;
    font-size: 16px;
    cursor: pointer;
    border-radius: 4px;
}

.register-container button:hover {
    background-color: #218838;
}

.register-container .error {
    color: red;
    font-size: 14px;
}

.register-container .success {
    color: green;
    font-size: 14px;
}

        </style>
</head>
<body>
    <div class="register-container">
        <h2>Admin Registration</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <button type="submit">Register</button>
        </form>
        <?php
        if (isset($error)) {
            echo "<p class='error'>$error</p>";
        }
        if (isset($success)) {
            echo "<p class='success'>$success</p>";
        }
        ?>
    </div>
</body>
</html>
