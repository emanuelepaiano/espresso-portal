FreeWifi PHP Portal for coffee or restaurants hotspot
Works on Ubiquiti Unifi controller

WARNING: THIS RELEASE WORK, BUT IT'S A WORK IN PROGRESS (CLIENTS FRONTEND ONLY). 

I'm coding a jquery-mobile backend for administrate database.

FEATURES:
- Mac address authentication for free limited-time free wifi access
- Registered users authentication (with limited time support and single mac-address logins)
- Remaining time counter for users (and you can show them fake values, hiding minutes from 
  remaining time)
- Block expired session's mac-address for minutes (or hours / days).

REQUIREMENTS:

- Ubiquiti Unifi Controller (tested on 4.8.20 version)
- Linux Debian or Windows Lamp (tested on Debian and Raspbian 8)
- Nginx or Apache2 webserver
- Sqlite3 or Mysql 5.5 server
- PHP 5.5 with mysql and/or sqlite3 PDO support 

AUTHOR
Emanuele Paiano - nixw0rm@gmail.com

LICENSE
This is tool is released under MIT License

CREDITS
This Captive Portal is used with
- Medoo (http://medoo.in/)
- class.unifi.it (https://github.com/malle-pietje/UniFi-API-browser/blob/master/phpapi/class.unifi.php)
