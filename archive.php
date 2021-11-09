<?php

echo('
<!DOCTYPE html>
<html>
<head>
    <title>Astro Pi Cam - Archive</title>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google" content="notranslate" />
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="topnav">
    <a href="index.html">Live</a>
    <a class="active" href="archive.php">Archive</a>
    <a href="tools.php">Tools</a>
    <a class="shutdown" href="shutdown.html">Shutdown</a>
    <a id="topbarVersion" style="float:right;">AstroPiCam V1.0</a>
</div>

<div style="padding-left:16px">
    <h2>Footage Archive</h2>');

foreach (new DirectoryIterator('assets') as $fileInfo) {
    if ($fileInfo->isDot()) continue;
    if (substr($fileInfo->getFilename(), strrpos($fileInfo->getFilename(), '.') + 1) == "mp4") {
        echo('<div class="card">
        <video width="100%" controls>
          <source src="assets/' . $fileInfo->getFilename() . '" type="video/mp4">
        </video>
        <div class="container">
            <h4><b>' . $fileInfo->getFilename() . '</b></h4>
            <button class="button button1"><a href="assets/' . $fileInfo->getFilename() . '" style="color:white;" download>Download asset</a></button>
            <button class="button button2" onclick="deleteFile(\'' . $fileInfo->getFilename() . '\')">Delete item</button>
        </div>
    </div><br>');
    } else {
        echo('<div class="card">
        <img src="assets/' . $fileInfo->getFilename() . '" alt="Avatar" style="width:100%">
        <div class="container">
            <h4><b>' . $fileInfo->getFilename() . '</b></h4>
            <button class="button button1"><a href="assets/' . $fileInfo->getFilename() . '" style="color:white;" download>Download asset</a></button>
            <button class="button button2" onclick="deleteFile(\'' . $fileInfo->getFilename() . '\')">Delete item</button>
        </div>
    </div><br>');
    }
}

print('<script>
function deleteFile(fileName) {
    xmlReq = new XMLHttpRequest();
    xmlReq.open("POST","deleteFile.php?file=" + fileName,true);
    xmlReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlReq.send();
    
    setTimeout(function() {
        location.reload();        
    }, 200);
}
</script>
</div></body></html>');

?>