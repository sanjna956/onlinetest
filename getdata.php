<?php
$url=$_SERVER['DOCUMENT_ROOT']."/tgt/";  
include($url."config/common-class.php"); 
$userid=$_SESSION['loginuser']['email']; 
$rowid = $_POST['rowid'];
$rowperpage = $_POST['rowperpage'];
$tid = $_POST['tid'];
if(isset($_POST['qsnid'])){
$qsnid = $_POST['qsnid'];
$yourans=$_POST['yourans'];
}
$sqlnum = "SELECT dis_qsnnum FROM bk_test WHERE id='".$tid."'";
$numq = mysqli_query($db->conn,$sqlnum) or die(mysqli_connect_errno()."Data cannot inserted");
$numres = mysqli_fetch_array($numq);
$disqsnnum=$numres['dis_qsnnum'];   

$numrow=$_POST['numrow']; 
$query = "SELECT count(*) as allcount FROM bk_question where test_id=$tid  ORDER BY RAND() LIMIT $disqsnnum";
$result = mysqli_query($db->conn,$query);
$fetchresult = mysqli_fetch_array($result); 
$allcount = $fetchresult['allcount'];
$query = "SELECT * FROM bk_question where test_id=$tid ORDER BY RAND()  ASC LIMIT ".$rowid.",".$rowperpage;
$result = mysqli_query($db->conn,$query);
$qnsnum=$rowid+1;
$bk_question_arr = array();
$bk_question_arr[] = array("allcount" => $allcount);
if(!empty($qsnid)){
	
$markssql = "SELECT mark_rightans FROM bk_test WHERE id='".$tid."'";
$marks = mysqli_query($db->conn,$markssql) or die(mysqli_connect_errno()."Data cannot inserted");
$getmarks = mysqli_fetch_array($marks);
$qsnmark=$getmarks['mark_rightans'];	
$sql = "SELECT * FROM bk_question where id=$qsnid";
$result1 = mysqli_query($db->conn,$sql);
while($row1 = mysqli_fetch_array($result1)){
	$id 		= $row1['id'];
	$test_id 	= $row1['test_id'];
	$title		= $row1['title'];
	$ans1 		= $row1['ans1'];
	$ans2 		= $row1['ans2'];
	$ans3 		= $row1['ans3'];
	$ans4 		= $row1['ans4'];
	$true_ans 	= $row1['true_ans'];
	$tdate=date("d/m/yy");
	$insqsn="SELECT * FROM bk_useranswer where qsn_id='$qsnid' and user_id='$userid'";
	$qsnnum=mysqli_query($db->conn,$insqsn);
	$totalqsn=mysqli_num_rows($qsnnum);
	if($totalqsn>0){
	  $updsql ="UPDATE bk_useranswer SET your_ans='$yourans',atmpdate='$tdate' WHERE qsn_id='$id' and user_id='$userid'";
	  mysqli_query($db->conn,$updsql) or die(mysqli_error());
	}else{ 
		mysqli_query($db->conn,"insert into bk_useranswer(user_id, test_id, que_des, ans1,ans2,ans3,ans4,true_ans,your_ans,qsn_id,marks,atmpdate) values ('$userid', $test_id,'$title','$ans1','$ans2','$ans3', '$ans4','$true_ans','$yourans','$id','$qsnmark','$tdate')") or die(mysqli_error());	
	} 
} 
} 
while($row = mysqli_fetch_array($result)){
    $id = $row['id'];
    $test_id = $row['test_id'];
    $title = $row['title'];
    $ans1 = $row['ans1'];
    $ans2 = $row['ans2'];
    $ans3 = $row['ans3'];
    $ans4 = $row['ans4'];
    $true_ans = $row['true_ans'];
	$image = $row['image'];
    $bk_question_arr[] = array("qnsnum"=>$qnsnum,"id" => $id,"title" => $title,"ans1" => $ans1,"ans2" => $ans2,"ans3" => $ans3,"ans4" => $ans4,"true_ans" => $true_ans,"image"=>$image); 
}




/* encoding array to JSON format */
echo json_encode($bk_question_arr);




