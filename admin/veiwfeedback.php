<?php 
include("header.php");

  $_HEADING = "View All Our Team Profile";
  $rowsperpage = 200;
   $db1 = $db->conn;
   $website = $_SERVER['PHP_SELF']."?subview=list"; // other arguments if need it.
   $pagination = new CSSPagination($db1, $sql1, $rowsperpage, $website); // create instance object
   $pagination->setPage($_GET['page']);
   if($_REQUEST['status']=="all" || $_REQUEST['status']==""){
     $sql2 = "SELECT * FROM tbl_feedback ORDER BY id DESC LIMIT " . $pagination->getLimit() . ", " . $rowsperpage; 
    
   }
    elseif($_REQUEST['status']!="all" && $_REQUEST['status']!=""){
    $sql2 = "SELECT * FROM tbl_feedback WHERE status = '".$_REQUEST['status']."' ORDER BY id DESC LIMIT " . $pagination->getLimit() . ", " . $rowsperpage; 
	 
	} 
  $result =  mysqli_query($db->conn,$sql2) or die(mysqli_connect_errno()."Data cannot inserted");
  $num_data = mysqli_num_rows($result);
?> 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
     Content Management
   </h1>
   <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="#"><i class="fa fa-files-o"></i>All Feedback</a></li>
  </ol>
  <?php if($_SESSION['services']!=""){ ?>
  <div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <?php echo $_SESSION['services'];$_SESSION['services']="";?>
  </div>
  <?php } ?>
  <?php if($_SESSION['services']!=""){?>
  <div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <?php echo $_SESSION['services'];$_SESSION['services']="";?>
  </div>
  <?php } ?>
</section>
<br>
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Report Data</h3>
    <h6 class="box-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>
    <!--button class="btn btn-primary pull-right" data-target="#add_serv" data-toggle="modal">Add New Our Team</button-->
  </div>
  <!-- /.box-header -->
  <?php if($_REQUEST['subview']=="list") {?>
  <div class="box-body">
   <div class="table-rs" style="overflow-x:auto;">
    <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 table-responsive">
    <thead>
    <tr>
    <th>Sr. No.</th>
    <th>Name</th>
    <th>Email</th>
    <th>Subject</th>
    <th>Feedback</th>
    <th>Action</th>
    </tr>

    </thead>
    <tbody>
     <?php $i=1; while($row = mysqli_fetch_assoc($result)){ ?>
     <tr>
      <td><?php echo $i?></td>
      <td><?php echo $row['name'] ?></td>
      <td><?php echo $row['email'] ?></td>
      <td><?php echo $row['subject'] ?></td>
      <td><?php echo $row['feedback'] ?></td>
       <td>
        <ul class="actions"> 
         
          <li><a href="action/feedback.php?subview=delete&id=<?php echo $row['id'];?>" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a></li>
        </ul>
      </td> 
   </tr>
 
   <?php $i++;}?>
 </tbody>          
 <tfoot>
   <tr>
       <th>Sr. No.</th>
    <th>Name</th>
    <th>Email</th>
    <th>Subject</th>
    <th>Feedback</th>
    <th>Action</th>
  </tr>
</tfoot>
</table>

</div>
</div>
<?php } ?>
<!-- /.box-body -->
</div>
</div>
<?php include('footer.php'); ?>