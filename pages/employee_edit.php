<?php
    session_start();
    $_SESSION['url'] = __DIR__;
    $_SESSION['access'] = 'admin';
    require_once "../includes/user_validation.php";
    require_once "../actions/onload/employee_edit.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../resources/styles/main.css">
    <title>Werknemer bewerken</title>
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
                        echo '<a class="nav-link" href="./products.php">Producten</a>';
                    }

                    if ((int) $_SESSION['user']['role_id'] === 3) {
                        echo '<a class="nav-link" href="">Locaties</a>';
                        echo '<a class="nav-link nav-link-selected" href="./staff.php">Werknemers</a>';
                    }
                ?>
            </div>
        </nav>
        <div class="flex-box justify-content-center">
            <div>
                <div>
                    <h1>Werknemer bewerken</h1>
                </div>
                <div class="element element-s-l p-15">
                    <?php
                        if (isset($_SESSION['error'])) {
                            echo "<p class='error mb-15'>".$_SESSION['error']."</p>";
                        }
                    ?>

                    <form class="flex-box gap-40" action="../actions/employee_edit.php" method="post">
                        <div class="form-section flex-box flex-direction-column gap-30">
                            <div class="flex-box flex-direction-column gap-5">
                                <label for="first_name">Voornaam</label>
                                <input type="text" id="first_name" name="first_name" value="<?php echo $_SESSION['employee']['first_name']; ?>" placeholder="voornaam" autofocus required>
                            </div>
                            <div class="flex-box flex-direction-column gap-5">
                                <label for="location">Werk locatie</label>
                                <select id="location" name="location" required>
                                    <option value="">locatie</option>
                                    <?php // loads all the options for location
                                        foreach ($_SESSION['locations'] as $location) {
                                            if ($location['id'] === $_SESSION['employee']['location_id']) {
                                                echo '<option value="'.$location['id'].'" selected>'.$location['place_name'].'</option>';
                                            } else {
                                                echo '<option value="'.$location['id'].'">'.$location['place_name'].'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <input class="main-bt mt-25" type="submit" value="Bewerken">
                            </div>
                        </div>

                        <div class="form-section flex-box flex-direction-column gap-30">
                            <div class="flex-box flex-direction-column gap-5">
                                <label for="last_name">Achternaam</label>
                                <input type="text" id="last_name" name="last_name" value="<?php echo $_SESSION['employee']['last_name']; ?>" placeholder="achternaam" required>
                            </div>
                            <div class="flex-box flex-direction-column gap-5">
                                <label for="role">Rol</label>
                                <select id="role" name="role" required>
                                    <option value="">rol</option>
                                    <?php // loads all the options for role
                                        foreach ($_SESSION['roles'] as $role) {
                                            if ($role['id'] === $_SESSION['employee']['role_id']) {
                                                echo '<option value="'.$role['id'].'" selected>'.$role['role'].'</option>';
                                            } else {
                                                echo '<option value="'.$role['id'].'">'.$role['role'].'</option>';
                                            }
                                        }
                                    ?>
                                </select>
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