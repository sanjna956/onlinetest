<?php 
include('header.php');
if(!isset($_SESSION['loginuser'])){
	header("Location:".URL); 
}
$result=$db->AllData('bk_test'); 
//echo "<pre>";print_r($_SESSION);echo "</pre>";
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
            <li><a href="profile.php"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp;My History</a></li>
            
         </ul>
      </div>
   </div>
</nav>
<div class="main bg">
   <div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="well well-sm" style="background: #fff;min-height: 350px;">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <h4><span>Name : </span><?php echo $_SESSION['loginuser']['name']; ?></h4>
                        <h4><span>Email : </span><?php echo $_SESSION['loginuser']['email']; ?></h4>
                        <h4><span>Contact : </span><?php echo $_SESSION['loginuser']['mobile']; ?></h4>
                        <h4><span>Address : </span><?php echo $_SESSION['loginuser']['address']; ?></h4>
                        <h4><span>Company : </span><?php echo $_SESSION['loginuser']['company']; ?></h4>
                        <h4><span>Experience : </span><?php echo $_SESSION['loginuser']['experience']; ?></h4>
                        <h4><span>Gender : </span><?php echo $_SESSION['loginuser']['gender']; ?></h4>
                        <h4><span>DOB : </span><?php echo $_SESSION['loginuser']['dob']; ?></h4>
                        <!-- Split button -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
   <!-- ./container -->
</div>
<?php include_once "footer.php";  ?>