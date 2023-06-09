<?php
session_start();

require_once "../includes/pdo_variables.php";


// delete's all location_has_product records of the product
try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $conn->beginTransaction();

    $stmt = $conn->prepare("DELETE FROM `location_has_products` WHERE `product_id` = ?");
    $stmt->execute([$_SESSION['product']['id']]);

    $conn->commit();
} catch (PDOException $e) {
    $conn->rollBack();
    $_SESSION['error'] = 'Er is iets fout gegaan, probeer het later opnieuw!';
    //echo "Error : " . $e->getMessage();
}
$conn = null;


// delete's a product
try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $conn->beginTransaction();

    $stmt = $conn->prepare("DELETE FROM `products` WHERE `id` = ?");
    $stmt->execute([$_SESSION['product']['id']]);

    $conn->commit();
} catch (PDOException $e) {
    $conn->rollBack();
    $_SESSION['error'] = 'Er is iets fout gegaan, probeer het later opnieuw!';
    //echo "Error : " . $e->getMessage();
}
$conn = null;


if (!empty($_SESSION['error'])) {
    header('Location: ../pages/product_edit.php?product='.$_SESSION['product']['id']);
    exit();
}

$_SESSION['success'] = 'Het product is succesvol uit het systeem verwijderd!';
header('Location: ../pages/products.php');
exit();
?>