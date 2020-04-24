<?php  
define('FURL',$_SERVER['DOCUMENT_ROOT']."/tgt/");  
include(FURL."config/common-class.php"); 
//echo "<pre>";print_r($_SESSION['loginuser']['name']);echo "</pre>";
 ?>
<html>
   <head>
      <meta name="viewport" content="width=device-width,initial-scale=1"/>
      <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
      <link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
      <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
      <link href="css/hover.css" rel="stylesheet" type="text/css"/>
      <link href="style.css" rel="stylesheet" type="text/css"/>
      <script src="js/jquery.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script>
         $(document).ready(function(){
         $("#cap").bind("copy cut paste",function(e){
         e.preventDefault();
         alert(" this page do not cut copy paste");
         });
         }); 
      </script> 
   </head>
   <body>
      <div class="col-sm-12" style="">
         <div class="row">
            <div class="col-sm-12" style="background:rgba(255,255,255,.4);padding:0px;">
               <div class="col-sm-12 header">   
				   <div class="col-sm-6 "> 
				     <a href="<?php echo URL;  ?>"><img src="images/logo.png" /></a>
				   </div>
				<div class="col-sm-6 ">
				<?php if(isset($_SESSION['loginuser'])){ ?>
				<span class="pull-right top title1"><span style="color:white"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Hello,</span> <span class="log" style="color:lightyellow"><?php echo $_SESSION['loginuser']['name'];  ?>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="logout.php" style="color:lightyellow"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Logout</a></span></span>				
				<?php }else{?> 
				<a href="registraion.php" class="btn btn-primary logb"> <i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;<span class="title1"><b> Sign Up</b> </span></a>
				<?php }  ?>
				</div>
               </div>
               <!-- close header-->