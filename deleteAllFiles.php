<?php
foreach (new DirectoryIterator('assets') as $fileInfo) {
    if ($fileInfo->isDot()) continue;
    unlink("/var/www/html/assets/" . $fileInfo->getFilename());
}
?>