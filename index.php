<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resources/styles/main.css">
    <title>Home</title>
</head>
<body>
    <div class="main-div">
        <nav class="flex-box align-items-center justify-content-space-between">
            <img class="img-s-s" src="./resources/img/nut_screwdriver.png" alt="logo icon">

            <div>
                <a class="nav-link" href="">Rapportages</a>
                <a class="nav-link" href="">Producten</a>
                <a class="nav-link" href="">Locaties</a>
                <a class="nav-link" href="">Werknemers</a>
            </div>
        </nav>
        <div class="flex-box">
            <form class="element element-s-s p-10" action="" method="post">
                <select id="location" name="location">
                    <option value="test1">test 1</option>
                    <option value="test2">test 2</option>
                </select>

                <select id="product" name="product">
                    <option value="test1">test 1</option>
                    <option value="test2">test 2</option>
                </select>

                <?php
                    if (isset($_SESSION['error'])) {
                        echo "<p class='error'>".$_SESSION['error']."</p>";
                    }
                ?>
        
                <input class="" type="submit" value="Zoeken">
            </form>
            <div>
                <div>
                    <h1>Voorraad overzicht</h1>
                </div>
                <div>
                    <table>
                        <tr>
                            <th>Product</th>
                            <th>Type</th>
                            <th>Fabriek</th>
                            <th>In voorraad</th>
                        </tr>
                        <tr>
                            <td>Futterkiste</td>
                            <td>Maria</td>
                            <td>Germany</td>
                            <td>Germany</td>
                        </tr>
                        <tr>
                            <td>Centro</td>
                            <td>Francisco</td>
                            <td>Mexico</td>
                            <td>Mexico</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- <pre><?php //print_r($_SESSION['user']); ?></pre> -->
</body>
</html>