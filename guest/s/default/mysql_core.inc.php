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
require "Medoo.php";

use Medoo\Medoo;
 
$database = new Medoo([
	// required
	'database_type' => 'mysql',
	'database_name' => $GLOBALS['mysqlName'],
	'server' => $GLOBALS['mysqlServer'],
	'username' => $GLOBALS['mysqlUser'],
	'password' => $GLOBALS['mysqlPass'],
	'charset' => 'utf8',
 
	// [optional]
	'port' => $GLOBALS['mysqlServerPort'],
 
	// [optional] Table prefix
	'prefix' => '',
]);


/* return escaped mysql strings */
function escape_sql($str)
{
 $con=mysqli_connect($GLOBALS['mysqlServer'], $GLOBALS['mysqlUser'], $GLOBALS['mysqlPass'], $GLOBALS['mysqlName']);
 
 if (mysqli_connect_errno()) {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }
 
 
 $str=mysqli_real_escape_string($con, $str);
 
 mysqli_close($con);
 
 return $str;

}



?>
