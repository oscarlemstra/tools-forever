<?php
$servername = "localhost";
$dbname = "tools_forever";
$username = "root";
$password = "";


// gets all locations
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

$_SESSION['locations'] = $result;
unset($result);


// gets all the right products depanding on the $report value
try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    switch ($report) {
        case "total_stock":
            foreach ($_SESSION['locations'] as $location) {
                $stmt = $conn->prepare(
                    "SELECT `pn`.`name` AS `p_name`, `p`.`type`, `m`.`name` AS `m_name`, `lhp`.`in_stock`, `p`.`purchase_price`, `p`.`sell_price`, `lhp`.`location_id`
                    FROM `products` `p`
                    INNER JOIN `product_names` `pn` ON `p`.`product_name_id` = `pn`.`id`
                    INNER JOIN `manufacturers` `m` ON `p`.`manufacturer_id` = `m`.`id`
                    INNER JOIN `location_has_products` `lhp` ON `p`.`id` = `lhp`.`product_id`
                    WHERE `lhp`.`location_id` = ?"
                );
                $stmt->execute([$location['id']]);
        
                $result[] = $stmt->fetchAll();
            }
            break;
        case "stock_value":
            echo "<h1>Rapportage - Voorraad waarde</h1>";
            break;
        case "order_list":
            echo "<h1>Rapportage - Bestellijst</h1>";
            break;
        default:
            $result = "no post data";
    }
} catch (PDOException $e) {
    $_SESSION['error'] = 'Er is iets fout gegaan, probeer het later opnieuw!';
    //echo "Error : " . $e->getMessage();
}
$conn = null;

$_SESSION['report'] = $result;
?>