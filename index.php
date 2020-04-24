<?php include_once "header.php"; 
   //echo "<pre>";print_r($_SESSION);echo "</pre>"; die();  
?>
<style>
.top {
    margin-top: 20px;
}  
</style>
<!-- main--> 
<div class="col-sm-12" style="padding:0px;">
   <div class="col-sm-6 col-xs-12 left">
      <div class="col-sm-1"></div>
      <div class="col-sm-9 login" style="padding:0px;">
         <div class="col-sm-12 log1">
         </div>
         <div class="col-sm-12 log2"  style="padding:0px;" >
            <div class="col-sm-12 user">
			<center class="red"><?php  if(isset($_SESSION['msg'])){ echo $_SESSION['msg']; } ?></center>
               <center>
                  <h2>
                     Login here <i class="fa fa-hand-o-down" aria-hidden="true"></i>
                  </h2>
               </center>
            </div>
         </div>
         <div class="col-sm-12 log3">
            <div class="col-sm-12">
               <center>
                  <!--login form open--->
                  <form action="action/login.php" method="post"> 
                     <br>  
                     <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">
                        <i class="fa fa-envelope" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" placeholder="Username or Id" aria-describedby="basic-addon1" name="email" required >
                     </div>
                     <br>
                     <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">
                        <i class="fa fa-lock" aria-hidden="true"></i> 
                        </span>
                        <input type="password" class="form-control" placeholder="Password" aria-describedby="basic-addon1" name="password" required />
                     </div>
                     <input type="submit" value="login" class="btn loginbutton btn-primary" class="form-control;" style="margin-top:10px;" /><br><br>
                     <a href="registraion.php" style="text-decoration:none; font-family:century;">
                     <span class="glyphicon glyphicon-pencil"></span> New registration </a>&nbsp;&nbsp;<span style="color:#f6b363;">|</span> &nbsp;&nbsp;
                     <a href="forgotpass.php" style="text-decoration:none; font-family:century;"> <i class="fa fa-lock" aria-hidden="true"></i> Forgot password</a>
                     <br>
            </div>
            </form></center><!--close  form--> 
         </div>
      </div>
   </div>
   <!--close  left div-->
   <!--open  div rigth-->
   <div class="col-sm-6 right" style="padding:0px;font-family:Century;font-size:35px;">
      <!-- righ div-->
      <span style="font-size:35px;"> <span style="color:#f6ad1a;font-size:45px;">W</span>elcome <span style=" color:#f6ad1a;font-size:45px;">T</span>o <span style=" color:#f6ad1a;font-size:45px;">O</span>line <span  style="color:#f6ad1a;font-size:45px;">T</span>est</span></span>
      <br>
      <p></p>
      <b><span style="color:#2e5783;font-size:23px;margin-left:10%;font-family:Monotype Corsiva;text-shadow:none;">
      Trinity Global Tech Inc (TGT)</span></b>...&nbsp;
      <div class="col-sm-12" style="padding:0px;">
         <div class="col-sm-10">
            <div class="col-sm-12" style="">
               <div class="col-sm-9" style="border:5px solid #eeedf2;min-height:150px;margin-top:40px;border-radius:25px 25px 25px 25px;box-shadow:2px 2px 3px;text-align:center;">
                  <span style="font-size:19px;text-shadow:none;">Trinity Global Tech Inc (TGT) is an IT consulting company based in Dublin, OH. We provide a number of IT Staffing solutions to various industries.</span>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!--colse div righ-->
</div>
<!--main-->
<div class="col-sm-12 ftr" style="min-height:27px;"></div>
<?php include_once "footer.php";  ?>