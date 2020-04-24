<?php
$url=$_SERVER['DOCUMENT_ROOT']."/tgt/"; 
include($url."config/common-class.php"); 
 $rdurl=URL; 
 unset($_SESSION['msg']);  
  $res=$db->UserLogin($_POST['email'],$_POST['password']); 
  if(!empty($res)){
	$_SESSION['msg'] =$res; 
    header("Location:".$rdurl); 	
  }else{
	header("Location:".$rdurl."account.php");      
  }
?>