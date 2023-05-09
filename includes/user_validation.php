<?php
if (empty($_SESSION['user'])) { // TODO: werkt alleen voor index page, fix het.
    header("Location: ./pages/login.php");
    exit();
}

if ($_SESSION['access'] === "office" && (int) $_SESSION['user']['role_id'] < 2) {
    header("Location: ../index.php");
    exit();
}

if ($_SESSION['access'] === "admin" && (int) $_SESSION['user']['role_id'] < 3) {
    header("Location: ../index.php");
    exit();
}
?>