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

require "core.inc.php";

require "config.inc.php";


session_start();

/* Session Key for avoid directed access to this script */

$_SESSION['sessionKey'] = $GLOBALS['sessionLogging'];

/* Client Mac Address */

$_SESSION['id'] = $_GET['id'];          

/* Access Point Mac Address */
$_SESSION['ap'] = $_GET['ap'];          

/* GET REMOTE AGENT INFO */
$_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];


/* Loading captive portal page */


if ($_SESSION['id']==NULL) header("location: " . $GLOBALS['successURL']);



 loadPage("content_it.html", "content_en.html");





?>
