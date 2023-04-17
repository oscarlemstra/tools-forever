<?php
session_start();

$servername = "localhost";
$dbname = "tools_forever";
$username = "root";
$password = "";

// gets the username that is given
try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM `staff` WHERE `first_name` = ? AND `last_name` = ?");
    $stmt->execute([$_POST['first_name'], $_POST['last_name']]);

    $result = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error : " . $e->getMessage();
}
$conn = null;


if ($_POST['first_name'] !== $result[0]['first_name']) {
    $_SESSION['error'] = 'Gegevens zijn fout!';
    header('Location: ../pages/login.php');
    exit();
}

if ($_POST['last_name'] !== $result[0]['last_name']) {
    $_SESSION['error'] = 'Gegevens zijn fout!';
    header('Location: ../pages/login.php');
    exit();
}

if (hash('sha512', $_POST['password']) !== $result[0]['password']) {
    $_SESSION['error'] = 'Gegevens zijn fout!';
    header('Location: ../pages/login.php');
    exit();
}

//TO-DO $_SESSION['error'] deleten
$_SESSION['user'] = $result[0];
header('Location: ../index.php');
exit();
?>

<!-- debug -->
<pre>
    <?php print_r($_POST); ?>
</pre>

<pre>
    <?php print_r($result); ?>
</pre>
<!-- debug -->