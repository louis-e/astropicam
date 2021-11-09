# Astropicam
Raspberry Pi Telescope Camera with web interface

![](https://github.com/louis-e/astropicam/blob/main/readme-assets/icon.png)

![](https://img.shields.io/github/stars/louis-e/astropicam?style=flat-square&label=Stars) ![](https://img.shields.io/github/forks/louis-e/astropicam?style=flat-square&label=Forks) ![](https://img.shields.io/github/followers/louis-e?style=flat-square&label=Followers)

## Features

- Live camera feed
- Capture images
- Capture video footage
- Store, download and delete astrophotography
- System status overview (Temperature, Battery level,...)
- Full Raspberry Pi control over the web interface (Shutdown, Reboot)

<img src="https://github.com/louis-e/astropicam/blob/main/readme-assets/github-astropicam-demo1.png" data-canonical-src="https://github.com/louis-e/astropicam/blob/main/readme-assets/github-astropicam-demo1.png" width="35%" height="35%" /><img src="https://github.com/louis-e/astropicam/blob/main/readme-assets/github-astropicam-demo2.png" data-canonical-src="https://github.com/louis-e/astropicam/blob/main/readme-assets/github-astropicam-demo2.png" width="35%" height="35%" /><img src="https://github.com/louis-e/astropicam/blob/main/readme-assets/github-astropicam-demo3.png" data-canonical-src="https://github.com/louis-e/astropicam/blob/main/readme-assets/github-astropicam-demo3.png" width="35%" height="35%" /><img src="https://github.com/louis-e/astropicam/blob/main/readme-assets/github-astropicam-demo4.png" data-canonical-src="https://github.com/louis-e/astropicam/blob/main/readme-assets/github-astropicam-demo4.png" width="35%" height="35%" />


## Requirements
##### Hardware
- Raspberry Pi (Wifi capable)
- Raspberry Pi Camera Module
- 3D printed telescope Pi camera mount (eg. https://www.thingiverse.com/thing:1812708) (or a different telescope camera mount)

##### Software
- Python3
- Webserver (eg. Apache)
- PHP
- ffmpeg

Enable the I2C interface (in case that your Pi is battery powered) and the camera module in the interfacing options of `raspi-config`.

## Important notice
Make sure that the webserver path (eg. `/var/www/html`) is correct for your system in the HTML/PHP files. The same goes for the path to the Python scripts, which were in my case in the `/home/pi` directory.
Also ensure that the webserver has the rights to read / write / execute the needed files and to replace the ip address `192.168.178.2` in index.html and captureImage.html with your local Raspberry Pi ip address or hostname.

You might also want to start the `streamcam.py` automatically after boot by using `crontab @reboot` and adapt your telescope specifications in the 'Tools' page, but that is not necessary.


#### This system might contain still unknown security issues - use it at your own risk!

## License
GNU GENERAL PUBLIC LICENSE
Version 3, 29 June 2007

 Everyone is permitted to copy and distribute verbatim copies
 of this license document, but changing it is not allowed.
 
[Read the full license here](https://github.com/louis-e/astropicam/blob/main/LICENSE)
