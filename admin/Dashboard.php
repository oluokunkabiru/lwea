 <?php
//  session_start();
session_start();
include("connection.php");
if(isset($_SESSION['phonenumber'])){
  $usernumer  =$_SESSION['phonenumber'];
  $qu = mysqli_query($church, "SELECT* FROM addadmin WHERE phonenumber='$usernumer'");
  $admin = mysqli_fetch_array($qu);
  $adminarea = $admin['admintype'];
  $adminname = ucwords($admin['firstname']." ". $admin['lastname']);
//  }

$pagetitle = "Dashboard :: $adminname";

include("header.php");

// }
 ?>

    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
         
          <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div> 

    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <?php 
                $blo = mysqli_query($church, "SELECT COUNT(id) AS totalsermon FROM sermon");
                $blog = mysqli_fetch_array($blo);
                $totalsermon = $blog['totalsermon'];
                ?>
                <h3><?= $totalsermon ?></h3>

                <p>Total Sermon</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="msermon.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <?php 
                $blo = mysqli_query($church, "SELECT COUNT(id) AS totaltestimony FROM testimony");
                $blog = mysqli_fetch_array($blo);
                $totaltestimony = $blog['totaltestimony'];
                ?>
                <h3><?= $totaltestimony ?></h3>

                <p>Total testimony</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="testimony.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
              <?php 
                $blo = mysqli_query($church, "SELECT COUNT(id) AS totalevent FROM event");
                $blog = mysqli_fetch_array($blo);
                $totalevent = $blog['totalevent'];
                ?>
                <h3><?= $totalevent ?></h3>

                <p>Total event</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="mevent.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
              <?php 
                $blo = mysqli_query($church, "SELECT COUNT(id) AS totalblog FROM blog");
                $blog = mysqli_fetch_array($blo);
                $totalblog = $blog['totalblog'];
                ?>
                <h3><?= $totalblog ?></h3>

                <p>Total Blog</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="mblog.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->

        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
          <div class="card card-primary card-outline">
              <div class="card-body box-profile">
              

                <h3 class="profile-username text-center"><?php echo $adminname ?></h3>

                <p class="text-muted text-center"><?php echo $admin['phonenumber'] ?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Firstname</b> <a class="float-right"><?php echo ucwords($admin['firstname']) ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Lastname</b> <a class="float-right"><?php echo ucwords($admin['lastname']) ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Username</b> <a class="float-right"><?php echo $admin['username'] ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Phone Number</b> <a class="float-right"><?php echo $admin['phonenumber'] ?></a>
                  </li>
                </ul>

                <a href="admin_profile_completion.php" class="btn btn-primary btn-block">Update details<b></b></a>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <div class="col-md-2"></div>
        </div>
    </section>
    
  </div>



<?php
  include("footer.php");
}else{
  header('location:index.php');
}
?>