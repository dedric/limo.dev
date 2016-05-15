<?php
if (preg_match("/footer.php/", $_SERVER['SCRIPT_NAME'])) {
    Header("Location: index.php"); die();
}

echo "";