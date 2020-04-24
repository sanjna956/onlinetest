<?php 
include('header.php');
if(!isset($_SESSION['loginuser'])){
	header("Location:".URL); 
}
$result=$db->AllData('bk_test'); 
?>
 	  <link href="css/main.css" rel="stylesheet" type="text/css"/> 
<!------ Include the above in your HEAD tag ---------->
<nav class="navbar navbar-default title1" style="position: initial;
   ">
   <div class="container-fluid">
      <div class="navbar-header">
         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
         <span class="sr-only">Toggle navigation</span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         </button>
      </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
         <ul class="nav navbar-nav"> 
            <li class="active"><a href="<?php echo URL; ?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;Home<span class="sr-only">(current)</span></a></li>
            <li><a href="<?php echo URL."account.php";?>"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp;Account</a></li>
            
         </ul>
      </div>
   </div>
</nav>
<div class="main bg">
   <div class="container">
      <div class="row">
         <div class="col-md-12">

            <div class="panel">
               <table class="table table-striped title1" >
                  <tbody>
				  <?php if(isset($_GET['msg'])==1){ ?>
				  <tr><h3 class="notification">Can You Continue Test click On Start.Other Wishe Click on <a href="<?php echo URL; ?>result.php">Get Result Here!</a></h3></tr>
				  <?php } ?>				  
				  <?php if(isset($_SESSION['fmsg'])){ ?>
				  <tr><h3 class="notification"><?php echo $_SESSION['fmsg'];  ?></h3></tr>
				  <?php unset($_SESSION['fmsg']);  } ?>
                     <tr> 
                        <td ><b>S.N.</b></td>
                        <td ><b>Name</b></td>
                        <td ><b>Total question</b></td>
                        <td ><b>Correct Answer</b></td> 	
                        <td ><b>Total Marks</b></td>
                        <td ><b>Time limit</b></td>
                        <td ><b>Action</b></td>
                     </tr>
					<?php 
					$i=1;
					while($row = mysqli_fetch_assoc($result)){
					$sql = "SELECT * FROM bk_question WHERE test_id='".$row['id']."'";
					$res = mysqli_query($db->conn,$sql) or die(mysqli_connect_errno()."Data cannot inserted");
					$total=mysqli_num_rows($res);
					$userid=$_SESSION['loginuser']['email']; 
					$sql2 = "SELECT * FROM bk_useranswer WHERE user_id='".$userid."' AND test_id='".$row['id']."'";
					$res2 = mysqli_query($db->conn,$sql2) or die(mysqli_connect_errno()."Data cannot inserted");
					$total2=mysqli_num_rows($res2);					
					?>
					<tr style="color:darkgreen"> 
					<td ><?php echo $i; ?></td>
					<td ><?php echo $row['title']; ?></td>
					<td ><?php echo $total; ?></td>
					<td ><?php echo $row['mark_rightans']; ?></td>
					<td ><?php echo $total*$row['mark_rightans']; ?></td>
					<td ><?php echo $row['totaltime']; ?></td>
					<td >
					<?php if(isset($_GET['msg'])==1){ ?>
					<?php if($total2>0){?>
					<button type="button" disabled class="startbtn btn"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;<span><b>Start</b></button>
					<?php }else{ ?>
						<a href="<?php echo URL.'quiz.php?id='.urlencode(base64_encode($row['id']));  ?>" class="startbtn btn"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;<span><b>Start</b></span></a>
					<?php } ?>
					<?php }else{ ?>
					<a href="<?php echo URL.'quiz.php?id='.urlencode(base64_encode($row['id']));  ?>" class="startbtn btn"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;<span><b>Start</b></span></a>
					<?php } ?>
					</td>
					</tr>
					<?php $i++; } ?>
                  </tbody>
               </table>
            </div>
            <div class="panel" style="">
               <h3 align="center" style="font-family:calibri">:: General Instructions ::</h3>
               <br>
               <ul type="circle">
                  <font style="font-size: 20px;font-family:calibri">
                     <li>
                        You are allowed to start the test whenever you want to. The timer would start only when you start the test. However remember that admin has full rights to disable the test at any time. So it is recommended to start the test at the prescribed time.
                     </li>
                     <li>
                        You can see the history of test taken and scores in the 'History' section.
                     </li>
                     <li>
                        To start the test, click on 'Start'.
                     </li>                
                     <li>
                        Once the test is started the timer would run irrespective of your logged in or logged our status. So it is recommended not to logout before test completion.
                     </li>
                     <li>
                        To mark an answer you need to select it and press the 'Lock' button. Upon locking, the selected answer would be displayed and the question will be marked "green"
                     </li>
                     <li>
                        Use the navigation buttons to navigate through different questions.
                     </li>
                     <li>
                        The marks for correct and incorrect answer are listed above in the table. 0 marks would be awarded for the questions that are "not marked" (having "red" status).
                     </li>
                     <li>
                        If you get some error, you can contact us via <a href="feedback.php">this form</a>
                     </li>
                     <br>
                  </font>
               </ul>
            </div>
         </div>
      </div>
   </div>
   <!-- ./container -->
</div>
<?php include_once "footer.php";  ?>