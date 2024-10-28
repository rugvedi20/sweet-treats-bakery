<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

include('config.php'); // Include your database connection file

// Get product ID from the URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
} else {
    header("Location: manage_products.php");
    exit();
}

// Fetch product details
$query = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
$stmt->close();

// Handle form submission to update product
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_POST['image']; // Adjust as necessary for handling images

    $update_query = "UPDATE products SET name = ?, description = ?, price = ?, image = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("ssdsi", $name, $description, $price, $image, $product_id);
    $stmt->execute();
    $stmt->close();

    header("Location: manage_products.php");
    exit();
}

$conn->close();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
    <link rel="styles.css" href="css/styles.css">
</head>
<body>

<div class="container my-5">
    <h2 class="text-center">Edit Product</h2>
    <form method="post">
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $product['name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $product['description']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" value="<?php echo $product['price']; ?>" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="image">Image URL</label>
            <input type="text" class="form-control" id="image" name="image" value="<?php echo $product['image']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
        <a href="manage_products.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

</body>
</html>
<?php
header("Location: manage_product.php");
?>