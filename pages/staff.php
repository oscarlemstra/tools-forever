<?php
    session_start();
    $_SESSION['url'] = __DIR__;
    $_SESSION['access'] = 'admin';
    require_once "../includes/user_validation.php";
    require_once "../actions/staff.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../resources/styles/main.css">
    <title>Werknemers</title>
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
                        echo '<a class="nav-link" href="./products">Producten</a>';
                    }

                    if ((int) $_SESSION['user']['role_id'] === 3) {
                        echo '<a class="nav-link" href="">Locaties</a>';
                        echo '<a class="nav-link nav-link-selected" href="">Werknemers</a>';
                    }
                ?>
            </div>
        </nav>
        <div class="flex-box align-items-flex-start gap-20">
            <form class="element element-s-s p-10 mt-45" action="" method="post">
                <?php // a select element for location
                    echo '<select class="mb-10" id="location" name="location">';

                    foreach ($_SESSION['locations'] as $location) {
                        if (empty($_POST)) {
                            if ($location['id'] === $_SESSION['user']['location_id']) {
                                echo '<option value="'.$location['id'].'" selected>'.$location['place_name'].'</option>';
                            } else {
                                echo '<option value="'.$location['id'].'">'.$location['place_name'].'</option>';
                            }
                        } else {
                            if ($location['id'] === $_POST['location']) {
                                echo '<option value="'.$location['id'].'" selected>'.$location['place_name'].'</option>';
                            } else {
                                echo '<option value="'.$location['id'].'">'.$location['place_name'].'</option>';
                            }
                        }
                    }
                    echo '</select>';
                ?>
        
                <input class="main-bt mt-25" type="submit" value="Toepassen">
            </form>
            <div>
                <div class="flex-box justify-content-space-between align-items-center">
                    <h1>Werknemers overzicht - <?php echo $_SESSION['selected_location']; ?></h1>
                    <a class="flex-box" href="./employee_add.php">
                        <i class="material-icons plus-icon">add</i>
                    </a>
                </div>
                <div class="element element-s-l p-15">
                    <?php
                        if (isset($_SESSION['success'])) {
                            echo "<p class='success mb-15'>".$_SESSION['success']."</p>";
                        }

                        if (isset($_SESSION['error'])) {
                            echo "<p class='error'>".$_SESSION['error']."</p>";
                        }

                        if (empty($_SESSION['staff']) && empty($_SESSION['error'])) {
                            echo "<p>Er zijn geen resultaten gevonden.</p>";
                        }

                        if (!empty($_SESSION['staff']) && empty($_SESSION['error'])) {
                    ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Voornaam</th>
                                <th>Achternaam</th>
                                <th>Werk rol</th>
                                <th>Bewerken</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php // create's <tr> elements with the staff data
                                foreach ($_SESSION['staff'] as $employee) {
                                    echo '<tr>';
                                        echo '<td>'.$employee['first_name'].'</td>';
                                        echo '<td>'.$employee['last_name'].'</td>';
                                        echo '<td>'.$employee['role'].'</td>';
                                        echo '<td><a class="text-link" href="./employee_edit.php?employee='.$employee['id'].'">Bewerken</a></td>';
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

<?php
unset($_SESSION['success']);
unset($_SESSION['error']);
?>