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


/* Filtering user and password for SQL Injection attacks */

if ($_POST["email"]!="") 
        $_SESSION["email"]=escape_sql($_POST["email"]);
else 
        $_SESSION["email"]=" ";


if ($_POST["user"]!="") 
        $_SESSION["user"]=escape_sql($_POST["user"]);
else 
        $_SESSION["user"]="guest";



if ($_POST["password"]!="") 
        $_SESSION["password"]=escape_sql($_POST["password"]);
else 
        $_SESSION["password"]="password";


$_SESSION["id"]=escape_sql($_SESSION["id"]);


if ($_SESSION['id']==NULL) header("location: " . $GLOBALS['successURL']);


if ($_SESSION['sessionKey'] == $GLOBALS['sessionLogging']) 
{
        ob_start();
        
        if(!isAuthorized($_SESSION["user"], $_SESSION["password"], $_SESSION["id"]))
        {
                loadPage("denied_it.html", "denied_en.html");
                exit();
        }else{
                loadProfile($_SESSION["user"]);
                
                /* Flush database Table removing old clients */
                cleanTable();  
        }
        
        /* check if current guest account has been expired */
        $expired=isExpired($_SESSION['id']);
        
        
        /* Try to authorize guest to access */
        if (!$expired)
                authorizeGuest($_SESSION['id'], $GLOBALS['minutes'], $GLOBALS['download'], $GLOBALS['upload'], $GLOBALS['quota']);
                
        ob_end_clean();
        unset($_SESSION['sessionKey']);
}

/* Flush database Table removing old clients */
cleanTable();

if (!$expired){ 
         /* Redirect to counter page. Log in successful! */
        loadPage("counter_it.html", "counter_en.html");
}else{
        /* Redirect to redirect error page. Log in unsuccessful! */
        loadPage("expired_it.html", "expired_en.html");    
        
        /* Away from our network! Come back later... */
        if ($GLOBAL['kickass']) 
                unauthorize_guest($_SESSION['id']);
}

?>


