<?php 
include('header.php'); 
if(!isset($_SESSION['loginuser'])){
	header("Location:".URL); 
} 
$userid=$_SESSION['loginuser']['email'];
 
$sql = "SELECT test_id FROM bk_useranswer where user_id='$userid' GROUP BY test_id";
$res = mysqli_query($db->conn,$sql) or die(mysqli_connect_errno()."Data cannot inserted");
$sql2 = "SELECT * FROM bk_useranswer where user_id='$userid' ";
$res2 = mysqli_query($db->conn,$sql2) or die(mysqli_connect_errno()."Data cannot inserted");
$atmpqsn=mysqli_num_rows($res2);
$disqsnnum='';
$trueans=0;
$wrongans=0;
$totalmarks=0; 
$obtainmarks=0; 
while($row = mysqli_fetch_array($res)){
	$sqlnum = "SELECT dis_qsnnum,mark_rightans FROM bk_test WHERE id='".$row['test_id']."'";
	$numq = mysqli_query($db->conn,$sqlnum) or die(mysqli_connect_errno()."Data cannot inserted");
	$numres = mysqli_fetch_array($numq);
	$disqsnnum+=$numres['dis_qsnnum']; 
	$totalmarks+=$numres['mark_rightans']*$numres['dis_qsnnum'];
   
}
while($row1 = mysqli_fetch_array($res2)){ 
if($row1['your_ans']==$row1['true_ans']){
	 $trueans+=1;
	 $obtainmarks+=$row1['marks'];
}else{
	 $wrongans+=1;
}
}
$prc=$obtainmarks*100/$totalmarks; 
?>
<style>
td, th {
    padding: 10px; 
} 
</style>
<link href="css/main.css" rel="stylesheet" type="text/css"/>
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
            <li><a href="<?php echo URL."result.php";?>"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp;Result</a></li>
            
         </ul>
      </div>
   </div>
</nav>
<div class="main bg">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="panel">
               <center>
                  <h1 class="title" style="color:#660033">Result</h1>
                  <center>
                     <br>
                     <table class="table table-striped title1" style="font-size:20px;font-weight:1000;">
                        <tbody>
                           <tr style="color:darkblue">
                              <td>Total Questions</td>
                              <td><?php echo $disqsnnum; ?></td>
                           </tr> 
						      <tr style="color:orange">
                              <td>Attempted <span class="glyphicon glyphicon-ban-arrow" aria-hidden="true"></span></td>
                              <td style="vertical-align:middle"><?php echo $atmpqsn; ?></td>
                           </tr> 
                           <tr style="color:darkgreen">
                              <td>Correct Answer <span class="glyphicon glyphicon-ok-arrow" aria-hidden="true"></span></td>
                              <td style="vertical-align:middle"><?php echo $trueans; ?></td>
                           </tr>
                           <tr style="color:worngqsn">
                              <td>Wrong Answer <span class="glyphicon glyphicon-remove-arrow" aria-hidden="true"></span></td>
                              <td style="vertical-align:middle"><?php echo $wrongans; ?></td>
                           </tr>
                           <tr style="color:#990000">
                              <td>Overall Score <span class="glyphicon glyphicon-star" aria-hidden="true"></span></td>
                              <td style="vertical-align:middle"><?php echo substr($prc,0,5);?>%</td>
                           </tr> 
                           <tr></tr>
                        </tbody>
                     </table>
                  </center> 
               </center>
            </div>
            <div class="panel">
               <br>
               <h3 align="center" style="font-family:calibri">:: Detailed Analysis ::</h3>
               <br>
               <ol>
			   <?php
				$sql2 = "SELECT * FROM bk_useranswer where user_id='$userid'";
				$res2 = mysqli_query($db->conn,$sql2) or die(mysqli_connect_errno()."Data cannot inserted");			   
			   while($row1 = mysqli_fetch_array($res2)){
			   //echo "<pre>";print_r($row1);echo "</pre>"; //die(); 
			   ?> 
                  <li>
                     <div  class="reviewqsn"><?php echo $row1['que_des']; ?> </div> 
						<table width="100%" id="emp_table" border="0">
						<tbody>
						<tr id="tr">
							<?php if($row1['your_ans']==1 && $row1['your_ans']==$row1['true_ans']){ ?>
							<td class="green"><i class="fa fa-check" aria-hidden="true"></i> <?php echo $row1['ans1']; ?></td>
							<?php }elseif($row1['your_ans']==1 && $row1['your_ans']!=$row1['true_ans']){ ?>
							<td class="worngqsn"><i class="fa fa-close"></i> <?php echo $row1['ans1']; ?></td>
							<?php }else{ ?>
							<td><span>(A)</span> <?php echo $row1['ans1']; ?></td>
							<?php } ?> 
							<?php if($row1['your_ans']==2 && $row1['your_ans']==$row1['true_ans']){ ?>
							<td class="green"><i class="fa fa-check" aria-hidden="true"></i>  <?php echo $row1['ans2']; ?></td>
							<?php }elseif($row1['your_ans']==2 && $row1['your_ans']!=$row1['true_ans']){ ?>
							<td class="worngqsn"><i class="fa fa-close"></i> <?php echo $row1['ans2']; ?></td>
							<?php }else{ ?>
							<td><span>(B)</span> <?php echo $row1['ans2']; ?></td>
							<?php } ?>
							</tr>
							<tr id="tr">
							<?php if($row1['your_ans']==3 && $row1['your_ans']==$row1['true_ans']){ ?>
							<td class="green"><i class="fa fa-check" aria-hidden="true"></i>  <?php echo $row1['ans3']; ?></td>
							<?php }elseif($row1['your_ans']==3 && $row1['your_ans']!=$row1['true_ans']){ ?>
							<td class="worngqsn"><i class="fa fa-close"></i> <?php echo $row1['ans3']; ?></td>
							<?php }else{ ?>
							<td><span>(C)</span> <?php echo $row1['ans3']; ?></td>
							<?php } ?>
							<?php if($row1['your_ans']==4 && $row1['your_ans']==$row1['true_ans']){ ?>
							<td class="green"><i class="fa fa-check" aria-hidden="true"></i>  <?php echo $row1['ans4']; ?></td>
							<?php }elseif($row1['your_ans']==4 && $row1['your_ans']!=$row1['true_ans']){ ?>
							<td class="worngqsn"><i class="fa fa-close"></i> <?php echo $row1['ans4']; ?></td>
							<?php }else{ ?>
							<td><span>(C)</span> <?php echo $row1['ans4']; ?></td>
							<?php } ?> 
						</tr>
						</tbody> 
						</table>
                     <br><font class="trueans"><b>Correct Answer: </b></font><font class="anstrue">
					 <?php 
					 if($row1['true_ans']==1){ echo $row1['ans1']; } 
					 if($row1['true_ans']==2){ echo $row1['ans2']; } 
					 if($row1['true_ans']==3){ echo $row1['ans3']; } 
					 if($row1['true_ans']==4){ echo $row1['ans4']; } 
					 ?>
					 </font><br><br>
                  </li>
			   <?php } ?>
               </ol>
            </div>
         </div>
      </div>
   </div>
</div>
<?php include('footer.php'); ?>