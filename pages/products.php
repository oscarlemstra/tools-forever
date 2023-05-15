<?php
    session_start();
    $_SESSION['url'] = __DIR__;
    $_SESSION['access'] = 'office';
    require_once "../includes/user_validation.php";
    require_once "../actions/products.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../resources/styles/main.css">
    <title>Producten</title>
</head>
<body>
    <div class="main-div">
        <nav class="flex-box align-items-center justify-content-space-between">
            <div class="flex-box align-items-center gap-10">
                <img class="img-s-s" src="../resources/img/nut_screwdriver.png" alt="logo icon">
                <a class="nav-link" href="../index.php">Home</a>
            </div>

            <div>
                <?php
                    if ((int) $_SESSION['user']['role_id'] >= 2) {
                        echo '<a class="nav-link" href="">Rapportages</a>';
                        echo '<a class="nav-link nav-link-selected" href="">Producten</a>';
                    }

                    if ((int) $_SESSION['user']['role_id'] === 3) {
                        echo '<a class="nav-link" href="">Locaties</a>';
                        echo '<a class="nav-link" href="">Werknemers</a>';
                    }
                ?>
            </div>
        </nav>
        <div class="flex-box align-items-flex-start gap-20">
            <form class="element element-s-s p-10 mt-45" action="" method="post">
                <?php // a select element for prduct
                    echo '<select class="mb-10" id="product" name="product">';
                    echo '<option value="all">Alle Product</option>';

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
                <div class="flex-box justify-content-space-between align-items-center">
                    <h1>Producten overzicht</h1>
                    <a class="flex-box" href="">
                        <i class="material-icons plus-icon">add</i>
                    </a>
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
                        <tr>
                            <th>Product</th>
                            <th>Type</th>
                            <th>Fabriek</th>
                            <th>Inkoop prijs</th>
                            <th>Verkoop prijs</th>
                            <th>Bewerken</th>
                            <th>Voorraad</th>
                        </tr>
                        <?php // create's <tr> elements with the products data
                            foreach ($_SESSION['products'] as $product) {
                                echo '<tr>';
                                    echo '<td>'.$product['p_name'].'</td>';
                                    echo '<td>'.$product['type'].'</td>';
                                    echo '<td>'.$product['m_name'].'</td>';
                                    echo '<td>'.$product['purchase_price'].'</td>';
                                    echo '<td>'.$product['sell_price'].'</td>';
                                    echo '<td><a class="text-link" href="">Bewerken</a></td>';
                                    echo '<td>';
                                        echo '<a href=""><i class="material-icons icon-link">mode_edit</i></a>';
                                        echo '<a href=""><i class="material-icons icon-link">delete</i></a>';
                                        echo '<a href=""><i class="material-icons icon-link">add</i></a>';
                                    echo '</td>';
                                echo '</tr>';
                            }
                        ?>
                    </table>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>