<?php
    if (isset($_POST['report'])) {
        $report = $_POST['report'];
    } else {
        $report = "";
    }

    session_start();
    $_SESSION['url'] = __DIR__;
    $_SESSION['access'] = 'office';
    require_once "../includes/user_validation.php";
    require_once "../actions/reports.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../resources/styles/main.css">
    <title>Rapportages</title>
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
                        echo '<a class="nav-link nav-link-selected" href="">Rapportages</a>';
                        echo '<a class="nav-link" href="./products.php">Producten</a>';
                    }

                    if ((int) $_SESSION['user']['role_id'] === 3) {
                        echo '<a class="nav-link" href="">Locaties</a>';
                        echo '<a class="nav-link" href="./staff.php">Werknemers</a>';
                    }
                ?>
            </div>
        </nav>
        <div class="flex-box align-items-flex-start gap-20">
            <form class="element element-s-s p-10 mt-45" action="" method="post">
                <select class="mb-10" id="report" name="report" required>
                    <option value="">Rapportage</option>
                    <option value="total_stock">Totale voorraad</option>
                    <option value="stock_value">Voorraad waarde</option>
                    <option value="order_list">Bestellijst</option>
                </select>
                
                <input class="main-bt mt-25" type="submit" value="Weergeven">
            </form>
            <div>
                <div>
                    <?php // loads the right title for the report
                        switch ($report) {
                            case "total_stock":
                                echo "<h1>Rapportage - Totale voorraad</h1>";
                                break;
                            case "stock_value":
                                echo "<h1>Rapportage - Voorraad waarde</h1>";
                                break;
                            case "order_list":
                                echo "<h1>Rapportage - Bestellijst</h1>";
                                break;
                            default:
                                echo "<h1>Rapportages</h1>";
                        }
                    ?>
                </div>
                <div class="element element-s-l p-15">
                    <?php
                        if (isset($_SESSION['error'])) {
                            echo "<p class='error'>".$_SESSION['error']."</p>";
                        }

                        if (empty($_SESSION['report']) && empty($_SESSION['error'])) {
                            echo "<p>Er zijn geen resultaten gevonden.</p>";
                        }

                        if (!empty($_SESSION['report']) && empty($_SESSION['error'])) {
                            switch ($report) {
                                case "total_stock":
                                    include '../includes/report_tables/total_stock.php';
                                    break;
                                case "stock_value":
                                    include '../includes/report_tables/stock_value.php';
                                    break;
                                case "order_list":
                                    include '../includes/report_tables/order_list.php';
                                    break;
                                default:
                                    echo "<p>Selecteer een rapportage.</p>";
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php unset($_SESSION['error']); ?>