<?php
    session_start();
    $_SESSION['url'] = __DIR__;
    $_SESSION['access'] = 'office';
    require_once "../includes/user_validation.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../resources/styles/main.css">
    <title>Product toevoegen</title>
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
                <div>
                    <h1>Product toevoegen</h1>
                </div>
                <div class="element element-s-l p-15">
                    <?php
                        if (isset($_SESSION['error'])) {
                            echo "<p class='error'>".$_SESSION['error']."</p>";
                        }
                    ?>

                    <form class="flex-box gap-40" action="../actions/product_edit.php" method="post">
                        <div class="form-section flex-box flex-direction-column gap-30">
                            <div class="flex-box flex-direction-column gap-5">
                                <label for="product_name">Product naam</label>
                                <select id="product_name" name="product_name" autofocus required>
                                    <option value="">product naam</option>
                                    <option value="www">edmiefmi</option>
                                    <option value="www">plscoc</option>
                                    <option value="www">quiehd</option>
                                </select>
                            </div>
                            <div class="flex-box flex-direction-column gap-5">
                                <label for="type">Type</label>
                                <input type="text" id="type" name="type" placeholder="type" required>
                            </div>
                            <div class="flex-box flex-direction-column gap-5">
                                <label for="sell_price">Verkoopprijs</label>
                                <input type="number" id="sell_price" name="sell_price" min="0.00" max="99.99" step="0.01" placeholder="€ 0,00" required>
                            </div>
                            <div>
                                <input class="main-bt mt-25" type="submit" value="Toevoegen">
                            </div>
                        </div>

                        <div class="form-section flex-box flex-direction-column gap-30">
                            <div class="flex-box flex-direction-column gap-5">
                                <label for="manufacturer">Fabriekant</label>
                                <select id="manufacturer" name="manufacturer" required>
                                    <option value="">fabriekant</option>
                                    <option value="www">edmiefmi</option>
                                    <option value="www">plscoc</option>
                                    <option value="www">quiehd</option>
                                </select>
                            </div>
                            <div class="flex-box flex-direction-column gap-5">
                                <label for="purchase_price">Inkoopprijs</label>
                                <input type="number" id="purchase_price" name="purchase_price" min="0.00" max="99.99" step="0.01" placeholder="€ 0,00" required>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>