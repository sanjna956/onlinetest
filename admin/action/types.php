<?php
include("../connection.php"); 

if($_REQUEST['subview']=="add")
   {
        $type = mysql_real_escape_string($_POST['type']);
		$discount = mysql_real_escape_string($_POST['discount']);
	    if($db->already_added($type,'bk_p_types','type')==false)
		   {
				$data = array("cat_id"=>$_POST['category'],
				            "type"=>$type,
							"discount"=>$discount,
						    "status"=>"active",
						    "added_date"=>date("Y-m-d H:i:s", time())
				 );
			 
			  if($db->insert($data,'bk_p_types') == true)  
				{
				$_SESSION['types'] ="Product Type Added Success Fully.";
				}
			  else
				{
				$_SESSION['types'] ="Product Type couldn't be added.Please try again.";
				}	
		   }	
		else
		  {
		  $_SESSION['sub_category'] ="Product Type <span style='color:green; font-weight:bold;'>".$type."</span> Already Added.";
		  echo "<script>window.location.href='../types.php?subview=add'</script>"; 
		  }   	
	  echo "<script>window.location.href='../types.php?subview=list'</script>"; 	  		
   }
   
  if($_REQUEST['subview']=="update")
   {
     $discount = mysql_real_escape_string($_POST['discount']);
     $data = array("cat_id"=>$_POST['category'],"type"=>mysql_real_escape_string($_POST['type']),"discount"=>$discount);
	 $field ="id";	 
	 $id = $_POST['id'];
		  if($db->update($data,'bk_p_types',$field,$id) == true)  
			{
			$_SESSION['types'] ="Product Type Update Success Fully.";
			}
		  else
		    {
			$_SESSION['types'] ="Product Type couldn't be updated.Please try again.";
			}	
	  echo "<script>window.location.href='../types.php?subview=update&id=".$id."'</script>"; 	  		
   } 
  else if($_REQUEST['subview']=="bulk_actions")
   {
       $table = "bk_p_types";
	   $table_field = "status";
	   $action = $_POST['bulk_action'];
	   $data = $_POST['id'];
	   //print_r($_POST['id']);
	    if($db->bulk_actions($table,$table_field,$action,$data) == true)
		  {
		  $_SESSION['types'] = "Action Completed Successfully.";
		  }
	   else
	      {
		  $_SESSION['types'] = "Action couldn't be Completed. Please try again.";  
		  }  
		  
	  echo "<script>window.location.href='../types.php?subview=list'</script>"; 	  		
   } 
   
  else if($_REQUEST['subview']=="delete")
   {
       $table = "bk_p_types";
	   $id = $_REQUEST['id'];
	   //print_r($_POST['id']);
	    if($db->delete_records($table,$id) == true)
		  {
		  $_SESSION['types'] = "Record Deleted Successfully.";
		  }
	   else
	      {
		  $_SESSION['types'] = "Record couldn't be Deletd. Please try again.";  
		  }  
		  
	  echo "<script>window.location.href='../types.php?subview=list'</script>"; 	  		
   }  