# ESPRESSO PHP PORTAL v0.9
FreeWifi PHP Captive Portal, useful for builds coffee or restaurants free hotspots without pay external cloud services.
Works with Ubiquiti Unifi controller v4+

![alt tag](https://github.com/emanuelepaiano/espresso-freewifi-portal/blob/master/screenshots/en.png)

NOTE: This captive portal actually works, but it's under development. There is only frontend and
I'm coding a jquery-mobile backend for administrate database.

#### WARNING: Some countries' laws, require a logging data for guests activities from wifi hotspots. This tool does not collect any data or logs, so use it at your risk. If required in your country, install a logging system by yourself. I'm not responsible for law violations!

### FEATURES
- Mac address/email authentication for free limited-time wifi access;
- Registered users authentication (support limited time login from single mac address);
- Remaining time counter for users (you can show them fake values, hiding minutes from 
  remaining time);
- Blocking expired session's mac-address for minutes (or hours / days);
- Multilanguage and language browser detection (italian/english);
- Single customizable frontend theme.
- Mail login supports for guests, with logging useful for signing up to newsletters - NEW
- Disabling registered users login (set hotspot for guests only) - NEW
- Permanent login support - NEW

***

## REQUIREMENTS
- Ubiquiti Unifi Controller (tested on 4.8.20 version)
- Linux Debian or Windows Lamp (tested on Debian and Raspbian 8)
- Nginx or Apache2 webserver with php enabled
- Sqlite3 or Mysql 5.5 server
- PHP 5.5 with mysql and/or sqlite3 PDO support 
- PhpMyAdmin or external database client for backend [OPTIONAL]

***

### INSTALL 

1) Prepare your system installing the unifi controller, a web server (Nginx/Apache) with PHP/PDO CURL and a DBMS (Mysql or Sqlite3);

2) Put guest/ directory into webserver root (like /var/www/html) and change permissions to access www-data webserver user;

3) To increase security, move guest/s/default/db/hotspot.sqlite and hotspot.sql files to another path (like /var) inaccessible from web, but accessible from php;

4) Edit guest/s/default/config.inc.php Unifi Controller options, database settings and $GLOBALS['sessionLogging'] with random string.

6) If you use mysql, import hotspot.sql file into database (you can use PhpMyAdmin). If you prefer sqlite, set $GLOBALS['dbms']='sqlite' and $GLOBALS['sqliteFile'] to hotspot.sqlite file. For backend you can use sqliteweb (https://github.com/coleifer/sqlite-web). 

7) Log in in Unifi Controller and set External Hotspot (from Guest Policies) to redirect to custom captive ip address.

8) All access will be logged into access_logs database table (set $GLOBALS['logAccessEnabled']) to false for disabling logging)

9) Set $GLOBALS['GuestMailAccess'] to true to enable guest authentication by email address (useful for signing up to newsletter)

10) Set $GLOBALS['showHomeRegistered'] to false to hide disable registered accounts (guest only)

11) Enjoy

***

### LICENSE
This tool is released under MIT License

***

### CREDITS
This Captive Portal is based on
- Medoo (http://medoo.in/)
- UniFi API browser (https://github.com/Art-of-WiFi/UniFi-API-browser)

***

### FUTURE RELEASES
I'm working for Linux ready hotspot distro with Espresso Frontend and Espresso-Admin. Will be available for Raspberry Pi 2-3 and X86/x64 platforms.

### ESPRESSO-ADMIN BACKEND (works only with mysql!) 
![alt tag](https://github.com/emanuelepaiano/espresso-admin/blob/master/screenshots/1.png)
<p><a href="https://github.com/emanuelepaiano/espresso-admin">Download Espresso-admin</a></p>

### AUTHOR
Emanuele Paiano - nixw0rm [at] gmail [dot] com

***

### SUPPORT ME
If you like this project, consider a little donation, so I can buy new hardware for testing and development. At least you can offer me a coffee.. :)

[![paypal](https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif)](https://www.paypal.me/emanuelepaiano)

***
