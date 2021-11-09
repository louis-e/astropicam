<?php
if (isset($_GET['action']) && !empty($_GET['action'])) {
    if ($_GET['action'] == "shutdown") {
        shell_exec("sudo /usr/sbin/shutdown now");
    } else if ($_GET['action'] == "reboot") {
        shell_exec("sudo /usr/sbin/reboot");
    }
}
?>
