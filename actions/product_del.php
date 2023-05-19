<?php
session_start();

$servername = "localhost";
$dbname = "tools_forever";
$username = "root";
$password = "";


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
    $_SESSION['error'] = 'Er is iets fout gegaan, probeer het later opnieuw! <br><br> Als er nog voorraad is kan je het product niet verwijderen!';
    //echo "Error : " . $e->getMessage();
}
$conn = null;


if (!empty($_SESSION['error'])) {
    header('Location: ../pages/product_edit.php?product='.$_SESSION['product']['id']);
    exit();
}

$_SESSION['success'] = 'Het product is succesvol verwijderd!';
header('Location: ../pages/products.php');
exit();
?>