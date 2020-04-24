<?php

include("../connection.php"); 

if($_REQUEST['subview']=="login")
   {
       $user_name = mysqli_real_escape_string($db->conn,$_POST['user_name']);
	   $password = mysqli_real_escape_string($db->conn,md5($_POST['password']));
	   
	    
	    if($db->UserLogin($user_name,$password)=="true")
		   {
		   	  echo "<script>window.location.href='../admin.php'</script>"; 	  		
		   }	
		else
		  {
		  $_SESSION['login'] = $db->UserLogin($user_name,$password);
		  echo "<script>window.location.href='../index.php'</script>"; 
		  }   	
   }
   
  