<?php
session_start();

require_once "../includes/pdo_variables.php";


// updates a employee
try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $conn->beginTransaction();

    $stmt = $conn->prepare(
        "UPDATE `staff`
        SET `location_id` = ?, `role_id` = ?, `first_name` = ?, `last_name` = ?
        WHERE `id` = ?"
    );
    $stmt->execute([$_POST['location'], $_POST['role'], $_POST['first_name'], $_POST['last_name'], $_SESSION['employee']['id']]);

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

$_SESSION['success'] = 'De werknemer is succesvol bewerkt!';
header('Location: ../pages/staff.php');
exit();
?>