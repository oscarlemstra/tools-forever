<?php
session_start();

require_once "../includes/pdo_variables.php";


// delete's a employee
try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $conn->beginTransaction();

    $stmt = $conn->prepare("DELETE FROM `staff` WHERE `id` = ?");
    $stmt->execute([$_SESSION['employee']['id']]);

    $conn->commit();
} catch (PDOException $e) {
    $conn->rollBack();
    $_SESSION['error'] = 'Er is iets fout gegaan, probeer het later opnieuw!';
    //echo "Error : " . $e->getMessage();
}
$conn = null;


if (!empty($_SESSION['error'])) {
    header('Location: ../pages/employee_edit.php?employee='.$_SESSION['employee']['id']);
    exit();
}

$_SESSION['success'] = 'De werknemer is succesvol uit het systeem verwijderd!';
header('Location: ../pages/staff.php');
exit();
?>