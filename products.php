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
        <section id="welcome-section">
            <h2>Welcome to Alamal Clothes</h2>
            <p>Hello and welcome to our new shop, Alamal Clothes!</p>
            <figure id="image-section">
                <img src="./images/pexels-cottonbro-studio-6069556.jpg" alt="rayan clothes" height="400" />
                <img src="./images/pexels-sam-lion-5710153.jpg" alt="rayan clothes" height="400" />
            </figure>
        </section>
        <hr>
    </header>

    <?php
    include_once 'dbconfig.in.php';
    include_once 'Product.php';

    function getProducts($pdo)
    {
        $stmt = $pdo->prepare("SELECT * FROM product");
        $stmt->execute();
        $products = array();
        while ($row = $stmt->fetch()) {
            $products[] = new Product($row['ID'], $row['name'], $row['category'], $row['description'], $row['price'], $row['quantity'], $row['rating'], $row['imageName'], $row['imgsrc']);
        }
        return $products;
    }

    function getCategories($pdo)
    {
        $stmt = $pdo->prepare("SELECT DISTINCT category FROM product");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
        $searchBy = isset($_POST['searchBy']) ? $_POST['searchBy'] : ''; // Check if 'searchBy' exists
        $searchTerm = trim($_POST['searchTerm']);
        $category = isset($_POST['category']) ? $_POST['category'] : '';

        $query = "SELECT * FROM product WHERE true";

        $query .= (!empty($searchTerm)) ? (($searchBy === 'price') ? " AND price >= :searchTerm" : " AND $searchBy LIKE :searchTerm") : '';

        if (!empty($category)) {
            $query .= " AND category = :category";
        }

        $stmt = $pdo->prepare($query);

        if (!empty($searchTerm)) {
            if ($searchBy === 'price') {
                $stmt->bindValue(':searchTerm', $searchTerm, PDO::PARAM_INT);
            } else {
                $stmt->bindValue(':searchTerm', "%$searchTerm%", PDO::PARAM_STR);
            }
        }

        if (!empty($category)) {
            $stmt->bindValue(':category', $category);
        }

        $stmt->execute();
        $products = [];
        while ($row = $stmt->fetch()) {
            $products[] = new Product($row['ID'], $row['name'], $row['category'], $row['description'], $row['price'], $row['quantity'], $row['rating'], $row['imageName'], $row['imgsrc']);
        }
    } else {
        $products = getProducts($pdo);
    }

    $categories = getCategories($pdo);
    ?>

    <section>
        <h1>Product Listing</h1>
        <p>To Add a new Product click on the following link <a href="add.php">Add Product</a>.</p>
        <p>Or use the actions below to edit or delete a Product's record.</p>

        <fieldset>
            <legend>Advanced Product Search</legend>
            <form method="POST" action="products.php" id="searchForm">
                <input type="text" name="searchTerm" id="searchTerm" placeholder='Search using Product Name......'>
                <input type="radio" name="searchBy" value="name" onchange="updatePlaceholder(this)" checked> Product Name
                <input type="radio" name="searchBy" value="price" onchange="updatePlaceholder(this)"> Price
                <input type="radio" name="searchBy" value="category" onchange="updatePlaceholder(this)"> Category
                <select name="category">
                    <option value="">All</option>
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?php echo ($category); ?>"><?php echo ($category); ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" name="search">Filter</button>
            </form>

            <br>
            <table border="1" cellpadding="10">
                <tr>
                    <th>Product Image</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($products as $product) : ?>
                    <?php echo $product->displayTableRow(); ?>
                <?php endforeach; ?>
            </table>
        </fieldset>
    </section>

    <script>
        function updatePlaceholder(radio) {
            const searchTermInput = document.getElementById('searchTerm');
            switch (radio.value) {
                case 'name':
                    searchTermInput.placeholder = 'Search using Product Name......';
                    break;
                case 'price':
                    searchTermInput.placeholder = 'Search using minumun price......';
                    break;
                case 'category':
                    searchTermInput.placeholder = 'Search using Category...';
                    break;
                default:
                    searchTermInput.placeholder = 'Search...';
                    break;
            }
        }
    </script>

    <br>
    <br>
    <br>
    <br>

    <hr>
    <?php
    include_once 'footer.php';
    ?>
</body>

</html>
