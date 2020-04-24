<?php
$url=$_SERVER['DOCUMENT_ROOT']."/tgt/";
include($url."config/common-class.php"); 
unset($_SESSION['msg']); 
  if($db->CheckUserExist($_POST['email'])==true){ 
		$_SESSION['msg'] ="Your email id already exists. Please Login Here!.";
		$rdurl=URL; 
		header("Location:".$rdurl); 
  }else{
	   //echo "<pre>";print_r("ok");echo "</pre>"; die(); 
		  $data = array(
					"name"=>$_POST['name'],
					"mobile"=>$_POST['phonenumber'],
					"email"=>$_POST['email'],
					"address"=>$_POST['address'],
					"password"=>$_POST['password'],
					"company"=>$_POST['companyname'],
					"qualification"=>$_POST['qualification'],
					"experience"=>$_POST['experience'],
					"gender"=>$_POST['gender'],
					"dob"=>$_POST['dob'],
					);
		if($db->insert($data,'tbl_registration') == true)  
		{ 	
		$_SESSION['msg'] ="Your  Registration  Is Successfull. Please Login Here!.";
		$rdurl=URL; 
		header("Location:".$rdurl);    
		}   
		else 
		{ 
		$_SESSION['msg'] ="couldn't be added.Please try again.";
		$rdurl=URL."registraion.php";  
		header("Location:".$rdurl);      
		}  
   }
?>