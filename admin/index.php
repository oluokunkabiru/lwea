<?php 
session_start();

  //  $server = "localhost";
  //  $user = "root";
  //  $password = "";
  //  $dbname = "lwea";
  //  $church= mysqli_connect($server,$user,$password,$dbname);

    // $_SESSION['timestamp']= time();
    // $_SESSION['logined']=true;
include("connection.php");

    function test_input($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    // $wefarm = "adten001";
    // $now = md5($wefarm);
    //  echo $now;
    $ife =[];
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
        {
        if (empty($_POST["pnumber"])) {
            $titleErr = "Title is required";
            $ife[]="please enter correct phone number";
          } else {
            $title = test_input($_POST["pnumber"]);

        }
        
        if (empty($_POST["pwd"])) {
            $commentErr = "password is required";
            $ife[] ="check your password";

          } else {
            $comment = test_input($_POST["pwd"]);
        }
        if(count($ife)==0) {
          $number = test_input($_POST["pnumber"]);
          $pass = test_input($_POST["pwd"]);
          // echo "Email $email";
          $select= "SELECT * FROM addadmin WHERE phonenumber = '$number'";
          $fselect = mysqli_query($church,$select);

         $qData= mysqli_fetch_array($fselect);
         $username  = isset($qData['username'])?$qData['username']:"";
        //  print_r($qData);
         $databasePassword = !empty($qData['password'])?$qData['password']:"";
         $status = !empty($qData['status'])?$qData['status']:"";
        //  echo "password = ".  $databasePassword;
// echo "Status  = $status";
        if(!empty($databasePassword)){
          if($databasePassword == md5($pass)){
            // echo "Username $username";
            if(empty($username)){
              $_SESSION['completeregistration'] = $number;
              header("location:admin_profile_completion.php");
            }elseif($status=="disabled"){
              $_SESSION['disabled'] = $number;
              header("location:admin_disabled.php");
            }else{
              $_SESSION['phonenumber']=$number;
            header('location:Dashboard.php');
            }
            
          }else{
            echo "Incorrect username or password";
          }
        }else{
          echo "User with this details not found";
        }
        }
      }
    //  if {
       # code...
      
    //  }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog login</title>
    <link rel="stylesheet" href="bootsrap/bootstrap.min.css">
</head>
<body>

<div class="row bg-dark d-flex">

<div class="col-md-1"></div>
<div class="col-xs-6">
<div class="container text-dark bg-white" style=" border-radius: 1em; margin:3em; padding:3em">
     <h2>Log in</h2>
        <form class="form-horizontal"action="index.php" method="post" >
            <div class="form-group">
            <label class="control-label col-sm-2" for="email">phone Number:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="email" placeholder="Enter your Phonenumber" name="pnumber">
            </div>
            </div>
            <div class="form-group">
            <label class="control-label col-sm-2" for="pwd">Password:</label>
            <div class="col-sm-10">          
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
            </div>
            </div>
            <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                <label><input type="checkbox" name="remember"> Remember me</label>
                </div>
            </div>
            </div>
            <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Log in</button>
            </div>
            </div>
        </form>
    </div> 
</div>
</div>

<div class="col-sm-3 m10">
   
</div>
    
</body>
</html>
<script src="bootsrap/jquery.js"></script>
<script src="bootsrap/popper.js"></script>
<script src="bootsrap/bootstrap.min.js"></script>  