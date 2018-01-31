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

require "class.unifi.php";

require "config.inc.php";



if($GLOBALS['dbms']=='mysql') require "mysql_core.inc.php";

else if($GLOBALS['dbms']=='sqlite') require "sqlite_core.inc.php";

/*
   loadPage(): include webpage by used language by guest's browser language.
             If language is $nativeLanguage so will be loaded $nativePage
             otherwise will be load $alternativePage 


*/
function loadPage($nativePage, $alternativePage=NULL, $nativeLanguage=NULL)
{

   if ($nativeLanguage==NULL) $nativeLanguage=$GLOBALS['nativeLang'];
   
   $lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];

   if ($alternativePage!=NULL)
   {

     if (substr($lang, 0, 2) == $nativeLanguage) {
     
        require('html/' . $nativePage);
     
     }else{
     
        require('html/' . $alternativePage);
     }
   
   }else{
        
        require('html/' . $nativePage);
   
   }



}


/*
   detectOS: return guest's device operating system  


*/
function detectOS() { 

    $userAgent=$_SESSION['userAgent'];

    $os="Unknown";

    $osList=array(
                    '/windows nt 10/i'      =>  'Windows 10',
                    '/windows nt 6.3/i'     =>  'Windows 8.1',
                    '/windows nt 6.2/i'     =>  'Windows 8',
                    '/windows nt 6.1/i'     =>  'Windows 7',
                    '/windows nt 6.0/i'     =>  'Windows Vista',
                    '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                    '/windows nt 5.1/i'     =>  'Windows XP',
                    '/windows xp/i'         =>  'Windows XP',
                    '/windows nt 5.0/i'     =>  'Windows 2k',
                    '/windows me/i'         =>  'Windows ME',
                    '/win98/i'              =>  'Windows 98',
                    '/win95/i'              =>  'Windows 95',
                    '/win16/i'              =>  'Windows 3.11',
                    '/macintosh|mac os x/i' =>  'Mac OS X',
                    '/mac_powerpc/i'        =>  'Mac OS 9',
                    '/linux/i'              =>  'Linux',
                    '/ubuntu/i'             =>  'Ubuntu',
                    '/iphone/i'             =>  'iPhone',
                    '/ipod/i'               =>  'iPod',
                    '/ipad/i'               =>  'iPad',
                    '/android/i'            =>  'Android',
                    '/blackberry/i'         =>  'BlackBerry',
                    '/webos/i'              =>  'Mobile'
                   );

    foreach ($osList as $regex => $value) { 

        if (preg_match($regex, $userAgent)) {
            $os=$value;
        }

    }   

    return $os;

}




/*
   return guest's device browser

*/
function detectBrowser() {


    $userAgent=$_SESSION['userAgent'];

    $browser="Unknown";

    $browserList=array(
                    '/msie/i'       =>  'Internet Explorer',
                    '/firefox/i'    =>  'Firefox',
                    '/safari/i'     =>  'Safari',
                    '/chrome/i'     =>  'Chrome',
                    '/opera/i'      =>  'Opera',
                    '/netscape/i'   =>  'Netscape',
                    '/maxthon/i'    =>  'Maxthon',
                    '/konqueror/i'  =>  'Konqueror',
                    '/mobile/i'     =>  'Mobile Browser'
                );

    foreach ($browserList as $regex => $value) { 

        if (preg_match($regex, $userAgent)) {
            $browser=$value;
        }

    }

    return $browser;

}



/*
   authorize remote guest for $minutes, with $download limit, $upload, $quota
*/

function authorizeGuest($id, $minutes, $download=NULL, $upload=NULL, $quota=NULL)
{

        if ($minutes==NULL) $minutes=$GLOBALS['minutes'];

        if ($download==NULL) $download=$GLOBALS['download'];
        
        if ($upload==NULL) $upload=$GLOBALS['upload'];
        
        if ($quota==NULL) $quota=$GLOBALS['quota'];
        
        $ubnController=new unifiapi;

        $ubnController->user=$GLOBALS['unifiUser'];

        $ubnController->password=$GLOBALS['unifiPass'];

        $ubnController->baseurl=$GLOBALS['unifiServer'];
        
        $ubnController->site=$GLOBALS['unifiSite'];

        $ubnController->controller=$GLOBALS['unifiVersion'];

        $ubnController->login();
        

        $ubnController->authorize_guest($id,$minutes, $upload, $download, $quota);
        
        $ubnController->logout();
       
        registerClient();
       

}

/* Subtract to remaining time an offset */
function fakeTime($id, $offset=NULL)
{
  if ($offset==NULL) $offset=$GLOBALS['fakeMinutesOffset'];
  
  $faketime=remainingTime($id)-$offset;
  
  if ($faketime<=0)
  {
        return 0;
  }
  
  return $faketime;
  
}


/* Ottenere url pagina corrent */

function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}


/* Disconnect Client */
function unauthorize_guest($id)
{
  $ubnController=new unifiapi;

  $ubnController->user=$GLOBALS['unifiUser'];

  $ubnController->password=$GLOBALS['unifiPass'];

  $ubnController->baseurl=$GLOBALS['unifiServer'];

  $ubnController->site=$GLOBALS['unifiSite'];

  $ubnController->controller=$GLOBALS['unifiVersion'];

  $ubnController->login();


  $ubnController->unauthorize_guest($id);

  $ubnController->logout();
  
}


/* 

   return $field value from group with name $name
 */
function getGroupVal($name, $field)
{
 $name=escape_sql($name);
 
 return getValueFromDB($field, "groups", "name='" . $name . "';");
}



/* 
   return $field value from users with name $name
 */
function getUserVal($username, $field)
{
 
 $username=escape_sql($username);
 
 return getValueFromDB($field, "users", "username='" . $username . "';");
}


/* 
   set user $field with $value
 */
function setUserVal($username, $field, $value)
{
 
 $username=escape_sql($username);
 
 return updateValueToDB($field, "users", $value,"users.id='" . getUserVal($username, "id") . "';");
}




/* 
   set group $field with $value
 */
function setGroupVal($name, $field, $value)
{
 
 $username=escape_sql($name);
 
 return updateValueToDB($field, "groups", $value,"groups.id='" . getGroupVal($name, "id") . "';");
}




/* return settings from database
   $value: option value to return
 */
function getSettingVal($name)
{

 $name=escape_sql($name);

 return getValueFromDB("value", "settings", "param='" . $name . "'");
}


/* 
   return user's group
 */
function getUserGroup($username)
{
 $username=escape_sql($username);
 
 return getValueFromDB("name", "users, groups", "username='" . $username . "' and " . "groups.id=users.group_id");
}


/* 
   return user's limit where $field are:
   quota: quota in MBytes
   minutes: minutes quota
   blockinterval: minutes to block
   upload: limit upload in KBytes
   download: download limit in KBytes
 */
function getUserLimit($username, $field)
{
 return getGroupVal(getUserGroup($username), $field);
}


 /* 
   return true if user, password and device's mac address is correct, 
   false otherwise
   
 */
 function isValidLogin($username, $password, $mac)
 {
   
   $user_password=getUserVal($username, "password");
   
   $user_device=getUserVal($username, "device");
   
   if (($user_password==$password) && ($user_device==$mac)) return true;
   
   return false;
   
 }



 /* 
   return true if user is enabled, 
   false otherwise
   
 */
 function isUserEnabled($username)
 {
   
   if (getUserVal($username, "enabled")=='1') return true;
   
   return false;
   
 }




 /* 
   return true if user, password and device's mac address is correct, 
   false otherwise
   
 */
 function isAuthorized($username, $password, $mac)
 { 
   $user_device=getUserVal($username, "device");
  
   if(!isUserEnabled($username)) return false; 
 
   if($username=="guest") return true;
 
   if (isValidLogin($username, $password, $mac)) return true;

   elseif(isValidLogin($username, $password, "") && ($user_device=="")) 
   { 
    /* Set user's device at first login */
    setUserVal($username, "device", $mac);
   
    return true;
   
   }
   elseif(isValidLogin($username, $password, "ignore") && ($user_device=="ignore"))
   {
    return true;
   }
   else{
    
    return false;
   
   }
 }
 
  /* 
   load User Profile (minutes, download, quota, blockInterval, fakeMinutesOffset)
   
 */
 function loadProfile($username)
 { 
 
        /* Minutes guest allowing surfing */ 
        $GLOBALS['minutes']=getUserLimit($username, "minutes");        

        /* Download Bandwitdh for guest */    
        $GLOBALS['download']=getUserLimit($username, "download");      

        /* Upload Bandwitdh for guest */       
        $GLOBALS['upload']= getUserLimit($username, "upload");         

        /* Download quota for guest (in MBytes) */
        $GLOBALS['quota'] = getUserLimit($username, "quota");          

        /* Block expired account for an interval (minutes) */
        $GLOBALS['blockInterval'] = getUserLimit($username, "blockInterval");
    
        /* 
           Hide minutes from remaining time. Show less remaining time. 
                set 0 to disable fake time.
        */
        $GLOBALS['fakeMinutesOffset']=getUserLimit($username, "fakeminutesoffset");
 }
 
 
 
 /*
   remove from database old clients' sessions
*/
function cleanTable()
{
 $removeDate=new DateTime(date('Y') . '-' . date('m') . '-' . date('d') . ' ' . date('H') . ':' . date('i') . ':' . date('s'));
  
 $GLOBALS["database"]->delete($GLOBALS['mysqlSessionTable'], ["remove[<=]"=>$removeDate->Format('Y-m-d H:i:s')]);
}


/*
   return true if guest account expired, false otherwise
   id: Guest mac address
*/
function isExpired($id)
{
 $expire=true;
 
 $datas=$GLOBALS["database"]->select($GLOBALS['mysqlSessionTable'], "expire", ["device[=]"=>$id]);
 
 $currentDate=new DateTime(date('Y') . '-' . date('m') . '-' . date('d') . ' ' . date('H') . ':' . date('i') . ':' . date('s'));
 
 foreach($datas as $value)
 {
  $expireDate = new DateTime($value);
  if ($currentDate>=$expireDate) $expire=true;
  else $expire=false;
 }
 
 if(count($datas)==0) $expire=false;
 
 return $expire;
}



/*
   return true if logged, false otherwise
*/
function alreadyLogged($id)
{
 $res=false;
 
 $datas=$GLOBALS["database"]->select($GLOBALS['mysqlSessionTable'], "device", ["device[=]"=>$id]);
 
 foreach($datas as $value)
 {
  $res=true;
 }
 return $res;
}

/*
   register client into database (log in)
*/
function registerClient()
{
  if (!alreadyLogged($_SESSION['id']))
  {
    $userOS=detectOS();

    $id=$_SESSION['id'];
    
    $ap=$_SESSION['ap'];

    $userBrowser=detectBrowser();
    
    $datetime = date_create()->format('Y-m-d H:i:s');
                
    $ip=$hostname = getenv('HTTP_HOST');
    
    $expireDate = new DateTime(date('Y') . '-' . date('m') . '-' . date('d') . ' ' . date('H') . ':' . date('i') . ':' . date('s'));

    date_modify($expireDate, '+' . $GLOBALS['minutes'] . ' minutes');
                
    $to_time = $expireDate->Format('Y-m-d H:i:s');

    date_modify($expireDate, '+' . $GLOBALS['blockInterval'] . ' minutes');

    $unlock=$expireDate->Format('Y-m-d H:i:s');
    
    $newId=$GLOBALS["database"]->max("sessions", "id")+1;
    
    $userMail=$_SESSION['email'];

    //echo $newId;
    
    //$sql="INSERT INTO " . $GLOBALS['mysqlSessionTable'] . " (id, device, ip, ap, lastlog, expire, remove, browser, os, user_id)
                //VALUES ($newId, '$id', '$ip', '$ap', '$datetime', '$to_time', '$unlock', '$userBrowser', '$userOS', '" . getUserVal($_SESSION["user"], "id") ."')";
                    
    $GLOBALS["database"]->insert($GLOBALS['mysqlSessionTable'], [
    
       "id"=>$newId,
    
       "device"=>$id, 
    
       "ip"=>$ip,
    
       "ap"=>$ap,
    
       "lastlog"=>$datetime, 
    
       "expire"=>$to_time, 
    
       "remove"=>$unlock,
     
       "browser"=>$userBrowser,
     
       "os"=>$userOS,
     
       "user_id"=>getUserVal($_SESSION["user"], "id")
     
     ]);            


    if ($GLOBALS['logAccessEnabled']){
		$GLOBALS["database"]->insert($GLOBALS['LogSessionsTable'], [
		
		   "id"=>$newId,
		
		   "device"=>$id, 
		
		   "ip"=>$ip,
		
		   "ap"=>$ap,
		
		   "lastlog"=>$datetime, 
		
		   "expire"=>$to_time, 
		
		   "remove"=>$unlock,
		 
		   "browser"=>$userBrowser,
		 
		   "os"=>$userOS,

		   "email"=>$userMail,
		 
		   "user_id"=>getUserVal($_SESSION["user"], "id")
		 
		 ]);
	}


  }
  

}


/* Time operations */

function remainingTime($id)
{
 $remaining=0;
 
 $datas=$GLOBALS["database"]->select($GLOBALS['mysqlSessionTable'], "expire", ["device[=]"=>$id]);
 
 foreach($datas as $value)
 {
  $date=$value;
           
  $expireDate = new DateTime($date);

  $currentDate=new DateTime(date('Y') . '-' . date('m') . '-' . date('d') . ' ' . date('H') . ':' . date('i') . ':' . date('s'));
        
  $to_time = strtotime($currentDate->Format('Y-m-d H:i:s'));
        
  $from_time = strtotime($expireDate->Format('Y-m-d H:i:s'));
        
  $remaining=round(abs($to_time - $from_time) / 60);
 }
 
 return $remaining;
}




/*
   return value from db
   $table: table to read
   $field: field name from $table
   $where: where string for sql
   
*/
function getValueFromDB($field, $table, $where=NULL)
{
 
 if ($where!=NULL) $sql='select ' . $field . ' from ' . $table . ' where '. $where . ';';
 else $sql='select ' . $field . ' from ' . $table . ';';
 
 $datas=$GLOBALS["database"]->query($sql)->fetchAll();
 
 if (array_key_exists('0', $datas)){
 
     if (array_key_exists($field, $datas[0])) return $datas[0][$field];
 }
  
 return false; 
}



/*
   update value to db
   $table: table
   $field: field to update in $table
   $value: new value to write
   $where: where string for sql
   
*/
function updateValueToDB($field, $table, $value, $where)
{

 $table=escape_sql($table);
 
 $value=escape_sql($value);
 
 $field=escape_sql($field);
 
 $where=escape_sql($where);

 $sql='update ' . $table . ' set ' . $field . "='" . $value . "' where ". $where . ';';
 
 $datas=$GLOBALS["database"]->query($sql);
 
 return count($datas)>0;
 
}

?>
