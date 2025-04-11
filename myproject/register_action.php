<?php
session_start();
$conn = new mysqli("localhost", "root", "", "shopping_db");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $username = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $age = $_POST['age'];
    $password = $_POST['password']; // Encrypt password

    // Check if username or email already exists
    $sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Username or email already exists
        echo "Username or email already taken. Please choose another.";
    } else {
        // Insert new user into the database
        $sql = "INSERT INTO users (username, name, email, mobile, age, password) 
                VALUES ('$username', '$name', '$email', '$mobile', '$age', '$password')";
        
        if ($conn->query($sql) === TRUE) {
            // Successfully inserted the user
            $_SESSION['user'] = $username;
            echo "Registration successful! <a href='login.php'>Login here</a>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close connection
    $conn->close();
}
?>