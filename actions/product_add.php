<?php
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
        "INSERT INTO `productsx`
        (`product_name_id`, `manufacturer_id`, `type`, `purchase_price`, `sell_price`)
        VALUES (?, ?, ?, ?, ?)"
    );
    $stmt->execute([$_POST['product_name'], $_POST['manufacturer'], $_POST['type'], $_POST['purchase_price'], $_POST['sell_price'],]);

    $conn->commit();
} catch (PDOException $e) {
    $conn->rollBack();
    $_SESSION['error'] = 'Er is iets fout gegaan, probeer het later opnieuw!';
    //echo "Error : " . $e->getMessage();
}
$conn = null;


if (!empty($_SESSION['error'])) {
    header('Location: ../pages/product_add.php?error=true');
    exit();
}

unset($_SESSION['error']);
header('Location: ../pages/products.php');
exit();
?>