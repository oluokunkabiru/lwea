<?php 
session_start();
include("connection.php");
if(isset($_SESSION['disabled'])){
    $phone = $_SESSION['disabled'];
    $qu = mysqli_query($church, "SELECT* FROM addadmin WHERE phonenumber='$phone'");
    $admin = mysqli_fetch_array($qu);
    $adminarea = $admin['admintype'];
    $adminname = ucwords($admin['firstname']." ". $admin['lastname']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Disabled</title>
    <link rel="stylesheet" href="bootsrap/bootstrap.min.css">
</head>
<body>

<div class="row bg-dark">

<div class="col-md-3"></div>
<div class="col-md-6">
    <div class="container text-dark bg-white" style=" border-radius: 1em; margin:3em 0 3em 0; padding:3em">
        <div class="card rounded">
            <div class="card-header"><h3 class="text-center font-weight-bold text-uppercase">Disabled</h3></div>
            <div class="card-body">
                    <h2 class="text-danger">Dear <?php echo $adminname ?>, you are currently disabled to access this page, please contact admin if you think this is mistake</h2>
                    <div class="text-center mt-3">
                         <a href="../index.php" class="text-center btn btn-primary">Go back to home</a>
                    </div>
            </div>
        </div>
    </div> 
</div>
</div>

<div class="col-md-3">
   
</div>
    
</body>
</html>
<script src="bootsrap/jquery.js"></script>
<script src="bootsrap/popper.js"></script>
<script src="bootsrap/bootstrap.min.js"></script>  
<?php }else{
        header('location:index.php');
} ?>