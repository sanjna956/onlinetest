<?php 
include("header.php");
$id=$_GET['id'];
$ursql = "SELECT email,name from tbl_registration where id='$id'";
$urres = mysqli_query($db->conn,$ursql) or die(mysqli_connect_errno()."Data cannot inserted");
$curntrow = mysqli_fetch_array($urres);
//echo "<pre>";print_r($curntrow['email']);echo "</pre>";
 $userid=$curntrow['email'];
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
$testname="";
while($row = mysqli_fetch_array($res)){
$sqlnum = "SELECT dis_qsnnum,mark_rightans,title FROM bk_test WHERE id='".$row['test_id']."'";
$numq = mysqli_query($db->conn,$sqlnum) or die(mysqli_connect_errno()."Data cannot inserted");
$numres = mysqli_fetch_array($numq);
$testname.=$numres['title'].","; 
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
   .dataTables_filter {
   float: right;
   padding-top: 5px;
   display: none;
   } 
   #example_info{
   display: none;
   }
   #example_paginate{
   display: none;
   }
   table.dataTable thead .sorting_asc:after {
   content: "";
   margin-left: 10px;
   font-family: fontawesome;
   cursor: pointer;
   display:none !important; 
   }
   table.dataTable thead .sorting_asc:after:hover {  
   content: "";
   margin-left: 10px;
   font-family: fontawesome;
   cursor: pointer;
   display:none !important; 
   }
   .reviewqsn{
   font-size: 18px;
   margin-bottom: 12px;
   } 
   .trueans{
    font-weight: 700;
    color: #000;
    font-size: 16px;
   }   
.anstrue{
	font-size: 16px;
	color: #36da2b;  
}
.worngqsn{
color: red;
}  
.green{
	color: #12d412; 
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         User History
      </h1>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="breadcrumb-item"><a href="#"><i class="fa fa-files-o"></i>View User History</a></li>
      </ol>
   </section>
   <br>
   <div class="box">
      <div class="box-body">
         <div class="table-rs" style="overflow-x:auto;">
            <table id="example" class="userdetails table table-bordered  display nowrap margin-top-10 table-responsive">
               <thead>
                  <tr>
                     <th>
                        <h2 class="title" style="color:#660033">History (<?php echo $curntrow['name']; ?>) </h2>
                     </th>
                  </tr>
               </thead>
               <tbody>
                  <tr> 
                     <td>
					 <?php if($disqsnnum>0){ ?>
                        <div class="panel">
                           <center>
                              <center>
                                 <br>
                                 <table class="table table-striped title1" style="font-size:20px;font-weight:1000;">
									<tbody>
									<tr style="color:darkgreen">								  
									<td>Attempted Test Name <span class="glyphicon glyphicon-ban-arrow" aria-hidden="true"></span></td>
									<td style="vertical-align:middle">
									<?php  echo substr($testname, 0, -1); ?>  
									</td>
									</tr>

									<tr style="color:darkblue">
									  <td>Total Questions</td>
									  <td><?php echo $disqsnnum; ?></td>
									</tr> 
									  <tr style="color:orange">
									  <td>Attempted <span class="glyphicon glyphicon-ban-arrow" aria-hidden="true"></span></td>
									  <td style="vertical-align:middle"><?php echo $atmpqsn; ?>
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
					 <?php }else{ ?>
					 <h1 style="min-height: 200px;"> User  Unattempted Any Test. Thanks!</h1>
					 <?php } ?>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
<?php include('footer.php'); ?>