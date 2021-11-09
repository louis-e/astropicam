<?php
echo('<!DOCTYPE html>
<html>
<head>
    <title>Astro Pi Cam - Live</title>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google" content="notranslate" />
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="topnav">
    <a href="index.html">Live</a>
    <a href="archive.php">Archive</a>
    <a class="active" href="tools.php">Tools</a>
    <a class="shutdown" href="shutdown.html">Shutdown</a>
    <a id="topbarVersion" style="float:right;">AstroPiCam V1.0</a>
</div>

<div style="padding-left:16px">
    <h2>System</h2>
    <p>' . shell_exec("sudo /usr/bin/python3 /home/pi/INA219.py") . '<br>Temperature: ' . str_replace("temp=", "", shell_exec("sudo /opt/vc/bin/vcgencmd measure_temp")) . '</p>
    <h2>Specifications</h2>
    <p>Omegon N 130/920 EQ-2</p>
    <table>
        <tr>
            <td>Type of build</td>
            <td>Newton</td>
        </tr>
        <tr>
            <td>Tube aperture diameter</td>
            <td>130mm</td>
        </tr>
        <tr>
            <td>Focal length</td>
            <td>920mm</td>
        </tr>
        <tr>
            <td>Aperture ratio (f/)</td>
            <td>7,1</td>
        </tr>
        <tr>
            <td>Resolving capacity</td>
            <td>0,88</td>
        </tr>
        <tr>
            <td>Limit value</td>
            <td>12,4 mag</td>
        </tr>
        <tr>
            <td>Light gathering capacity (compared to the eye)</td>
            <td>350</td>
        </tr>
        <tr>
            <td>Max. useful magnification</td>
            <td>260</td>
        </tr>
        <tr>
            <td>Eyepice aperture diameter</td>
            <td>1,25"</td>
        </tr>
    </table><br>
    <i>AstroPiCam Software V1.0</i> <a href="https://github.com/louis-e/astropicam">https://github.com/louis-e/astropicam</a><br><br>


    <h2>Tools</h2>
    <p>Magnification Calculator</p>
    <input type="number" id="magcalc-fl" name="magcalc" value="920">
    <label>mm / (K</label>
    <input type="number" id="magcalc-em" name="magcalc" value="25">
    <label>mm / </label>
    <input type="number" id="magcalc-bm" name="magcalc" value="2">
    <label>x) = </label>
    <input type="number" id="magcalc-res" name="magcalc" readonly="true">
    <label>x magnification</label><br>
    <i style="font-size:75%;">Focal length / (Eyepiece magnification / Barlow magnification) = Total magnification</i><br><br><br>


    <button class="button button3" id="stopMicroserverButton" onclick="stopMicroserver()">Stop microserver backend</button><br>
    <button class="button button3" id="restartStreamButton" onclick="restartStream()">Restart stream backend</button><br>
    <button class="button button2" id="deleteButton" onclick="deleteAllFiles()">Reset system</button>
    <br><i id="infotext" style="font-size:80%;"></i><br>
</div>

<script>
    document.getElementById("magcalc-fl").addEventListener ("change", function () {
        calculateMagnification();
    });
    document.getElementById("magcalc-em").addEventListener ("change", function () {
        calculateMagnification();
    });
    document.getElementById("magcalc-bm").addEventListener ("change", function () {
        calculateMagnification();
    });

    function deleteAllFiles() {
        document.getElementById("infotext").innerHTML = "Are you sure that you want to reset the <b>entire system</b>? Click <b><a onclick=\"confirmedDeletion()\">here</a></b> to confirm.";
        setTimeout(function() {
            document.getElementById("infotext").innerText = "";
        }, 7500);
    }
    function confirmedDeletion() {
        xmlReq = new XMLHttpRequest();
        xmlReq.open("POST","deleteAllFiles.php",true);
        xmlReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlReq.send();

        document.getElementById("infotext").innerHTML = "System reset successful.";
        setTimeout(function() {
            document.getElementById("infotext").innerText = "";
        }, 7500);
    }

    function restartStream() {
        xmlReq = new XMLHttpRequest();
        xmlReq.open("POST","restartStream.php",true);
        xmlReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlReq.send();

        document.getElementById("infotext").innerHTML = "Restarting stream backend...";
        setTimeout(function() {
            document.getElementById("infotext").innerText = "";
        }, 7500);
    }

    function stopMicroserver() {
        xmlReq = new XMLHttpRequest();
        xmlReq.open("POST","restartStream.php?action=stop",true);
        xmlReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlReq.send();

        document.getElementById("infotext").innerHTML = "Stopping microserver backend...";
        setTimeout(function() {
            document.getElementById("infotext").innerText = "";
        }, 7500);
    }

    function calculateMagnification() {
        document.getElementById("magcalc-res").value = Math.round(document.getElementById("magcalc-fl").value / (document.getElementById("magcalc-em").value / document.getElementById("magcalc-bm").value));
        if (document.getElementById("magcalc-res").value > 260) {
            document.getElementById("magcalc-res").style = "background-color: #ff0000;";
        } else {
            document.getElementById("magcalc-res").style = "background-color: #ffffff;";
        }
    }
</script>

</body>
</html>');
?>