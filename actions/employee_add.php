<?php
session_start();

require_once "../includes/pdo_variables.php";

$_POST['password'] = hash('sha512', $_POST['password']);


// inserts a employee
try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $conn->beginTransaction();

    $stmt = $conn->prepare(
        "INSERT INTO `staff`
        (`location_id`, `role_id`, `first_name`, `last_name`, `password`)
        VALUES (?, ?, ?, ?, ?)"
    );
    $stmt->execute([$_POST['location'], $_POST['role'], $_POST['first_name'], $_POST['last_name'], $_POST['password']]);
    
    $conn->commit();
} catch (PDOException $e) {
    $conn->rollBack();
    $_SESSION['error'] = 'Er is iets fout gegaan, probeer het later opnieuw!';
    //echo "Error : " . $e->getMessage();
}
$conn = null;


if (!empty($_SESSION['error'])) {
    header('Location: ../pages/employee_add.php');
    exit();
}

$_SESSION['success'] = 'Een werknemer is succesvol toegevoegd!';
header('Location: ../pages/staff.php');
exit();
?>