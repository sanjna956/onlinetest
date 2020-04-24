<?php
include("../connection.php");  
include_once 'thumbnail.class.php';
$obj = new Thumbnail();
$date=date("YmdHis");
if($_REQUEST['subview']=="add")
{ 
  $title =mysqli_real_escape_string($db->conn,$_POST['title']);
  $mark_rightans =mysqli_real_escape_string($db->conn,$_POST['mark_rightans']);
  $totaltime =mysqli_real_escape_string($db->conn,$_POST['totaltime']);
  $disqsn =mysqli_real_escape_string($db->conn,$_POST['disqsn']);  
  $data = array("title"=>$title,
                "mark_rightans"=>$mark_rightans,
                "totaltime"=>$totaltime,
                "dis_qsnnum"=>$disqsn,
                );
  if($db->insert($data,'bk_test') == true)  
  {
  $last_id = mysqli_insert_id($db->conn);
      
   $_SESSION['menu'] ="Added Success Fully.";
   echo "<script>window.location.href='../testview.php?subview=list'</script>";   
 }
 else
 {
  $_SESSION['menu'] ="couldn't be added.Please try again.";
  echo "<script>window.location.href='../testview.php?subview=add'</script>";  
}

}   
if($_REQUEST['subview']=="update")
{
  $title =mysqli_real_escape_string($db->conn,$_POST['title']);
  $mark_rightans =mysqli_real_escape_string($db->conn,$_POST['mark_rightans']);
  $totaltime =mysqli_real_escape_string($db->conn,$_POST['totaltime']);
  $disqsn =mysqli_real_escape_string($db->conn,$_POST['disqsn']); 
  $data = array("title"=>$title,
                "mark_rightans"=>$mark_rightans,
                "totaltime"=>$totaltime,
			    "dis_qsnnum"=>$disqsn,
                );
 $field ="id";   
 $id = $_REQUEST['id'];
 if($db->update($data,'bk_test',$field,$id) == true)  
 {
  $_SESSION['menu'] ="Details Update Success Fully.";
  echo "<script>window.location.href='../testview.php?subview=list'</script>";    
}
else
{
  $_SESSION['menu'] ="Details couldn't be updated.Please try again.";
  echo "<script>window.location.href='../testview.php?subview=list'</script>";    
} 
}
else if($_REQUEST['subview']=="bulk_actions")
{
 $table = "bk_test";
 $table_field = "status";
 $action = $_POST['bulk_action'];
 $data = $_POST['id'];
     //print_r($_POST['id']);
 if($db->bulk_actions($table,$table_field,$action,$data) == true)
 {
  $_SESSION['menu'] = "Action Completed Successfully.";
}
else
{
  $_SESSION['menu'] = "Action couldn't be Completed. Please try again.";  
}  
echo "<script>window.location.href='../testview.php?subview=list'</script>";         
} 
else if($_REQUEST['subview']=="delete")
{
 $table = "bk_test";
 $id = $_REQUEST['id'];
     //print_r($_POST['id']);
 $sql2 = "SELECT * FROM bk_test WHERE id='".$id."'";
 $get_images = mysqli_query($db->conn,$sql2) or die(mysqli_connect_errno()."Data cannot inserted");
 if($db->delete_records($table,$id) == true)
 {
  $_SESSION['menu'] = "Record Deleted Successfully.";
}
else
{
  $_SESSION['menu'] = "Record couldn't be Deletd. Please try again.";  
}  
echo "<script>window.location.href='../testview.php?subview=list'</script>";         
}  
?>