<?php
    session_start();
    $_SESSION['url'] = __DIR__;
    $_SESSION['access'] = 'office';
    require_once "../includes/user_validation.php";
    require_once "../actions/onload/product_edit.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../resources/styles/main.css">
    <title>Product bewerken</title>
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
                        echo '<a class="nav-link" href="./reports.php">Rapportages</a>';
                        echo '<a class="nav-link nav-link-selected" href="./products.php">Producten</a>';
                    }

                    if ((int) $_SESSION['user']['role_id'] === 3) {
                        echo '<a class="nav-link" href="">Locaties</a>';
                        echo '<a class="nav-link" href="">Werknemers</a>';
                    }
                ?>
            </div>
        </nav>
        <div class="flex-box justify-content-center">
            <div>
                <div class="flex-box justify-content-space-between align-items-center">
                    <h1>Product bewerken</h1>
                    <?php if ((int) $_SESSION['user']['role_id'] === 3) { ?>
                        <a class="flex-box" href="../actions/product_del.php">
                            <i class="material-icons del-icon">delete</i>
                        </a>
                    <?php } ?>
                </div>
                <div class="element element-s-l p-15">
                    <?php
                        if (isset($_SESSION['error'])) {
                            echo "<p class='error mb-15'>".$_SESSION['error']."</p>";
                        }
                    ?>

                    <form class="flex-box gap-40 flex-wrap" action="../actions/product_edit.php" method="post">
                        <div class="form-section flex-box flex-direction-column gap-30">
                            <div class="flex-box flex-direction-column gap-5">
                                <label for="product_name">Product naam</label>
                                <select id="product_name" name="product_name" autofocus required <?php require('../includes/input_disabled_check.php'); ?>>
                                    <option value="">product naam</option>
                                    <?php // loads all the options for product name
                                        foreach ($_SESSION['product_names'] as $product_name) {
                                            if ($product_name['id'] === $_SESSION['product']['product_name_id']) {
                                                echo '<option value="'.$product_name['id'].'" selected>'.$product_name['name'].'</option>';
                                            } else {
                                                echo '<option value="'.$product_name['id'].'">'.$product_name['name'].'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="flex-box flex-direction-column gap-5">
                                <label for="type">Type</label>
                                <input type="text" id="type" name="type" value="<?php echo $_SESSION['product']['type']; ?>" placeholder="type" required <?php require('../includes/input_disabled_check.php'); ?>>
                            </div>
                            <div class="flex-box flex-direction-column gap-5">
                                <label for="sell_price">Verkoopprijs</label>
                                <input type="number" id="sell_price" name="sell_price" value="<?php echo $_SESSION['product']['sell_price']; ?>" min="0.00" max="99999.99" step="0.01" placeholder="€ 0,00" required <?php require('../includes/input_disabled_check.php'); ?>>
                            </div>
                        </div>

                        <div class="form-section flex-box flex-direction-column gap-30">
                            <div class="flex-box flex-direction-column gap-5">
                                <label for="manufacturer">Fabriekant</label>
                                <select id="manufacturer" name="manufacturer" required <?php require('../includes/input_disabled_check.php'); ?>>
                                    <option value="">fabriekant</option>
                                    <?php // loads all the options for manufacturer name
                                        foreach ($_SESSION['manufacturer_names'] as $manufacturer_name) {
                                            if ($manufacturer_name['id'] === $_SESSION['product']['manufacturer_id']) {
                                                echo '<option value="'.$manufacturer_name['id'].'" selected>'.$manufacturer_name['name'].'</option>';
                                            } else {
                                                echo '<option value="'.$manufacturer_name['id'].'">'.$manufacturer_name['name'].'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="flex-box flex-direction-column gap-5">
                                <label for="purchase_price">Inkoopprijs</label>
                                <input type="number" id="purchase_price" name="purchase_price" value="<?php echo $_SESSION['product']['purchase_price']; ?>" min="0.00" max="99999.99" step="0.01" placeholder="€ 0,00" required <?php require('../includes/input_disabled_check.php'); ?>>
                            </div>
                        </div>

                        <div class="form-section flex-box flex-direction-column gap-30">
                            <div class="flex-box flex-direction-column gap-5">
                                <label for="in_stock">In voorraad</label>
                                <input type="number" id="in_stock" name="in_stock" value="<?php echo $_SESSION['product_stock']['in_stock']; ?>" min="0" max="99999" step="1" placeholder="in voorraad" required>
                            </div>
                        </div>

                        <div class="form-section flex-box flex-direction-column gap-30">
                            <div class="flex-box flex-direction-column gap-5">
                                <label for="min_stock">Minimum voorraad</label>
                                <input type="number" id="min_stock" name="min_stock" value="<?php echo $_SESSION['product_stock']['min_stock']; ?>" min="0" max="99999" step="1" placeholder="minimum voorraad" required>
                            </div>
                        </div>

                        <div class="form-section flex-box flex-direction-column gap-30">
                            <div>
                                <input class="main-bt mt-25" type="submit" value="Toepassen">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php unset($_SESSION['error']); ?>