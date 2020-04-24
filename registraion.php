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
</style>
<!------ Include the above in your HEAD tag ---------->
<div class="main">
<div class="container">
             <div class="panel-heading"> <h1><span class="fa fa-user-plus"></span><b>Sign Up</b></h1></div> 
            <form class="form-horizontal" role="form" action="action/registration.php" method="post">
			<center class="red"><?php  if(isset($_SESSION['error'])){ echo $_SESSION['error']; } ?></center>
                <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label"> Name</label>
                    <div class="col-sm-9">
                        <input type="text" name="name" id="firstName" placeholder=" Name" class="form-control"  required value="<?php if(isset($_POST['name'])){ echo $_POST['name']; } ?>" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email* </label>
                    <div class="col-sm-9">
                        <input type="email" id="email" placeholder="Email" class="form-control" name= "email" required value="<?php if(isset($_POST['email'])){ echo $_POST['email']; } ?>"> 
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Password*</label>
                    <div class="col-sm-9">
                        <input type="password" name="password" id="password" placeholder="Password" class="form-control" pattern=".{8,}" title="Eight or more characters" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="birthDate" class="col-sm-3 control-label">Date of Birth*</label>
                    <div class="col-sm-9">
                        <input type="date" name="dob" id="birthDate" class="form-control" required value="<?php if(isset($_POST['dob'])){ echo $_POST['dob']; } ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="phoneNumber" class="col-sm-3 control-label">Phone number </label>
                    <div class="col-sm-9">
                        <input type="phoneNumber" name="phonenumber" id="phoneNumber" placeholder="Phone number" class="form-control" pattern="[0-9]{10}" value="<?php if(isset($_POST['phonenumber'])){ echo $_POST['phonenumber']; } ?>" required>
                    </div> 
                </div>
			 <div class="form-group">
                    <label for="address" class="col-sm-3 control-label">Address</label>
                    <div class="col-sm-9">
                        <textarea  id="address" placeholder="Year of experience" class="form-control" name="address" required> <?php if(isset($_POST['address'])){ echo $_POST['address']; } ?></textarea>
                    </div>
                </div>
				<div class="form-group">
                    <label for="experience" class="col-sm-3 control-label">Year of experience</label>
                    <div class="col-sm-9">
                        <input type="text" id="experience" placeholder="Year of experience" class="form-control" name="experience" value="<?php if(isset($_POST['experience'])){ echo $_POST['experience']; } ?>" required>
                    </div>
                </div>
				<div class="form-group">
                    <label for="qualification" class="col-sm-3 control-label">Heights Qualification</label>
                    <div class="col-sm-9">
					    <select name="qualification" class="form-control" placeholder="Heights Qualification" required>
						<option value="">--select here--</option>
						<option value="bca" <?php if(isset($_POST['qualification'])=='bca'){ echo 'selected'; } ?>>BCA</option>
						<option value="mca" <?php if(isset($_POST['qualification'])=='mca'){ echo 'selected'; } ?>>MCA</option>
						<option value="betch" <?php if(isset($_POST['qualification'])=='betch'){ echo 'selected'; } ?>>B.TECH</option>
						<option value="mtech" <?php if(isset($_POST['qualification'])=='mtech'){ echo 'selected'; } ?>>M.TECH</option>
						<option value="others" <?php if(isset($_POST['qualification'])=='others'){ echo 'selected'; } ?>>OTHRES</option>
						</select>
                    </div>
                </div>
				<div class="form-group">
                    <label for="companyname" class="col-sm-3 control-label">Previous company name </label>
                    <div class="col-sm-9">
                        <input type="text" id="companyname" placeholder="Previous company name" class="form-control"  value="<?php if(isset($_POST['companyname'])){ echo $_POST['companyname']; } ?>" name="companyname" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Gender</label>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="radio-inline">
                                    <input type="radio" id="femaleRadio" value="Female" required name="gender" <<?php if(isset($_POST['gender'])=='Female'){ echo 'selected'; } ?>>Female 
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="radio-inline">
                                    <input type="radio" id="maleRadio"  name="gender" value="Male" required <?php if(isset($_POST['gender'])=='Male'){ echo 'selected'; } ?>>Male
                                </label>
                            </div>
                        </div>
                    </div>
                </div> <!-- /.form-group -->
				<div class="form-group">                   
				<div class="row">
				<div class="col-sm-3"></div>
                <div class="col-sm-3">
				<button type="submit" class="btn btn-primary btn-block">Register</button>
				</div>
				</div>
				</div>
            </form> <!-- /form -->
        </div> <!-- ./container -->
		</div>
		<?php include_once "footer.php";  ?>