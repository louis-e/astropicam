<?php
if (isset($_GET['action']) && !empty($_GET['action'])) {
    if ($_GET['action'] == "start") {
        shell_exec("sudo pkill python");
        shell_exec("sudo /usr/bin/raspivid -o /var/www/html/assets/video.h264 -t 99999999");
    } else if ($_GET['action'] == "stop") {
        shell_exec("sudo /usr/bin/killall -9 raspivid");
        shell_exec("sudo /usr/bin/ffmpeg -i /var/www/html/assets/video.h264 -vcodec copy /var/www/html/assets/" . strval(iterator_count(new FilesystemIterator("/var/www/html/assets", FilesystemIterator::SKIP_DOTS)) + 1) . ".mp4");
        unlink("/var/www/html/assets/video.h264");
    }
}
?>