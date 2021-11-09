<?php
if (isset($_GET['file']) && !empty($_GET['file'])) {
    unlink("/var/www/html/assets/" . str_replace('/', '', $_GET['file']));
}
?>
