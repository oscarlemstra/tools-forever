<?php
require_once "../includes/pdo_variables.php";


// gets selected product
try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM `products` WHERE `id` = ?");
    $stmt->execute([$_GET['product']]);

    $result = $stmt->fetchAll();
} catch (PDOException $e) {
    $_SESSION['error'] = 'Er is iets fout gegaan, probeer het later opnieuw!';
    //echo "Error : " . $e->getMessage();
}
$conn = null;

$_SESSION['product'] = $result[0];


// gets the location_has_product from the selected product with the user's location
try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare(
        "SELECT * FROM `location_has_products`
        WHERE `location_id` = ? AND product_id = ?"
    );
    $stmt->execute([$_SESSION['user']['location_id'], $_SESSION['product']['id']]);

    $result = $stmt->fetchAll();
} catch (PDOException $e) {
    $_SESSION['error'] = 'Er is iets fout gegaan, probeer het later opnieuw!';
    //echo "Error : " . $e->getMessage();
}
$conn = null;

$_SESSION['product_stock'] = $result[0];


// gets product_names
try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM `product_names`");
    $stmt->execute();

    $result = $stmt->fetchAll();
} catch (PDOException $e) {
    $_SESSION['error'] = 'Er is iets fout gegaan, probeer het later opnieuw!';
    //echo "Error : " . $e->getMessage();
}
$conn = null;

$_SESSION['product_names'] = $result;


// gets manufacturer_names
try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM `manufacturers`");
    $stmt->execute();

    $result = $stmt->fetchAll();
} catch (PDOException $e) {
    $_SESSION['error'] = 'Er is iets fout gegaan, probeer het later opnieuw!';
    //echo "Error : " . $e->getMessage();
}
$conn = null;

$_SESSION['manufacturer_names'] = $result;
?>