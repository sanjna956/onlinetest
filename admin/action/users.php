<?php
include("../connection.php"); 
?>

<?php  
   
  if($_REQUEST['subview']=="update")
   {
   $name = mysql_real_escape_string($_POST['name']);
   $phone = mysql_real_escape_string($_POST['phone']);	  
   $city = mysql_real_escape_string($_POST['city']);
   $address = mysql_real_escape_string($_POST['address']);	  
   $zipcode = mysql_real_escape_string($_POST['zip']);
   $state = mysql_real_escape_string($_POST['state']);	  	  	  
  
    $data = array("name"=>$name,
				"phone"=>$phone,
				"address"=>$address,
				"city"=>$city,
				"zipcode"=>$zipcode,
				"state"=>$state
		 );
	 $field ="id";	 
	 $id = $_REQUEST['id'];
		  if($db->update($data,'bk_users',$field,$id) == true)  
			{
			$_SESSION['users'] ="User Details Update SuccessFully.";
			}
		  else
		    {
			$_SESSION['users'] ="User Details couldn't be updated.Please try again.";
			}	
			//exit;
	  echo "<script>window.location.href='../users.php?subview=update&id=".$id."'</script>"; 	  		
   } 
  else if($_REQUEST['subview']=="bulk_actions")
   {
       $table = "bk_users";
	   $table_field = "account_status";
	   $action = $_POST['bulk_action'];
	   $data = $_POST['id'];
	   //print_r($_POST['id']);
	    if($db->bulk_actions($table,$table_field,$action,$data) == true)
		  {
		  $_SESSION['users'] = "Action Completed Successfully.";
		  }
	   else
	      {
		  $_SESSION['users'] = "Action couldn't be Completed. Please try again.";  
		  }  
		  
	  echo "<script>window.location.href='../users.php?subview=list'</script>"; 	  		
   } 
   
