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
    <div class="flex-box h-vh-80 justify-content-center align-items-center gap-75">
        <img class="img-s-m" src="../resources/img/nut_screwdriver.png" alt="logo icon">
        
        <form class="element element-s-m p-30" action="../actions/login.php" method="post">
            <input class="mb-25" type="text" id="first_name" name="first_name" placeholder="Voornaam" autofocus required>
            
            <input class="mb-25" type="text" id="last_name" name="last_name" placeholder="Achternaam" required>

            <input class="mb-25" type="password" id="password" name="password" placeholder="Wachtwoord" required>
        
            <?php
                if (isset($_SESSION['error'])) {
                    echo "<p class='error'>".$_SESSION['error']."</p>";
                }
            ?>
    
            <input class="login-bt mt-25" type="submit" value="Login">
        </form>
    </div>
</body>
</html>