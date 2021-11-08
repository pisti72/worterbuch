# Digitaltimer

https://digitaltimer.000webhostapp.com/
https://www.000webhost.com/members/website/digitaltimer/files
Kf2

# Localtest

http://localhost/escapetools/digitaltimer/control.php?id=ALIZ4TSH9CK31LDF56



## FTP

files.000webhost.com
21
Kf2

## Concept

http://moneysaw.eu/timer/timer.php?id=1234512345

your timer is:
https://xtimer.eu/timer.php?id={timer_token}

open current timer dashboard:
http://xtimer.eu/dashboard.php?id={timer_token}

Operations:
* Start 1 hour
* Add 5 minutes
* others will come ...

## Kiosk setup on OrangePi Armbian

On OrangePi:
cd .config/lxsession/LXDE

On RaspberryPi:
cd .config/lxsession/LXDE-pi

sudo apt-get install xdotool unclutter sed

nano autostart

@lxpanel --profile LXDE
@pcmanfm --desktop --profile LXDE
@xscreensaver -no-splash
@point-rpi
@xset s off
@xset s noblank
@xset -dpms
#Hide mouse cursor
@unclutter -idle 0 
@chromium-browser --noerrdialogs --disable-infobars --incognito --kiosk https://xtimer.eu/timer.php?id={timer_token}




chromium --noerrdialogs --disable-infobars --incognito --kiosk https://xtimer.eu/timer.php?id={timer_token}

## Kiosk setup on RaspbiOS
https://pi-store.com/pages/raspbian-jessie-kiosk-mode

sudo apt install xdotool unclutter sed firefox-esr

Firefox Add-Ons Auto Fullscreen

Enable private browsing full screen in configs

nano /home/pi/.config/lxsession/LXDE-pi/autostart
@lxpanel --profile LXDE-pi
@pcmanfm --desktop --profile LXDE-pi
@xscreensaver -no-splash
@point-rpi
@xset s off
@xset s noblank
@xset -dpms
#Hide mouse cursor
#@unclutter -idle 0 
#@chromium-browser --noerrdialogs --disable-infobars --incognito --kiosk https://xtimer.eu/timer.php?id={timer_token}
@firefox-esr -kiosk -private-window https://xtimer.eu/timer.php?id={timer_token}

## API

?getcommand={timer_token}
return
TBD

## Tasks

- Beautfy the control panel
- Rewrite to https://codeigniter.com/ framework
- Landing page with 
    - header
    - footer
        - 

## Devlog

2020-07-30 CodeIgniter tutorial
2020-07-31

