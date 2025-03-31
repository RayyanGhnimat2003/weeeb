<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Page</title>
</head>

<body>
    <header>
        <article class="logo">
            <img src="./images/AlamalClothes.png" alt="Alamal Clothes Logo" width="80">
            <h1>Alamal Clothes</h1>
        </article>
        <nav>
            <ul>
                <li><a href="products.php">Home</a></li>
                <li><a href="products.php">Products</a></li>
            </ul>
        </nav>
        <hr>
        <h1>Edit Page</h1>
        <figure>
            <img src="./images/add.jpg" width="400px" height="400px" alt="Add Logo">
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

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
        $productId = $_POST['productId'];
        $productName = $_POST['productName'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $description = $_POST['description'];
        $fileName = null;
        $targetFilePath = null;
        if (!empty($_FILES["productPhoto"]["name"])) {
            $fileType = pathinfo($_FILES["productPhoto"]["name"], PATHINFO_EXTENSION);

            if ($fileType == "jpg" || $fileType == "jpeg") {
                $fileName = $productId . '.' . $fileType;

                if (move_uploaded_file($_FILES["productPhoto"]["tmp_name"], "images/" . $fileName)) {
                    $targetFilePath = "images/" . $fileName;
                } else {
                    echo "Error uploading image to folder";
                }
            } else {
                echo "Error, only JPEG and JPG files are allowed";
                exit;
            }
        } else {
            $productId = $_POST['productId'];
            $stmt = $pdo->prepare("SELECT imgsrc FROM product WHERE ID = ?");
            $stmt->execute([$productId]);
            $existingImagePath = $stmt->fetchColumn();
            $targetFilePath = $existingImagePath;
        }

        $stmt = $pdo->prepare("UPDATE product SET name = ?, price = ?, quantity = ?, description = ?, imageName = ?, imgsrc = ? WHERE ID = ?");
        $params = [$productName, $price, $quantity, $description,  $fileName, $targetFilePath, $productId];
        $stmt->execute($params);

        echo "Product updated successfully!";
    } elseif (isset($_GET['id'])) {
        $productId = $_GET['id'];
        $stmt = $pdo->prepare("SELECT * FROM product WHERE ID = ?");
        $stmt->execute([$productId]);
        $product = $stmt->fetch();
    ?>
        <h1>Edit Product</h1>
        <form method='POST' action='edit.php' enctype='multipart/form-data'>
            <input type='hidden' name='productId' value='<?php echo $product['ID']; ?>'>
            <fieldset>
                <legend>Product Record</legend>
                <label for='productId'>Product ID:</label>
                <input type='text' id='productId' name='productIdDisplay' value='<?php echo $product['ID']; ?>' disabled><br><br>

                <label for='category'>Category:</label>
                <input type='text' id='category' name='category' value='<?php echo $product['category']; ?>' disabled><br><br>

                <label for='productName'>Product Name:</label>
                <input type='text' id='productName' name='productName' value='<?php echo $product['name']; ?>'><br><br>

                <label for='rating'>Rating:</label>
                <input type='text' id='rating' name='rating' value='<?php echo $product['rating']; ?>' disabled><br><br>

                <label for='price'>Price:</label>
                <input type='text' id='price' name='price' value='<?php echo $product['price']; ?>'><br><br>

                <label for='quantity'>Quantity:</label>
                <input type='text' id='quantity' name='quantity' value='<?php echo $product['quantity']; ?>'><br><br>

                <label for='description'>Description:</label><br>
                <textarea id='description' name='description' rows='4' cols='50'><?php echo $product['description']; ?></textarea><br><br>

                <label for='productPhoto'>Product Photo </label>
                <input type='file' id='productPhoto' name='productPhoto' accept='.jpg, .jpeg'><br><br>

                <button type='submit' name='update'>Update</button>
            </fieldset>
        </form>

    <?php
    } else {
    }

    ?>
    <br>
    <br>
    <hr>

    <?php
    include_once 'footer.php';
    ?>
</body>

</html>
