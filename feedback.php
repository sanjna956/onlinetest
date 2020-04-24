 <?php include('header.php'); ?>
<style>
*[role="form"] {
    max-width: 700px;
    padding: 15px;
    margin: 0 auto;
    border-radius: 0.3em;
    background-color: #f2f2f2;
}
.panel-heading {
    text-align: center;
}
.form-horizontal .control-label { 
    text-align: left;
}
textarea::-webkit-input-placeholder{
color:#000;
}
.top {
    margin-top: 20px;
}  
</style>
<!------ Include the above in your HEAD tag ---------->
<div class="main">
<div class="container"> 
             <div class="panel-heading"> <h1 style="margin-top: 80px !important;"><b>FEEDBACK</b></h1></div> 
            <form class="form-horizontal" role="form" action="action/feedback.php" method="post">
			<center class="red"><?php  if(isset($_SESSION['error'])){ echo $_SESSION['error']; } ?></center>
                <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label"> Name</label>
                    <div class="col-sm-9">
                        <input type="text" name="name" id="firstName" placeholder=" Name" class="form-control"  required value="<?php if(isset($_POST['name'])){ echo $_POST['name']; } ?>" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email </label>
                    <div class="col-sm-9">
                        <input type="email" id="email" placeholder="Email" class="form-control" name= "email" required value="<?php if(isset($_POST['email'])){ echo $_POST['email']; } ?>"> 
                    </div>
                </div>
				<div class="form-group">
                    <label for="experience" class="col-sm-3 control-label">Subject</label>
                    <div class="col-sm-9">
                        <input type="text" id="experience" placeholder="Enter short description of your feedback" class="form-control" name="subject" value="<?php if(isset($_POST['subject'])){ echo $_POST['subject']; } ?>" required>
                    </div>
                </div>
			  <div class="form-group">
			        <div class="col-sm-12 control-label" style="margin-bottom:10px;"><b>Write feedback here.Keep it clean and simple.</b></div>
                    <div class="col-sm-12 ">
                      <textarea rows="10" id="address" class="form-control" name="feedback" required> <?php if(isset($_POST['feedback'])){ echo $_POST['feedback']; } ?></textarea>
                    </div>
                </div>
				<div class="form-group">                    
				<div class="row">
				<div class="col-sm-3"></div>
                <div class="col-sm-3">
				<button type="submit" class="btn btn-primary btn-block">Send My Feedback</button>
				</div>
				</div>
				</div>
            </form> <!-- /form -->
        </div> <!-- ./container -->
		</div>
		<?php include_once "footer.php";  ?>