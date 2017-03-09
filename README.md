#ESPRESSO PHP PORTAL
FreeWifi PHP Captive Portal, useful for builds coffee or restaurants free hotspots without pay external cloud services.
Works with Ubiquiti Unifi controller v4+

![alt tag](https://github.com/emanuelepaiano/espresso-freewifi-portal/blob/master/screenshots/en.png)

WARNING:This captive portal actually works, but it's under development. There isn't a database backend yet.

I'm coding a jquery-mobile backend for administrate database.

###FEATURES:
- Mac address authentication for free limited-time wifi access;
- Registered users authentication (support limited time login from single mac address only);
- Remaining time counter for users (you can show them fake values, hiding minutes from 
  remaining time);
- Blocking expired session's mac-address for minutes (or hours / days);
- Multilanguage and language browser detection (italian/english);
- Single customizable frontend theme.

***

##REQUIREMENTS:
- Ubiquiti Unifi Controller (tested on 4.8.20 version)
- Linux Debian or Windows Lamp (tested on Debian and Raspbian 8)
- Nginx or Apache2 webserver with php enabled
- Sqlite3 or Mysql 5.5 server
- PHP 5.5 with mysql and/or sqlite3 PDO support 
- PhpMyAdmin or external database client for backend [OPTIONAL]

***

###INSTALL: 
read INSTALL.txt file
***

###AUTHOR:
Emanuele Paiano - nixw0rm [at] gmail [dot] com
***

###LICENSE:
This tool is released under MIT License
***

###CREDITS:
This Captive Portal is based on
- Medoo (http://medoo.in/)
- class.unifi.it (https://github.com/malle-pietje/UniFi-API-browser/blob/master/phpapi/class.unifi.php)
***

###SUPPORT ME:
If you like this project, consider a little donation! I need buy hardware for testing and development :)

[![paypal](https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif)](https://www.paypal.me/emanuelepaiano)
***
