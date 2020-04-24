<?php
$url=$_SERVER['DOCUMENT_ROOT']."/tgt/";
include($url."config/common-class.php"); 
unset($_SESSION['fmsg']); 
	   //echo "<pre>";print_r("ok");echo "</pre>"; die(); 
		  $data = array(
					"name"=>$_POST['name'],
					"email"=>$_POST['email'], 
					"subject"=>$_POST['subject'],
					"feedback"=>$_POST['feedback'],
					);
		if($db->insert($data,'tbl_feedback') == true)  
		{ 	
		$_SESSION['fmsg'] ="Your  Feedback  Is Successfull Send !";
		$rdurl=URL."account.php"; 
		header("Location:".$rdurl);    
		}   
		else 
		{ 
		$_SESSION['fmsg'] ="couldn't be send.Please try again.";
		$rdurl=URL."feedback.php";  
		header("Location:".$rdurl);      
		}  

?>