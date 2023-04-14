<?php

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
?>

<pre>
    <?php print_r($_POST); ?>
</pre>

<pre>
    <?php print_r($result); ?>
</pre>