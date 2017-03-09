FreeWifi PHP Portal, useful for coffee or restaurants hotspot without external services (like Hotspotsystem or Wiiman).
Works with Ubiquiti Unifi controller v4+

![alt tag](https://github.com/emanuelepaiano/espresso-freewifi-portal/blob/master/screenshots/en.png)

WARNING:This captive portal actually works, but it's under development. There isn't a database backend yet.

I'm coding a jquery-mobile backend for administrate database.

FEATURES:
- Mac address authentication for free limited-time wifi access;
- Registered users authentication (support limited time login from single mac address only);
- Remaining time counter for users (you can show them fake values, hiding minutes from 
  remaining time);
- Blocking expired session's mac-address for minutes (or hours / days);
- Multilanguage and language browser probing (italian/english);
- Single customizable frontend theme.

REQUIREMENTS:

- Ubiquiti Unifi Controller (tested on 4.8.20 version)
- Linux Debian or Windows Lamp (tested on Debian and Raspbian 8)
- Nginx or Apache2 webserver
- Sqlite3 or Mysql 5.5 server
- PHP 5.5 with mysql and/or sqlite3 PDO support 

INSTALL:



AUTHOR
Emanuele Paiano - nixw0rm [at] gmail [dot] com

LICENSE
This tool is released under MIT License

CREDITS
This Captive Portal is based on
- Medoo (http://medoo.in/)
- class.unifi.it (https://github.com/malle-pietje/UniFi-API-browser/blob/master/phpapi/class.unifi.php)
