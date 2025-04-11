<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit();
}

include 'db.php';

// Fetch all categories from the database
$query = "SELECT * FROM categories";
$result = mysqli_query($conn, $query);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_category'])) {
    // Adding a new category
    $category_name = mysqli_real_escape_string($conn, $_POST['category_name']);

    $insertQuery = "INSERT INTO categories (category_name) 
                    VALUES ('$category_name')";

    if (mysqli_query($conn, $insertQuery)) {
        $success = "Category added successfully!";
    } else {
        $error = "Error adding category: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>Manage Categories</h2>

        <!-- Add New Category Form -->
        <h3>Add New Category</h3>
        <form method="POST">
            <input type="text" name="category_name" placeholder="Category Name" required><br>
            <button type="submit" name="add_category">Add Category</button>
        </form>

        <?php
        if (isset($error)) {
            echo "<p class='error'>$error</p>";
        }
        if (isset($success)) {
            echo "<p class='success'>$success</p>";
        }
        ?>

        <h3>All Categories</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
            <?php while ($category = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $category['category_id']; ?></td>
                    <td><?php echo $category['category_name']; ?></td>
                    <td>
                        <a href="edit_category.php?id=<?php echo $category['category_id']; ?>">Edit</a> | 
                        <a href="delete_category.php?id=<?php echo $category['category_id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
