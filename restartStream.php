<?php
if (isset($_GET['action']) && !empty($_GET['action'])) {
    if ($_GET['action'] == 'start') {
        shell_exec("sudo /usr/bin/python3 /home/pi/streamcam.py 2592x1944 15");
    } else if ($_GET['action'] == 'stop') {
        shell_exec("sudo pkill python");
    }
} else {
    shell_exec("sudo pkill python");
    shell_exec("sudo /usr/bin/python3 /home/pi/streamcam.py 2592x1944 15");
}
?>