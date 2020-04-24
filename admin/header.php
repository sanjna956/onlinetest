<?php 
include("connection.php");
if($_SESSION['admin_id']!='')
{
  $admin = new Common();
  $admin_details = $admin->GetUserDetails($_SESSION['admin_id']);
}
else
{
 echo "<script>window.location.href='index.php'</script>"; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="images/favicon.ico">
  <title></title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
  <!-- Bootstrap 4.0-->
  <link rel="stylesheet" href="assets/vendor_components/bootstrap/dist/css/bootstrap.css">
  <!-- Bootstrap 4.0-->
  <link rel="stylesheet" href="assets/vendor_components/bootstrap/dist/css/bootstrap-extend.css">
  <!-- font awesome -->
  <link rel="stylesheet" href="assets/vendor_components/font-awesome/css/font-awesome.css">
  <!-- ionicons -->
  <link rel="stylesheet" href="assets/vendor_components/Ionicons/css/ionicons.css">
  <!-- theme style -->
  <link rel="stylesheet" href="css/master_style.css">
  <!-- fox_admin skins. choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="css/skins/_all-skins.css">
  <!-- weather weather --> 
  <link rel="stylesheet" href="assets/vendor_components/weather-icons/weather-icons.css">
  
  <!-- date picker -->
  <link rel="stylesheet" href="assets/vendor_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="assets/vendor_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css">
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
</head>
<body class="hold-transition skin-blue sidebar-mini"> 
  <div class="wrapper">
    <header class="main-header">
      <!-- Logo -->
      <a href="#" class="logo"></a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">     
      <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <img src="<?php echo URL; ?>images/avatar.png" class="user-image rounded-circle" alt="Image">
        </a>
        <ul class="dropdown-menu scale-up">
          <li class="user-footer">
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-block btn-danger">Log out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="image float-left">
          <img src="<?php echo URL; ?>images/logo.png" class="rounded" alt="Logo">
        </div> 
      </div>
      <ul class="sidebar-menu" data-widget="tree">        
        <li class="header">Main Menu</li>
        <li class="active">
          <a href="admin.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
		<li><a href="testview.php?subview=list"><i class="fa fa-clipboard"></i>Veiw Test</a></li>
		<li><a href="veiwquestion.php?subview=list"><i class="fa fa-file"></i>Veiw Question</a></li>	
		<li><a href="all_student.php?subview=list"><i class="fa fa-user"></i>All Users</a></li> 
		
		<li><a href="veiwfeedback.php?subview=list"><i class="fa fa-user"></i>Veiw Feedback</a></li> 		 
       
    </ul>
  </section>
</aside>
