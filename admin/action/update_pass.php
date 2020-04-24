<?php
//print_r($_POST);
include("../connection.php");
//include("../allowed.php");
if($_POST['submit']=='Update')  
  {
	$sql2 = "SELECT password FROM bk_users WHERE password='".mysqli_real_escape_string($db->conn,md5($_POST['old_pass']))."' AND user_role='admin' AND id='".$_SESSION['admin_id']."'";
	$get_user_pass = mysqli_query($db->conn,$sql2) or die(mysqli_connect_errno()."Data cannot inserted");
	  if(mysqli_num_rows($get_user_pass))
	    {
		   $sql2 = "UPDATE bk_users SET password='".mysqli_real_escape_string($db->conn,md5($_POST['new_pass']))."' WHERE id='1'";
		   $UpdatePassword = mysqli_query($db->conn,$sql2) or die(mysqli_connect_errno()."Data cannot inserted");
		   if($UpdatePassword)
		     {
			  $_SESSION['c_pass'] = "Password Updated Successfully.";
			  echo "<script>window.location.href='../change_password.php'</script>";
			 }
		}
	 else{
	      $_SESSION['c_pass1'] = "Old Password Does Not Match.";
		   echo "<script>window.location.href='../change_password.php'</script>";
	 }	
  }
?>