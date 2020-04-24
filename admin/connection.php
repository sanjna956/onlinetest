<?php
$url=$_SERVER['DOCUMENT_ROOT']."/tgt/";
session_start();
error_reporting(0);
date_default_timezone_set('Asia/Calcutta');
$request_url = $_SERVER['REQUEST_URI'];
$exp_url = explode("/",$request_url);
$current_dir=  $_SERVER['SCRIPT_FILENAME'];
$expl = explode("/",$current_dir);
$dir_count = count($expl)-2;
$dir = $expl[$dir_count];

if($_SERVER['REMOTE_ADDR']=='::1')
{ 
if($dir=='action')
   include($url."classes/all.classes.php");
else if($dir=='public_html' || $dir=='') /*  localhost folder name */
   include($url."classes/all.classes.php");
else
  include($url."classes/all.classes.php");
}
else{

if($dir=='action')
 include($url."classes/all.classes.php");
else if($dir=='public_html' || $dir=='')/*  Online folder name if website on directly then use http either use folder name only */
 include($url."classes/all.classes.php");

else
 include($url."classes/all.classes.php");

}
$db = new Common();
$users = new Front_End;
//echo "<pre>";print_r($users);echo "</pre>"; die();
//$admin_email = $users->SiteSetting("email_id");
  


?>