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

use Medoo\Medoo;

require "Medoo.php";

$GLOBALS["database"] = new Medoo([
	'database_type' => 'sqlite',
	'database_file' => $GLOBALS['sqliteFile']
]);

if (!file_exists($GLOBALS['sqliteFile'])) die('File ' . $GLOBALS['sqliteFile'] . ' not found!'); 

/* return escaped mysql strings */
function escape_sql($str)
{
 return SQLite3::escapeString($str);

}

?>
