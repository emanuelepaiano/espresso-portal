<?php 
/*  

PHP Wifi Captive Portal 
for Ubiquiti APs
       
version: 0.5 
author: Emanuele Paiano - nixw0rm@gmail.com
------------------------------------------------------------------------------

The MIT License (MIT)

Copyright (c) 2017, Emanuele Paiano

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

*/

 //error_reporting(E_ALL);
 //ini_set('display_errors', '1');




/* Captive Portal settings */


/* Native Language for redirect ** */
$GLOBALS['nativeLang'] = 'it'; 


/* Session Key (YOU MUST CHANGE a new random!) */
$GLOBALS['sessionLogging'] = '40e4ac845d489e3c0cf501bcbdc424ab'; 


/* Promotional URL to redirect after log in. ** */
$GLOBALS['successURL']='http://www.google.it';


/* Redirect timeout promotionalURL */
$GLOBALS['successRedirect']=5;


/* Error URL to redirect after log unsuccessful. */
$GLOBALS['errorURL']='http://www.google.it';


/* Redirect timeout promotionalURL */
$GLOBALS['errorRedirect']=15;


/* If true, guest user, must insert mail to starting surf */
$GLOBALS['GuestMailAccess']=false;


/* If true, show "Do you have an account?" on home */
$GLOBALS['showHomeRegistered']=true;


/* If true, all sessions will be logged into database table 
   specified by $GLOBALS['LogSessionsTable'] */
$GLOBALS['logAccessEnabled']=true;


/* If true the portal will disconnect an expired guest from wifi after expired page loaded */
$GLOBAL['kickass']=true;



/* Unifi Access Point Controller */

/* Controller Server */
$GLOBALS['unifiServer']= "https://127.0.0.1:8443";  

/* Controller admin user */
$GLOBALS['unifiUser']="ubntuser";


/* Controller admin pass */
$GLOBALS['unifiPass']="ubntpassword";

/* Controller version */
$GLOBALS['unifiVersion']="4.8.18";

/* Controller site */
$GLOBALS['unifiSite']="default";



/* Database Management System (mysql, sqlite) */
$GLOBALS['dbms']='mysql';


/* Sqlite3 Database */
$GLOBALS['sqliteFile']='db/hotspot.sqlite';


/* Mysql Server */
$GLOBALS['mysqlServer']= "localhost";

/* Mysql User */
$GLOBALS['mysqlUser']="mysql";

/* Mysql Pass */
$GLOBALS['mysqlPass']="password";


/* Mysql Database Name */
$GLOBALS['mysqlName']="hotspot";

/* Mysql Session Table Name */
$GLOBALS['mysqlSessionTable']="sessions";

/* Mysql Log Session Table Name */
$GLOBALS['LogSessionsTable']="access_logs";
        
/* Mysql port */
$GLOBALS['mysqlServerPort']=3306;

?>
