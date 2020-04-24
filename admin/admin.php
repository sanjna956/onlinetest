<?php include('header.php'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Dashboard</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="admin.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-xl-4 col-md-6 col-12">
        <div class="info-box bg-green">
          <span class="info-box-icon push-bottom"><i class="ion ion-ios-eye-outline"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Total User</span>
            <?php 
            $result=mysqli_query($db->conn,"SELECT count(*) as total from bk_registration");
            $data=mysqli_fetch_assoc($result);
            ?>
            <span class="info-box-number"><?php echo $data['total']; ?></span>

            <div class="progress">
              <div class="progress-bar" style="width: 40%"></div>
            </div>
            <span class="progress-description">
              40% Increase
            </span>
          </div>
        </div>
      </div>
      <!-- /.col -->
      <div class="col-xl-4 col-md-6 col-12">
        <div class="info-box bg-purple">
          <span class="info-box-icon push-bottom"><i class="fa fa-inr"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Total Test </span>
            <?php 
            $result=mysqli_query($db->conn,"SELECT count(*) as total from bk_test");
            $data=mysqli_fetch_assoc($result);
            ?>
            <span class="info-box-number"><?php echo $data['total']; ?></span>

            <div class="progress">
              <div class="progress-bar" style="width: 85%"></div>
            </div>
            <span class="progress-description">
              85% Increase
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-xl-4 col-md-6 col-12">
        <div class="info-box bg-red">
          <span class="info-box-icon push-bottom"><i class="fa fa-files-o"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Total Enquiry</span>
            <?php 
            $result=mysqli_query($db->conn,"SELECT count(*) as total from bk_contact");
            $data=mysqli_fetch_assoc($result);
            ?>
            <span class="info-box-number"><?php echo $data['total']; ?></span>
            <div class="progress">
              <div class="progress-bar" style="width: 50%"></div>
            </div>
            <span class="progress-description">
              50% Increase
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>
   <!-- /.row -->
</section>
<!-- /.content -->
</div>
<?php include('footer.php'); ?>
