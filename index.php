<?php 
    session_start();
    require_once "./actions/index.php";
?>

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

    <pre><?php print_r($_SESSION['products']); ?></pre>
    <pre><?php print_r($_POST); ?></pre>

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
        <div class="flex-box align-items-flex-start gap-20">
            <form class="element element-s-s p-10 mt-45" action="" method="post">
                <?php // a select element for location
                    echo '<select class="mb-10" id="location" name="location" required>';
                    echo '<option value="">Locatie</option>';

                    foreach ($_SESSION['locations'] as $location) {
                        echo '<option value="'.$location['id'].'">'.$location['place_name'].'</option>';
                    }
                    echo '</select>';
                ?>

                <?php // a select element for prduct
                    echo '<select class="mb-10" id="product" name="product">';
                    echo '<option value="">Product</option>';

                    foreach ($_SESSION['product_names'] as $product_name) {
                        echo '<option value="'.$product_name['id'].'">'.$product_name['name'].'</option>';
                    }
                    echo '</select>';
                ?>

                <?php
                    if (isset($_SESSION['error'])) {
                        echo "<p class='error'>".$_SESSION['error']."</p>";
                    }
                ?>
        
                <input class="main-bt mt-25" type="submit" value="Zoeken">
            </form>
            <div>
                <div>
                    <h1>Voorraad overzicht</h1>
                </div>
                <div class="element element-s-l p-15">
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
</body>
</html>