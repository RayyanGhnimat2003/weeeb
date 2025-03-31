<?php
class Product
{
    private $id;
    private $name;
    private $category;
    private $description;
    private $price;
    private $quantity;
    private $rating;
    private $imageName;
    private $imgsrc;

    public function __construct($id, $name, $category, $description, $price, $quantity, $rating, $imageName, $imgsrc)
    {
        $this->id = $id;
        $this->name = $name;
        $this->category = $category;
        $this->description = $description;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->rating = $rating;
        $this->imageName = $imageName;
        $this->imgsrc = $imgsrc;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPrice()
    {
        return $this->price;
    }


    public function getImgSrc()
    {
        return "images/{$this->imgsrc}"; // Ensure the path is correct relative to your project structure
    }
    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getRating()
    {
        return $this->rating;
    }

    public function getImageName()
    {
        return $this->imageName;
    }

    public function displayTableRow()
    {
        echo "<tr>";
        echo "<td><img src='{$this->getImgSrc()}' alt='Product Image' style='width: 200px; height:200px;' /></td>"; // Set width to 100% and height to auto
        echo "<td><a href='view.php?id={$this->getId()}'>{$this->getId()}</a></td>";
        echo "<td>{$this->getName()}</td>";
        echo "<td>{$this->getCategory()}</td>";
        echo "<td>{$this->getPrice()}</td>";
        echo "<td>{$this->getQuantity()}</td>";
        echo "<td>
        <button type='button' onclick=\"window.location.href='edit.php?id={$this->getId()}'\" border='1'>
            <img src='images/edit.png' alt='Edit' width='20' height='20'>
        </button>
        <button type='button' onclick=\"window.location.href='delete.php?id={$this->getId()}'\" border='1'>
            <img src='images/delete.png' alt='Delete' width='20' height='20'>
        </button>    
    </td>";

        echo "</tr>";
    }

    public function displayProductPage()
    {
        echo "<td><img src='{$this->getImgSrc()}' alt='Product Image' width='400px' height='400px'></td>";
        echo "<br>";
        echo "<hr>";

        echo "<h2>Product ID: {$this->getId()}, {$this->getName()}</h2>";
        echo "<ul>";
        echo "<li>Price: {$this->getPrice()}</li>";
        echo "<li>Category: {$this->getCategory()}</li>";
        echo "<li>Rating: {$this->getRating()}</li>";
        echo "</ul>";
        echo "<hr>";

        echo "<h2>Description:</h2>";

        echo "<p>This product is  highly recommended by our customers, discover its features below.</p>";

        $descriptions = explode(',', $this->getDescription());
        if (!empty($descriptions)) {
            echo "<ul>";
            foreach ($descriptions as $desc) {
                echo "<li>$desc</li>";
            }
            echo "</ul>";
        }
    }
}
