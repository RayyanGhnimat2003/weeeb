<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Delete Product</title>
</head>

<body>
    <header>
        <h2>Welcome to the delete page</h2>
        <figure>
            <img src="./images/delete33.jpg" alt="Delete" width="400px" height="400px">
        </figure>
        <nav>
            <ul>
                <li><a href="products.php">Home</a></li>
                <li><a href="add.php">Add</a></li>
                <li><a href="Contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <?php
    include_once 'dbconfig.in.php';

    if (isset($_GET['id'])) {
        $productId = $_GET['id'];

        try {
            // Retrieve product information before deletion
            $stmt = $pdo->prepare("SELECT name FROM product WHERE ID = ?");
            $stmt->execute([$productId]);
            $productName = $stmt->fetchColumn();

            // Delete the product from the database
            $stmt = $pdo->prepare("DELETE FROM product WHERE ID = ?");
            $stmt->execute([$productId]);

            echo "<p>Product '{$productName}' deleted successfully with ID {$productId}</p>";

            // Redirect to products page
            header("Location: products.php");
            exit();
        } catch (Exception $e) {
            echo "<p>Error deleting product: " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p>No product ID provided for deletion</p>";
    }
    ?>
</body>

</html>
