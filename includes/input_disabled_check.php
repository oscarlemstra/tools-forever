<?php
if ($_SESSION['user']['role_id'] < 3) {
    echo "disabled";
}
?>