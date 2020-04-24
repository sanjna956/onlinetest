<?php 
$url=$_SERVER['DOCUMENT_ROOT']."/tgt/";  
include($url."config/common-class.php");
$tid = $_POST['tid']; 
$sql2 = "SELECT test_id FROM bk_useranswer WHERE test_id='".$tid."'";
$res2 = mysqli_query($db->conn,$sql2) or die(mysqli_connect_errno()."Data cannot inserted");
$row2 = mysqli_num_rows($res2); 
echo $row2; 
?> 