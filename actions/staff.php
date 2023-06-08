<?php
require_once "../includes/pdo_variables.php";


// gets selected location
try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT `place_name` FROM `locations` WHERE `id` = ?");
    
    if (empty($_POST['location'])) {
        $stmt->execute([$_SESSION['user']['location_id']]);
    } else {
        $stmt->execute([$_POST['location']]);
    }

    $result = $stmt->fetchAll();
} catch (PDOException $e) {
    $_SESSION['error'] = 'Er is iets fout gegaan, probeer het later opnieuw!';
    //echo "Error : " . $e->getMessage();
}
$conn = null;

$_SESSION['selected_location'] = $result[0]['place_name'];


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

$_SESSION['locations'] = $result;


// get staff
try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare(
        "SELECT `s`.`first_name`, `s`.`last_name`, `r`.`role`, `s`.`id`
        FROM `staff` `s`
        INNER JOIN `roles` `r` ON `s`.`role_id` = `r`.`id`
        WHERE `s`.`location_id` = ?"
    );

    if (empty($_POST['location'])) {
        $stmt->execute([$_SESSION['user']['location_id']]);
    } else {
        $stmt->execute([$_POST['location']]);
    }
    
    $result = $stmt->fetchAll();
} catch (PDOException $e) {
    $_SESSION['error'] = 'Er is iets fout gegaan, probeer het later opnieuw!';
    //echo "Error : " . $e->getMessage();
}
$conn = null;

$_SESSION['staff'] = $result;
?>