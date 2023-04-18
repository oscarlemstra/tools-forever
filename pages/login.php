<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../resources/styles/main.css">
    <title>Login</title>
</head>
<body>
    <form action="../actions/login.php" method="post">
        <label for="first_name">Voornaam</label><br>
        <input type="text" id="first_name" name="first_name" placeholder="Voornaam" autofocus required><br><br>

        <label for="last_name">Tussenvoegsel en achternaam</label><br>
        <input type="text" id="last_name" name="last_name" placeholder="Achternaam" required><br><br>

        <label for="password">Wachtwoord</label><br>
        <input type="password" id="password" name="password" placeholder="Wachtwoord" required><br>

        <?php
            if (isset($_SESSION['error'])) {
                echo "<p class='error'>".$_SESSION['error']."</p>";
            }
        ?>
    
        <br>
        <input type="submit" value="Login">
    </form>
</body>
</html>