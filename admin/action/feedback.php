<?php
$id = $_REQUEST['id'];
include("../connection.php"); 
   if($_REQUEST['subview']=="delete")
   {
     $table = "tbl_feedback";
     $id = $_REQUEST['id'];
      if($db->delete_records($table,$id) == true)
      {
      $_SESSION['services'] = "Record Deleted Successfully.";
      }
     else
        {
        $_SESSION['services'] = "Record couldn't be Deletd. Please try again.";  
      }  
      echo "<script>window.location.href='../veiwfeedback.php?subview=list'</script>";          
   }  
?>