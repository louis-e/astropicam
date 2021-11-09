<?php
echo(strval(iterator_count(new FilesystemIterator("/var/www/html/assets", FilesystemIterator::SKIP_DOTS)) + 1) . ".jpg");

function base64_to_jpeg($base64_string, $output_file) {
    $ifp = fopen($output_file, 'wb');

    $data = explode(',', $base64_string);

    fwrite($ifp, base64_decode($data[1]));
    fclose($ifp);
    return $output_file;
}

$camurl="http://192.168.178.2:8001/stream.mjpg";
$boundary="--FRAME";
$f = fopen($camurl, "r");
$r = "";

if($f) {
    //$start_time = microtime(true);
    while (substr_count($r,"Content-Length") < 2)
        $r.=fread($f, 16384);

    $start = strpos("$r", $boundary);
    $end = strpos("$r", $boundary, $start + strlen($boundary));
    $boundaryAndFrame = substr("$r", $start, $end - $start);

    $pattern="/(Content-Length:\s*\d*\r\n\r\n)([\s\S]*)/";
    preg_match_all($pattern, $boundaryAndFrame, $matches);
    $frame = $matches[2][0];
    base64_to_jpeg("data:image/jpeg;base64," . base64_encode($frame), "/var/www/html/assets/" . strval(iterator_count(new FilesystemIterator("/var/www/html/assets", FilesystemIterator::SKIP_DOTS)) + 1) . ".jpeg");
    //print(microtime(true) - $start_time);
} else {
    echo "Error";
}

fclose($f);
?>