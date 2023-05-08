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

    if (empty($_POST)) {
        $stmt = $conn->prepare(
            "SELECT `pn`.`name` AS `product_name`, `p`.`type`, `m`.`name` AS `manufacturer`, `lhp`.`in_stock`
            FROM `location_has_products` `lhp`
            INNER JOIN `products` `p` ON `lhp`.`product_id` = `p`.`id`
            INNER JOIN `product_names` `pn` ON `p`.`product_name_id` = `pn`.`id`
            INNER JOIN `manufacturers` `m` ON `p`.`manufacturer_id` = `m`.`id`
            WHERE `lhp`.`location_id` = ?"
        );
        $stmt->execute([$_SESSION['user']['location_id']]);
    }
    
    if (!empty($_POST['location']) && empty($_POST['product'])) {
        $stmt = $conn->prepare(
            "SELECT `pn`.`name` AS `product_name`, `p`.`type`, `m`.`name` AS `manufacturer`, `lhp`.`in_stock`
            FROM `location_has_products` `lhp`
            INNER JOIN `products` `p` ON `lhp`.`product_id` = `p`.`id`
            INNER JOIN `product_names` `pn` ON `p`.`product_name_id` = `pn`.`id`
            INNER JOIN `manufacturers` `m` ON `p`.`manufacturer_id` = `m`.`id`
            WHERE `lhp`.`location_id` = ?"
        );
        $stmt->execute([$_POST['location']]);
    }
    
    if (!empty($_POST['location']) && !empty($_POST['product'])) {
        $stmt = $conn->prepare(
            "SELECT `pn`.`name` AS `product_name`, `p`.`type`, `m`.`name` AS `manufacturer`, `lhp`.`in_stock`
            FROM `location_has_products` `lhp`
            INNER JOIN `products` `p` ON `lhp`.`product_id` = `p`.`id`
            INNER JOIN `product_names` `pn` ON `p`.`product_name_id` = `pn`.`id`
            INNER JOIN `manufacturers` `m` ON `p`.`manufacturer_id` = `m`.`id`
            WHERE `lhp`.`location_id` = ? AND `p`.`product_name_id` = ?"
        );
        $stmt->execute([$_POST['location'], $_POST['product']]);
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