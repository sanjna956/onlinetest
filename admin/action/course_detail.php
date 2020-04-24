<?php
include("../connection.php"); 
include_once 'thumbnail.class.php';
$obj = new Thumbnail();
$date=date("YmdHis");
if($_REQUEST['subview']=="add")
{ 
  $title =mysqli_real_escape_string($db->conn,$_POST['title']);
  $content =mysqli_real_escape_string($db->conn,$_POST['text']);
  $cat_id =mysqli_real_escape_string($db->conn,$_POST['category']);
  $sub_id =mysqli_real_escape_string($db->conn,$_POST['sub_cat']);
  $data = array("title"=>$title,
                "content"=>$content,
                "cat_id"=>$cat_id,
                "sub_id"=>$sub_id,
                "status"=>"active",
                "added_date"=>date("Y-m-d H:i:s", time())
                );
  if($db->insert($data,'bk_course_detail') == true)  
  {
  $last_id = mysqli_insert_id($db->conn);
      if($_FILES['image']['name']!="")
         {
           $image = $_FILES['image']['name'];
           $exp = explode(".",$image);
           $extension = end($exp);
           $image_name = "gallery_".$date.".".$extension;
          $upload = move_uploaded_file($_FILES['image']['tmp_name'],"../gallery/".$image_name);
          if($upload)
            {
           $thumbnail = $obj->generateThumbnail("../gallery/".$image_name, "../gallery/thumb/".$image_name, 848,305);
            $sql2 = "UPDATE bk_course_detail SET image_name='".$image_name."' WHERE id='".$last_id."'";
             $update_image =  mysqli_query($db->conn,$sql2) or die(mysqli_connect_errno()."Data cannot inserted");
            }  
         } 
   $_SESSION['menu'] ="Added Success Fully.";
   echo "<script>window.location.href='../course_detail.php?subview=list'</script>";   
 }
 else
 {
  $_SESSION['menu'] ="couldn't be added.Please try again.";
  echo "<script>window.location.href='../course_detail.php?subview=add'</script>";  
}

}   
if($_REQUEST['subview']=="update")
{
  $title =mysqli_real_escape_string($db->conn,$_POST['title']);
  $content =mysqli_real_escape_string($db->conn,$_POST['text']);
  $cat_id =mysqli_real_escape_string($db->conn,$_POST['category']);
  $sub_id =mysqli_real_escape_string($db->conn,$_POST['sub_cat']);
  $data = array("title"=>$title,
                "content"=>$content,
                "cat_id"=>$cat_id,
                "sub_id"=>$sub_id
                );
 $field ="id";   
 $id = $_REQUEST['id'];
 if($db->update($data,'bk_course_detail',$field,$id) == true)  
 {
  if($_FILES['image']['name']!="")
         {
           unlink("../gallery/".$_POST['added_image']);
           unlink("../gallery/thumb/".$_POST['added_image']);
           $image = $_FILES['image']['name'];
           $exp = explode(".",$image);
           $extension = end($exp);
           $image_name = "gallery_".$date.".".$extension;
           $upload = move_uploaded_file($_FILES['image']['tmp_name'],"../gallery/".$image_name);
          if($upload)
            {
            $thumbnail = $obj->generateThumbnail("../gallery/".$image_name, "../gallery/thumb/".$image_name, 848,305);
            $sql2 = "UPDATE bk_course_detail SET image_name='".$image_name."' WHERE id='".$id."'";
            $update_logo =  mysqli_query($db->conn,$sql2) or die(mysqli_connect_errno()."Data cannot inserted");
            }
         }
  $_SESSION['menu'] ="Details Update Success Fully.";
  echo "<script>window.location.href='../course_detail.php?subview=list'</script>";    
}
else
{
  $_SESSION['menu'] ="Details couldn't be updated.Please try again.";
  echo "<script>window.location.href='../course_detail.php?subview=list'</script>";    
} 
}
else if($_REQUEST['subview']=="bulk_actions")
{
 $table = "bk_course_detail";
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
echo "<script>window.location.href='../course_detail.php?subview=list'</script>";         
} 
else if($_REQUEST['subview']=="delete")
{
 $table = "bk_course_detail";
 $id = $_REQUEST['id'];
     //print_r($_POST['id']);
 $sql2 = "SELECT * FROM bk_course_detail WHERE id='".$id."'";
 $get_images = mysqli_query($db->conn,$sql2) or die(mysqli_connect_errno()."Data cannot inserted");
 $images = mysqli_fetch_assoc($get_images);
 unlink("../gallery/".$images['image_name']);
 unlink("../gallery/thumb/".$images['image_name']);
 if($db->delete_records($table,$id) == true)
 {
  $_SESSION['menu'] = "Record Deleted Successfully.";
}
else
{
  $_SESSION['menu'] = "Record couldn't be Deletd. Please try again.";  
}  
echo "<script>window.location.href='../course_detail.php?subview=list'</script>";         
}  
?>