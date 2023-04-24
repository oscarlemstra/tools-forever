<?php
$servername = "localhost";
$dbname = "tools_forever";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (!isset($_SESSION['products'])) {
        $stmt = $conn->prepare("SELECT * FROM `location_has_products` WHERE `location_id` = ?");
        $stmt->execute([$_SESSION['user']['location_id']]);
    }
    // TODO: add else

    $result = $stmt->fetchAll();
} catch (PDOException $e) {
    $_SESSION['error'] = 'Er is iets fout gegaan, probeer het later opnieuw!';
    header('Location: ../index.php');
    exit();
    //echo "Error : " . $e->getMessage();
}
$conn = null;

$_SESSION['products'] = $result;
unset($_SESSION['error']);
header('Location: ../index.php');
exit();
?>