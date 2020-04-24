<?php
include("../connection.php"); 
include_once 'thumbnail.class.php';
$obj = new Thumbnail();
$date=date("YmdHis");
if($_REQUEST['subview']=="add")
{ 
    $title =mysqli_real_escape_string($db->conn,$_POST['addque']);
    $test_id =mysqli_real_escape_string($db->conn,$_POST['testid']);
    $qns1 =mysqli_real_escape_string($db->conn,$_POST['ans1']);
    $qns2 =mysqli_real_escape_string($db->conn,$_POST['ans2']);
    $qns3 =mysqli_real_escape_string($db->conn,$_POST['ans3']);
    $qns4 =mysqli_real_escape_string($db->conn,$_POST['ans4']);
    $anstrue =mysqli_real_escape_string($db->conn,$_POST['anstrue']);
    $data = array(
                "test_id"=>$test_id,
                "title"=>$title, 
                "ans1"=>$qns1,
                "ans2"=>$qns2,
                "ans3"=>$qns3,
                "ans4"=>$qns4,
                "true_ans"=>$anstrue
                );
   //print_r($data);
		if($db->insert($data,'bk_question') == true)  
		{  
		$last_id = mysqli_insert_id($db->conn);
		extract($_POST);
		if(isset($_FILES['image']['name']))
		{
		$image = $_FILES['image']['name'];   
		$image_name = "gallery_".$date.".".$image;
		$upload = move_uploaded_file($_FILES['image']['tmp_name'],"../gallery/".$image_name);
		if($upload)
		{
		$thumbnail = $obj->generateThumbnail("../gallery/".$image_name, "../gallery/thumb/".$image_name,260,154);
		$sql2 = "UPDATE bk_question SET image='".$image_name."' WHERE id='".$last_id."'";
		$update_image =  mysqli_query($db->conn,$sql2) or die(mysqli_connect_errno()."Data cannot inserted");
		} 
		} 
		$last_id = mysqli_insert_id($db->conn);
		$_SESSION['menu'] ="Added Success Fully.";
		echo "<script>window.location.href='../veiwquestion.php?subview=list'</script>";   
		}
		else
		{ 
		 $_SESSION['menu'] ="couldn't be added.Please try again.";
		echo "<script>window.location.href='../veiwquestion.php?subview=add'</script>";  
		} 
}   
if($_REQUEST['subview']=="update")
{ 
   $title =mysqli_real_escape_string($db->conn,$_POST['addque']);
    $test_id =mysqli_real_escape_string($db->conn,$_POST['testid']);
    $qns1 =mysqli_real_escape_string($db->conn,$_POST['ans1']);
    $qns2 =mysqli_real_escape_string($db->conn,$_POST['ans2']);
    $qns3 =mysqli_real_escape_string($db->conn,$_POST['ans3']);
    $qns4 =mysqli_real_escape_string($db->conn,$_POST['ans4']);
    $anstrue =mysqli_real_escape_string($db->conn,$_POST['anstrue']);
    $data = array(
                "test_id"=>$test_id,
                "title"=>$title, 
                "ans1"=>$qns1,
                "ans2"=>$qns2,
                "ans3"=>$qns3,
                "ans4"=>$qns4,
                "true_ans"=>$anstrue
                );
			$field ="id";   
			$id = $_REQUEST['id'];
			if($db->update($data,'bk_question',$field,$id) == true){  
			unlink("../gallery/".$_POST['added_image']);
			$image = $_FILES['image']['name'];
			$exp = explode(".",$image);
			$extension = end($exp);
			$image_name = "gallery_".$date.".".$extension;
			$upload = move_uploaded_file($_FILES['image']['tmp_name'],"../gallery/".$image_name);
			if($upload)
			{
			$thumbnail = $obj->generateThumbnail("../gallery/".$image_name, "../gallery/thumb/".$image_name,260,154);
			$sql2 = "UPDATE bk_question SET image='".$image_name."' WHERE id='".$id."'";
			$update_logo =  mysqli_query($db->conn,$sql2) or die(mysqli_connect_errno()."Data cannot inserted");
			}
			  $_SESSION['menu'] ="Details Update Success Fully.";
			  echo "<script>window.location.href='../veiwquestion.php?subview=list'</script>";    
			}
			else
			{
			$_SESSION['menu'] ="Details couldn't be updated.Please try again.";
			echo "<script>window.location.href='../veiwquestion.php?subview=list'</script>";    
			} 
}
else if($_REQUEST['subview']=="bulk_actions")
{
 $table = "bk_question";
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
echo "<script>window.location.href='../veiwquestion.php?subview=list'</script>";         
} 
else if($_REQUEST['subview']=="delete")
{
	$table = "bk_question";
	$id = $_REQUEST['id'];
	//print_r($_POST['id']);
	$sql2 = "SELECT * FROM bk_question WHERE id='".$id."'";
	$get_images = mysqli_query($db->conn,$sql2) or die(mysqli_connect_errno()."Data cannot inserted");
	$images = mysqli_fetch_assoc($get_images);
	unlink("../gallery/".$images['image']);
	unlink("../gallery/thumb/".$images['image']);
	if($db->delete_records($table,$id) == true)
	{
	$_SESSION['menu'] = "Record Deleted Successfully.";
	}
	else
	{
	$_SESSION['menu'] = "Record couldn't be Deletd. Please try again."; 
	}  
	echo "<script>window.location.href='../veiwquestion.php?subview=list'</script>";        
}  
?>