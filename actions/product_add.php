<?php
session_start();

$servername = "localhost";
$dbname = "tools_forever";
$username = "root";
$password = "";


// inserts a product
try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $conn->beginTransaction();

    $stmt = $conn->prepare(
        "INSERT INTO `products`
        (`product_name_id`, `manufacturer_id`, `type`, `purchase_price`, `sell_price`)
        VALUES (?, ?, ?, ?, ?)"
    );
    $stmt->execute([$_POST['product_name'], $_POST['manufacturer'], $_POST['type'], $_POST['purchase_price'], $_POST['sell_price']]);

    $lastInsertId = $conn->lastInsertId();
    
    $conn->commit();
} catch (PDOException $e) {
    $conn->rollBack();
    $_SESSION['error'] = 'Er is iets fout gegaan, probeer het later opnieuw!';
    //echo "Error : " . $e->getMessage();
}
$conn = null;


// gets locations
try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM `locations`");
    $stmt->execute();

    $result = $stmt->fetchAll();
} catch (PDOException $e) {
    $_SESSION['error'] = 'Er is iets fout gegaan, probeer het later opnieuw!';
    //echo "Error : " . $e->getMessage();
}
$conn = null;

$locations = $result;


// inserts location_has_products
try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $conn->beginTransaction();

    $stmt = $conn->prepare(
        "INSERT INTO `location_has_products`
        (`location_id`, `product_id`, `in_stock`, `min_stock`)
        VALUES (?, ?, ?, ?)"
    );

    foreach ($locations as $location) {
        $stmt->execute([$location['id'], $lastInsertId, 0, 0]);
    }

    $conn->commit();
} catch (PDOException $e) {
    $conn->rollBack();
    $_SESSION['error'] = 'Er is iets fout gegaan, probeer het later opnieuw!';
    //echo "Error : " . $e->getMessage();
}
$conn = null;


if (!empty($_SESSION['error'])) {
    header('Location: ../pages/product_add.php');
    exit();
}

$_SESSION['success'] = 'Het product is succesvol toegevoegd!';
header('Location: ../pages/products.php');
exit();
?>