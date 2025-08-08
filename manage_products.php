<?php
session_start();

// Database connection
$host = 'localhost'; // Change this to your DB host
$user = 'root';      // Change this to your DB user
$password = '';      // Change this to your DB password
$dbname = 'shopping_db'; // Change this to your DB name

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit();
}

// Handle adding a new product
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_product'])) {
    $name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $price = mysqli_real_escape_string($conn, $_POST['product_price']);
    $description = mysqli_real_escape_string($conn, $_POST['product_description']);

    $insertQuery = "INSERT INTO products (name, price, description) 
                    VALUES ('$name', '$price', '$description')";

    if (mysqli_query($conn, $insertQuery)) {
        $success = "Product added successfully!";
    } else {
        $error = "Error adding product: " . mysqli_error($conn);
    }
}

// Handle product deletion
if (isset($_GET['delete_id'])) {
    $product_id = $_GET['delete_id'];
    $deleteQuery = "DELETE FROM products WHERE product_id = $product_id";
    if (mysqli_query($conn, $deleteQuery)) {
        $success = "Product deleted successfully!";
    } else {
        $error = "Error deleting product: " . mysqli_error($conn);
    }
}

// Handle product editing
if (isset($_GET['edit_id'])) {
    $product_id = $_GET['edit_id'];
    $productQuery = "SELECT * FROM products WHERE product_id = $product_id";
    $productResult = mysqli_query($conn, $productQuery);
    $product = mysqli_fetch_assoc($productResult);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_product'])) {
    $product_id = $_POST['product_id'];
    $name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $price = mysqli_real_escape_string($conn, $_POST['product_price']);
    $description = mysqli_real_escape_string($conn, $_POST['product_description']);

    $updateQuery = "UPDATE products SET 
                    name = '$name', 
                    price = '$price', 
                    description = '$description' 
                    WHERE product_id = $product_id";

    if (mysqli_query($conn, $updateQuery)) {
        $success = "Product updated successfully!";
    } else {
        $error = "Error updating product: " . mysqli_error($conn);
    }
}

// Fetch all products for listing
$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Manage Products</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h2, h3 {
            color: #333;
        }

        form input, form textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        form button {
            padding: 10px 20px;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 5px;
        }

        form button:hover {
            background-color: #4cae4c;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .error {
            color: red;
        }

        .success {
            color: green;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Dashboard - Manage Products</h2>

        <!-- Add New Product Form -->
        <h3>Add New Product</h3>
        <form method="POST">
            <input type="text" name="product_name" placeholder="Product Name" required><br>
            <input type="number" name="product_price" placeholder="Product Price" required><br>
            <textarea name="product_description" placeholder="Product Description" required></textarea><br>
            <button type="submit" name="add_product">Add Product</button>
        </form>

        <?php
        if (isset($error)) {
            echo "<p class='error'>$error</p>";
        }
        if (isset($success)) {
            echo "<p class='success'>$success</p>";
        }
        ?>

        <h3>All Products</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            <?php while ($product = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $product['product_id']; ?></td>
                    <td><?php echo $product['name']; ?></td>
                    <td><?php echo $product['price']; ?></td>
                    <td><?php echo $product['description']; ?></td>
                    <td>
                        <!-- Edit and Delete links -->
                        <a href="?edit_id=<?php echo $product['product_id']; ?>">Edit</a> | 
                        <a href="?delete_id=<?php echo $product['product_id']; ?>" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>

        <?php
        // Edit Product Form (only shows if edit_id is set)
        if (isset($_GET['edit_id'])) {
            $product_id = $_GET['edit_id'];
            $productQuery = "SELECT * FROM products WHERE product_id = $product_id";
            $productResult = mysqli_query($conn, $productQuery);
            $product = mysqli_fetch_assoc($productResult);

            echo '<h3>Edit Product</h3>';
            echo '<form method="POST">
                    <input type="hidden" name="product_id" value="' . $product['product_id'] . '">
                    <input type="text" name="product_name" value="' . $product['name'] . '" placeholder="Product Name" required><br>
                    <input type="number" name="product_price" value="' . $product['price'] . '" placeholder="Product Price" required><br>
                    <textarea name="product_description" placeholder="Product Description" required>' . $product['description'] . '</textarea><br>
                    <button type="submit" name="update_product">Update Product</button>
                  </form>';
        }
        ?>
    </div>
</body>
</html>

<?php
// Close database connection
mysqli_close($conn);
?>
