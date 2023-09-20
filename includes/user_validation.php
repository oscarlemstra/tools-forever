<?php
if (empty($_SESSION['user'])) {
    $exploded_url = explode('/', $_SESSION['url']);
    $last_element = count($exploded_url) - 1;

    if ($exploded_url[$last_element] === "pages") {
        header("Location: ./login.php");
        exit();
    } else {
        header("Location: ./pages/login.php");
        exit();
    }
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
