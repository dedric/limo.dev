<?php
if (eregi("footer.php", $_SERVER['SCRIPT_NAME'])) {
    Header("Location: index.php"); die();
}

echo "";
?>
