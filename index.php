<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <p>Welkom <?php echo $_SESSION['user']['first_name']." ".$_SESSION['user']['last_name']; ?></p>
    <p>dit is een test:<?php echo " de test werkt."; ?> </p>


    <div style="border: black 2px solid; height: 100px; width: 100px;"></div>
</body>
</html>