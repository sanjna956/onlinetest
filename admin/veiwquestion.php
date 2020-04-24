<?php 
include("header.php");
if($_REQUEST['subview']=="add")
 $_HEADING = "Add New Questions Profile";
else if($_REQUEST['subview']=="update")
{
  $_HEADING = "Update Questions Profile";  
  $query = "SELECT * FROM bk_question WHERE id='".$_REQUEST['id']."'";
  $get_offer =  mysqli_query($db->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
  $offer = mysqli_fetch_assoc($get_offer);
}
else if($_REQUEST['subview']=="list")
{
 $_HEADING = "View All Questions Profile";
 $rowsperpage = 2000;
 if($_REQUEST['status']=="all" || $_REQUEST['status']=="")
   $sql1 = "SELECT * FROM bk_question ORDER BY id DESC ";
 elseif($_REQUEST['status']!="all" && $_REQUEST['status']!="")
   $sql1 = "SELECT * FROM bk_question WHERE status = '".$_REQUEST['status']."' ORDER BY id DESC ";
   $db1 = $db->conn;
   $website = $_SERVER['PHP_SELF']."?subview=list"; // other arguments if need it.
   $pagination = new CSSPagination($db1, $sql1, $rowsperpage, $website); // create instance object
   $pagination->setPage($_GET['page']);
   if($_REQUEST['status']=="all" || $_REQUEST['status']=="")
     $sql2 = "SELECT * FROM bk_question ORDER BY id DESC LIMIT " . $pagination->getLimit() . ", " . $rowsperpage; 
   elseif($_REQUEST['status']!="all" && $_REQUEST['status']!="")
    $sql2 = "SELECT * FROM bk_question WHERE status = '".$_REQUEST['status']."' ORDER BY id DESC LIMIT " . $pagination->getLimit() . ", " . $rowsperpage; 
  $result =  mysqli_query($db->conn,$sql2) or die(mysqli_connect_errno()."Data cannot inserted");
  $num_data = mysqli_num_rows($result);
}
?> 
<style>
.modal-content {
    width: 800px;
}   
.modal-body {
    padding: 15px 20px;
} 
</style>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Questions Management
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="breadcrumb-item"><a href="#"><i class="fa fa-files-o"></i> Questions Management</a></li>
        <li class="breadcrumb-item active">Edit Questions</li>
      </ol>
      <?php if($_SESSION['Questions']!=""){ ?>
  <div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <?php echo $_SESSION['Questions'];$_SESSION['Questions']="";?>
  </div>
  <?php } ?>
  <?php if($_SESSION['Questions']!="") { ?>
  <div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <?php echo $_SESSION['Questions'];$_SESSION['Questions']="";?>
  </div>
  <?php } ?>
    </section>
<br>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Report Data</h3>
              <h6 class="box-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>
              <button class="btn btn-primary pull-right" data-target="#add_cat" data-toggle="modal">Add New Questions</button>
            </div>
            <!-- /.box-header -->
            <?php if($_REQUEST['subview']=="list") {?>
            <div class="box-body">
             <div class="table-rs">
              <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 table-responsive">
        <thead>
          <tr>
            <th>Sr. No.</th>
            <th>Questions</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
         <?php $i=1; while($row = mysqli_fetch_assoc($result)){?>
          <tr>
            <td><?php echo $i?></td>
            <td><?php echo $row['title']; ?></td>
            <td>
                        <ul class="actions">
                          <li><a href="?subview=update&id=<?php echo $row['id'];?>" data-target="#<?php echo $row['id'];?>" data-toggle="modal" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a></li>
                            <li><a href="action/question_deatils.php?subview=delete&id=<?php echo $row['id'];?>" title="Delete Gallery"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                        </ul>
                       </td>
          </tr>
          <div id="<?php echo $row['id']; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Questions</h4>
      </div>
       <form action="action/question_deatils.php?subview=update&id=<?php echo $row['id'];?>" method="post" enctype="multipart/form-data">
      <div class="modal-body">
       <div class="form-group">
           <div class="row">
            <div class="col-sm-12">
            <h5>Test Name<span class="text-danger">*</span></h5>
            <div class="controls">
			<select class="form-control" name="testid" id="testid" required>
			<option value=''>--Select Test Name--</option>
			<?php
			$query1= "SELECT * FROM bk_test  ORDER BY title"; 
			$result1 =  mysqli_query($db->conn,$query1) or die(mysqli_connect_errno()."Data cannot inserted");
			$testid= $row['test_id'];
			while($datarow=mysqli_fetch_array($result1))
			{
				if($datarow[0]==$testid)
				{
				echo "<option value='$datarow[0]' selected>$datarow[2]</option>";
				}
				else
				{
				echo "<option value='$datarow[0]'>$datarow[2]</option>";
				}
			}
			?>
			</select>  
			  </div>
            </div>              
			<div class="col-sm-12">
            <h5>Question<span class="text-danger">*</span></h5>
            <div class="controls">
			<textarea cols="15" rows="4" name="addque" class="form-control ckeditor" id="editor1" ><?php echo $row['title']?></textarea>
              
			  </div>
            </div>            
			<div class="col-sm-12">
            <h5>Answer1<span class="text-danger">*</span></h5>
            <div class="controls">
              <input type="text" name="ans1" class="form-control" value="<?php echo $row['ans1']?>"> 
			  </div>
            </div> 			
			<div class="col-sm-12">
            <h5>Answer2<span class="text-danger">*</span></h5>
            <div class="controls">
              <input type="text" name="ans2" class="form-control" value="<?php echo $row['ans2']?>"> 
			  </div>
            </div> 			<div class="col-sm-12">
            <h5>Answer3<span class="text-danger">*</span></h5>
            <div class="controls">
              <input type="text" name="ans3" class="form-control" value="<?php echo $row['ans3']?>"> 
			  </div>
            </div> 			<div class="col-sm-12">
            <h5>Answer4<span class="text-danger">*</span></h5>
            <div class="controls">
              <input type="text" name="ans4" class="form-control" value="<?php echo $row['ans4']?>"> 
			  </div>
            </div> 			
			<div class="col-sm-12">
            <h5> True Answer<span class="text-danger">*</span></h5>
            <div class="controls">
				<select id="ans1" name="anstrue" placeholder="Choose correct answer " class="form-control" required>
				<option value="">--Select answer for question--</option>
				<option value="1" <?php if($row['true_ans']==1){ echo "selected"; }?>>option a</option>
				<option value="2" <?php if($row['true_ans']==2){ echo "selected"; }?>>option b</option>
				<option value="3" <?php if($row['true_ans']==3){ echo "selected"; }?>>option c</option>
				<option value="4" <?php if($row['true_ans']==4){ echo "selected"; }?>>option d</option> </select>  
			  </div>
            </div>  
              <div class="col-sm-12">
                <h5> <label for="discount">Image only upload(260*154)</label><span class="text-danger">*</span></h5>
                <div class="controls">
                  <div class="form-group">
                    <?php if($row['image']!=""){?>      
                    <img src="gallery/<?php echo $row['image']?>" height="100" width="100"/>
                    <?php } ?>
                  </div>
                  <div class="form-group">
                 
                    <input type="file" class="form-control" name="image" id="image"/>
                  </div> </div>
                </div>		
           </div>
          </div>
          </div>
      <div class="modal-footer">
       <button type="submit" class="btn btn-primary">Update Questions</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>
          <?php $i++;} ?>
        </tbody>
        <tfoot>
          <tr>
           <th>Sr. No.</th>
            <th>Questions</th>
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
  <!-- Modal -->
<div id="add_cat" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Questions</h4>
      </div>
        <form action="action/question_deatils.php?subview=add" method="post" enctype="multipart/form-data">
      <div class="modal-body">
       <div class="form-group">
           <div class="row">
            <div class="col-sm-12">
  <table class="table table-striped">
    <tr>
      <td width="24%" height="32"><div align="left"><strong>Select Test Name </strong></div></td>
      <td width="1%" height="5">  
      <td width="75%" height="32">
	  <select class="form-control" name="testid" id="testid" required>
	  <option value=''>--Select Test Name--</option>
        <?php
		$query= "SELECT * FROM bk_test  ORDER BY title"; 
		$result =  mysqli_query($db->conn,$query) or die(mysqli_connect_errno()."Data cannot inserted");
        while($row=mysqli_fetch_array($result))
        {
          echo "<option value='$row[0]'>$row[2]</option>";
        }
        ?>
      </select>       
    <tr>
        <td height="26"><div align="left"><strong> Enter Question </strong></div></td>
        <td>&nbsp;</td>
	    <td>
		<textarea cols="15" rows="4" name="addque" class="form-control ckeditor" id="editor1" ></textarea>
    </tr>  
    <tr>
      <td height="26"><div align="left"><strong>Enter option a </strong></div></td>
      <td>&nbsp;</td>
      <td><input class="form-control" name="ans1" type="text" id="ans1" required></td>
    </tr>
    <tr>
      <td height="26"><strong>Enter option b </strong></td>
      <td>&nbsp;</td>
      <td><input class="form-control" name="ans2" type="text" id="ans2" required></td>
    </tr>
    <tr>
      <td height="26"><strong>Enter option c </strong></td>
      <td>&nbsp;</td>
      <td><input class="form-control" name="ans3" type="text" id="ans3" ></td>
    </tr>
    <tr>
      <td height="26"><strong>Enter option d</strong></td>
      <td>&nbsp;</td>
      <td><input class="form-control" name="ans4" type="text" id="ans4" ></td>
    </tr>
    <tr>
      <td height="26"><strong>Select  Answer </strong></td>
      <td>&nbsp;</td>
      <td>
		<select id="ans1" name="anstrue" placeholder="Choose correct answer " class="form-control" required>
		<option value="">--Select answer for question--</option>
		<option value="1">option a</option>
		<option value="2">option b</option>
		<option value="3">option c</option>
		<option value="4">option d</option> </select> 
	  </td>
    </tr>
  </table>
	<div class="col-sm-12">
	<h5>Select Gallery Image (Use Only 260*154 image size)<span class="text-danger">*</span></h5>
	<div class="controls">
	<input type="file" class="form-control" name="image" id="image"/>
	</div>
	</div>
            </div>
           
           </div>
          </div>
          </div>
      <div class="modal-footer">
       <button type="submit" class="btn btn-primary">Add  Questions</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>
  <?php include('footer.php'); ?>
 