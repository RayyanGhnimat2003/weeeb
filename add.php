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

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['insert'])) {
        $productName = $_POST['productName'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $rating = isset($_POST['rating']) ? $_POST['rating'] : null;
        $description = $_POST['description'];
        $fileType = pathinfo($_FILES["productPhoto"]["name"], PATHINFO_EXTENSION);

        // Accept more image formats
        $allowedFormats = array("jpg", "jpeg", "png", "gif", "bmp");
        if (in_array(strtolower($fileType), $allowedFormats)) {
            $stmt = $pdo->prepare("INSERT INTO product (name, category, price, quantity, rating, description) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$productName, $category, $price, $quantity, $rating, $description]);

            $productId = $pdo->lastInsertId();

            $fileName = $productId . '.' . $fileType;
            $targetFilePath = $fileName;

            if (move_uploaded_file($_FILES["productPhoto"]["tmp_name"], $targetFilePath)) {
                $stmt = $pdo->prepare("UPDATE product SET imageName = ?, imgsrc = ? WHERE ID = ?");
                $stmt->execute([$fileName, $targetFilePath, $productId]);
                echo "Product added successfully!";
            } else {
                echo "Error uploading file or moving file to destination.";
            }
        } else {
            echo "Only JPG, JPEG, PNG, GIF, and BMP files are allowed.";
        }
    }
    ?>

    <section>
        <h1>Add New Product</h1>
        <figure>
            <img src="./images/add.jpg" height="350px" alt="add" width="350px">
        </figure>

        <form method="POST" action="add.php" enctype="multipart/form-data">
            <fieldset>
                <legend>Product Record:</legend>
                <label for="productName">Product Name:</label>
                <input type="text" id="productName" name="productName" required><br><br>
                <label for="category">Category:</label>
                <select id="category" name="category" required>
                    <option value="" disabled selected>Select category...</option>
                    <option value="Clothes">Clothes</option>
                    <option value="Shoes">Shoes</option>
                    <option value="Toys">Toys</option>
                </select><br><br>
                <label for="price">Price:</label>
                <input type="text" id="price" name="price" required><br><br>
                <label for="quantity">Quantity:</label>
                <input type="text" id="quantity" name="quantity" required><br><br>
                <label for="rating">Rating:</label>
                <input type="text" id="rating" name="rating" placeholder="Enter rating " required><br><br>
                <label for="description">Description:</label><br>
                <textarea id="description" name="description" rows="4" cols="50" placeholder="Enter product description..." required></textarea><br><br>
                <label for="productPhoto">Product Photo:</label>
                <input type="file" id="productPhoto" name="productPhoto" accept=".jpg, .jpeg, .png, .gif, .bmp" required><br><br>
                <button type="submit" name="insert">Insert</button>
            </fieldset>
        </form>
    </section>

    <footer>
        <?php include_once 'footer.php'; ?>
    </footer>
</body>

</html>
