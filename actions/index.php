<?php
$servername = "localhost";
$dbname = "tools_forever";
$username = "root";
$password = "";

// gets locations
try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM `locations`");
    $stmt->execute();

    $result = $stmt->fetchAll();
} catch (PDOException $e) {
    // $_SESSION['error'] = 'Er is iets fout gegaan, probeer het later opnieuw!';
    //echo "Error : " . $e->getMessage();
}
$conn = null;

$_SESSION['locations'] = $result;


// gets product_names
try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM `product_names`");
    $stmt->execute();

    $result = $stmt->fetchAll();
} catch (PDOException $e) {
    // $_SESSION['error'] = 'Er is iets fout gegaan, probeer het later opnieuw!';
    //echo "Error : " . $e->getMessage();
}
$conn = null;

$_SESSION['product_names'] = $result;


// get products
try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (!isset($_POST['location'])) {
        // TODO: fix query! 
        $stmt = $conn->prepare(
            "SELECT * FROM `location_has_products` `lhp`
            INNER JOIN `products` `p` ON `lhp`.`product_id` = `p`.`id`
            WHERE `lhp`.`location_id` = ?"
        );
        $stmt->execute([$_SESSION['user']['location_id']]);
    } else {
        $stmt = $conn->prepare("SELECT * FROM `location_has_products` WHERE `location_id` = ?");
        $stmt->execute([$_POST['location']]);
    }

    $result = $stmt->fetchAll();
} catch (PDOException $e) {
    //$_SESSION['error'] = 'Er is iets fout gegaan, probeer het later opnieuw!';
    //echo "Error : " . $e->getMessage();
}
$conn = null;

$_SESSION['products'] = $result;
//unset($_SESSION['error']);

// TODO: fix errors!
?>