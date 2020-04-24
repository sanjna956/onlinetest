<?php
include("../connection.php"); 
include_once 'thumbnail.class.php';
$obj = new Thumbnail();
$date=date("YmdHis");
if($_REQUEST['subview']=="add")
   {
		 $title = mysqli_real_escape_string($db->conn,$_POST['title']);
		 $cat_id = mysqli_real_escape_string($db->conn,$_POST['category']);
			$data = array("title"=>$title,
				          "cat_id"=>$cat_id,
						 "status"=>"active",
						 "added_date"=>date("Y-m-d H:i:s", time())
			 );
		  if($db->insert($data,'bk_subject') == true)  
			{
			$last_id = mysqli_insert_id($db->conn);
			$_SESSION['category'] ="Subject Added Success Fully.";
			echo "<script>window.location.href='../manage_subject.php?subview=list'</script>"; 	  
		 }
				  else {
      $_SESSION['category'] ="Subject Not Added Success Fully.";
			echo "<script>window.location.href='../manage_subject.php?subview=list'</script>"; 	  
    } 	
   }
  if($_REQUEST['subview']=="update")
   {
    $title = mysqli_real_escape_string($db->conn,$_POST['title']);
    $cat_id = mysqli_real_escape_string($db->conn,$_POST['category']);
		$data = array("title"=>$title,
			          "cat_id"=>$cat_id,
					);
	 $field ="id";	 
	 $id = $_REQUEST['id'];
	 if($db->update($data,'bk_subject',$field,$id) == true)  {
		 	 
			$_SESSION['category'] ="Subject Update Success Fully.";
			 echo "<script>window.location.href='../manage_subject.php?subview=list'</script>"; 	 
			}
		  else
		    {
			$_SESSION['category'] ="Subject couldn't be updated.Please try again.";
			 echo "<script>window.location.href='../manage_subject.php?subview=list'</script>"; 	 
			}		
   }
  else if($_REQUEST['subview']=="bulk_actions")
   {
       $table = "bk_subject";
	   $table_field = "status";
	   $action = $_POST['bulk_action'];
	   $data = $_POST['id'];
	   //print_r($_POST['id']);
	    if($db->bulk_actions($table,$table_field,$action,$data) == true)
		  {
		  $_SESSION['category'] = "Action Completed Successfully.";
		  }
	   else
	      {
		  $_SESSION['category'] = "Action couldn't be Completed. Please try again.";  
		  }  
		  
	  echo "<script>window.location.href='../manage_subject.php?subview=list'</script>"; 	  		
   } 
   
  else if($_REQUEST['subview']=="delete")
   {
       $table = "bk_subject";
	   $id = $_REQUEST['id'];
	    $sql2 = "SELECT * FROM bk_subject WHERE id='".$id."'";
		$get_images =	mysqli_query($db->conn,$sql2) or die(mysqli_connect_errno()."Data cannot inserted");
		
	    if($db->delete_records($table,$id) == true)
		  {
		  $_SESSION['category'] = "Record Deleted Successfully.";
		  }
	   else
	      {
		  $_SESSION['category'] = "Record couldn't be Deletd. Please try again.";  
		  }  
		  
	  echo "<script>window.location.href='../manage_subject.php?subview=list'</script>"; 	  		
   }  