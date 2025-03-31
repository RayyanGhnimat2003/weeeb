<?php
$host = "localhost";
$dbname = "clothingstore";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // echo "Connected to database successfully.";
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

?>
