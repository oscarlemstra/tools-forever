<?php
require_once "../includes/pdo_variables.php";

unset($_SESSION['error']);


// gets worker location
try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT `place_name` FROM `locations` WHERE `id` = ?");
    $stmt->execute([$_SESSION['user']['location_id']]);

    $result = $stmt->fetchAll();
} catch (PDOException $e) {
    $_SESSION['error'] = 'Er is iets fout gegaan, probeer het later opnieuw!';
    //echo "Error : " . $e->getMessage();
}
$conn = null;

$_SESSION['worker_location'] = $result[0]['place_name'];


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


// get products
try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (empty($_POST) || $_POST['product'] === "all") {
        $stmt = $conn->prepare(
            "SELECT `pn`.`name` AS `p_name`, `p`.`type`, `m`.`name` AS `m_name`, `p`.`purchase_price`, `p`.`sell_price`, `p`.`id`, `lhp`.`in_stock`, `lhp`.`min_stock`
            FROM `products` `p`
            INNER JOIN `product_names` `pn` ON `p`.`product_name_id` = `pn`.`id`
            INNER JOIN `manufacturers` `m` ON `p`.`manufacturer_id` = `m`.`id`
            INNER JOIN `location_has_products` `lhp` ON `p`.`id` = `lhp`.`product_id`
            WHERE `lhp`.`location_id` = ?"
        );
        $stmt->execute([$_SESSION['user']['location_id']]);
    } else {
        $stmt = $conn->prepare(
            "SELECT `pn`.`name` AS `p_name`, `p`.`type`, `m`.`name` AS `m_name`, `p`.`purchase_price`, `p`.`sell_price`, `p`.`id`, `lhp`.`in_stock`, `lhp`.`min_stock`
            FROM `products` `p`
            INNER JOIN `product_names` `pn` ON `p`.`product_name_id` = `pn`.`id`
            INNER JOIN `manufacturers` `m` ON `p`.`manufacturer_id` = `m`.`id`
            INNER JOIN `location_has_products` `lhp` ON `p`.`id` = `lhp`.`product_id`
            WHERE `p`.`product_name_id` = ? AND `lhp`.`location_id` = ?"
        );
        $stmt->execute([$_POST['product'], $_SESSION['user']['location_id']]);
    }

    $result = $stmt->fetchAll();
} catch (PDOException $e) {
    $_SESSION['error'] = 'Er is iets fout gegaan, probeer het later opnieuw!';
    //echo "Error : " . $e->getMessage();
}
$conn = null;

$_SESSION['products'] = $result;
?>