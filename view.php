<!DOCTYPE html>
<html lang="en">

<head>
    <title>Alamal Clothes</title>

</head>

<body>
    <header>
        <article class="logo">
            <h1><img src="./images/AlamalClothes.png" alt="Alamal Clothes Logo" width="80"> Alamal Clothes</h1>
        </article>
        <nav>
            <ul>
                <li><a href="products.php">Home</a></li>
                <li><a href="add.php">Add</a></li>
                <li><a href="Contact.php">Contact</a></li>
            </ul>
        </nav>
        <hr>
    </header>

    <?php
    include_once 'dbconfig.in.php';
    include_once 'Product.php';

    if (isset($_GET['id'])) {
        $productId = $_GET['id'];

        $stmt = $pdo->prepare("SELECT * FROM product WHERE ID = ?");
        $stmt->execute([$productId]);
        $productData = $stmt->fetch();

        if ($productData) {
            $product = new Product(
                $productData['ID'],
                $productData['name'],
                $productData['category'],
                $productData['description'],
                $productData['price'],
                $productData['quantity'],
                $productData['rating'],
                $productData['imageName'],
                $productData['imgsrc']
            );
            echo "<section>";
            echo "<h2>Welcome to our View page</h2>";

            echo $product->displayProductPage();
            echo "</section>";
        } else {
            echo "<p>Error: Product not found.</p>";
        }
    } else {
        echo "<p>Product ID not provided.</p>";
    }
    ?>

    <?php
    echo "<br>";
    echo "<br>";
    echo "<hr>";
    include_once 'footer.php';
    ?>
</body>

</html>
