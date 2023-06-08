<?php
    session_start();
    $_SESSION['url'] = __DIR__;
    $_SESSION['access'] = 'all';
    require_once "./includes/user_validation.php";
    require_once "./actions/index.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./resources/styles/main.css">
    <title>Home</title>
</head>
<body>
    <div class="main-div">
        <nav class="flex-box align-items-center justify-content-space-between">
            <div class="flex-box align-items-center gap-10">
                <img class="img-s-s" src="./resources/img/nut_screwdriver.png" alt="logo icon">
                <a class="nav-link nav-link-selected" href="">Home</a>
            </div>

            <div>
                <?php
                    if ((int) $_SESSION['user']['role_id'] >= 2) {
                        echo '<a class="nav-link" href="./pages/reports.php">Rapportages</a>';
                        echo '<a class="nav-link" href="./pages/products.php">Producten</a>';
                    }

                    if ((int) $_SESSION['user']['role_id'] === 3) {
                        echo '<a class="nav-link" href="">Locaties</a>';
                        echo '<a class="nav-link" href="./pages/staff.php">Werknemers</a>';
                    }
                ?>
            </div>
        </nav>
        <div class="flex-box align-items-flex-start gap-20">
            <form class="element element-s-s p-10 mt-45" action="" method="post">
                <?php // a select element for location
                    echo '<select class="mb-10" id="location" name="location" required>';
                    echo '<option value="">Locatie</option>';

                    foreach ($_SESSION['locations'] as $location) {
                        if (!empty($_POST)) {
                            if ($location['id'] === $_POST['location']) {
                                echo '<option value="'.$location['id'].'" selected>'.$location['place_name'].'</option>';
                            } else {
                                echo '<option value="'.$location['id'].'">'.$location['place_name'].'</option>';
                            }
                        } else {
                            if ($location['id'] === $_SESSION['user']['location_id']) {
                                echo '<option value="'.$location['id'].'" selected>'.$location['place_name'].'</option>';
                            } else {
                                echo '<option value="'.$location['id'].'">'.$location['place_name'].'</option>';
                            }
                        }
                    }
                    echo '</select>';
                ?>

                <?php // a select element for product
                    echo '<select class="mb-10" id="product" name="product">';
                    echo '<option value="">Alle Product</option>';

                    foreach ($_SESSION['product_names'] as $product_name) {
                        if ($product_name['id'] === $_POST['product']) {
                            echo '<option value="'.$product_name['id'].'" selected>'.$product_name['name'].'</option>';
                        } else {
                            echo '<option value="'.$product_name['id'].'">'.$product_name['name'].'</option>';
                        }
                    }
                    echo '</select>';
                ?>
        
                <input class="main-bt mt-25" type="submit" value="Zoeken">
            </form>
            <div>
                <div>
                    <h1>Voorraad overzicht</h1>
                </div>
                <div class="element element-s-l p-15">
                    <?php
                        if (isset($_SESSION['error'])) {
                            echo "<p class='error'>".$_SESSION['error']."</p>";
                        }

                        if (empty($_SESSION['products']) && empty($_SESSION['error'])) {
                            echo "<p>Er zijn geen resultaten gevonden.</p>";
                        }

                        if (!empty($_SESSION['products']) && empty($_SESSION['error'])) {
                    ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Type</th>
                                <th>Fabriek</th>
                                <th>In voorraad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php // create's <tr> elements with the products data
                                foreach ($_SESSION['products'] as $product) {
                                    echo '<tr>';
                                        echo '<td>'.$product['product_name'].'</td>';
                                        echo '<td>'.$product['type'].'</td>';
                                        echo '<td>'.$product['manufacturer'].'</td>';
                                        echo '<td class="text-align-end">'.$product['in_stock'].'</td>';
                                    echo '</tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>