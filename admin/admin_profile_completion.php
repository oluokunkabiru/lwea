<?php 
 session_start();
 include("connection.php");
 if(isset($_SESSION['completeregistration'])){
   $usernumer  =$_SESSION['completeregistration'];
   $qu = mysqli_query($church, "SELECT* FROM addadmin WHERE phonenumber='$usernumer'");
   $admin = mysqli_fetch_array($qu);
   $adminarea = $admin['admintype'];
   $adminname = ucwords($admin['firstname']." ". $admin['lastname']);
//  }

  $ife =[];
  function test_input($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
        {
        if (empty($_POST["fname"])) {
            $titleErr = "Title is required";
            $ife[]="title error";
          } else {
            $title = test_input($_POST["fname"]);

        }
        
        if (empty($_POST["lname"])) {
            $commentErr = "comment is required";
            $ife[] ="comment here";

          } else {
            $comment = test_input($_POST["lname"]);

        }
        if (empty($_POST["uname"])) {
          $commentErr = "comment is required";
          $ife[] ="comment here";

        } else {
          $comment = test_input($_POST["uname"]);

        }

        if (empty($_POST["pnumber"])) {
          $commentErr = "comment is required";
          $ife[] ="comment here";

        } else {
          $comment = test_input($_POST["pnumber"]);

        }

        if (empty($_POST["pswd"])) {
          $commentErr = "comment is required";
          $ife[] ="comment here";

        } else {
          $comment = test_input($_POST["pswd"]);

        }
    

      if(count($ife)==0) {
          $fname = test_input($_POST["fname"]);
          $lname = test_input($_POST["lname"]);
          $uname = test_input($_POST["uname"]);
          $pnumber = test_input($_POST["pnumber"]);
          $pswd = test_input($_POST["pswd"]);
          $cpswd = test_input($_POST["cpswd"]);       
        }
        
        if ($pswd != $cpswd) {
          echo "password not match and must ";
        }
        else {
            $new= mysqli_query($church,"UPDATE addadmin set firstname='$fname', lastname='$lname', username='$uname',  phonenumber='$pnumber', password='$pswd' WHERE phonenumber= $number");

            if($new){
                $_SESSION['phonenumber']=$number;
                header('location:Dashboard.php');
            }
            else{  
                echo"not properly inserted".mysqli_error($church);
            }
        }
       
      }

      $pagetitle = "Admin profile completion";


      // include('header.php')

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Update Profile</title>
    <link rel="stylesheet" href="bootsrap/bootstrap.min.css">
    <script>
      function validate(){
        var a = document.forms["myForm"]["pswd"].value;
        var b = document.forms["myForm"]["cpswd"].value;
        var c = document.forms["myForm"]["pnumber"].value;
        var d = document.forms["myForm"]["uname"].value;
        if (a != b) {
          document.getElementById("cpmessage2").innerHTML= "passwords do not match";
          return false;
        }

        if (a.length < 8 ) {
          document.getElementById("pmessage1").innerHTML = "Password length must be at least 8 characters";
          return false;
        }

        if (a.length > 15) {
          document.getElementById("pmessage1").innerHTML = "**Password length must not exceed 15 characters";  
          return false;
        }
        else{
          document.getElementById("pmessage1").innerHTML = "**Password length must not exceed 15 characters"; 
        }
      }

    </script>
</head>
<body>
<div class="container-fluid" style=" border-radius: 1em;  padding:1em">

<div class="row bg-dark">
  <div class="col-sm-1"></div>
  <div class="col-sm-10">
      <div class="row text-dark bg-white" style=" border-radius: 1em; margin:3em; padding:5em">
      <div class="container text-center">
      <h2>Update your profile to proceed</h2>
            <p>Input all required information</p>
            <p>Note: Information provided here will be used for your login henceforth</p>
      </div>
        <div class="col-sm-6">
          <div class="container">
            <form onsubmit= "validate()"  name="myForm"  action="admin_profile_completion.php" method="post"  class="was-notvalidated">      
              <div class="form-group">
                <label for="fname">Firstname:</label>
                <input type="text" class="form-control" id="fname" placeholder="Enter your firstname" name="fname" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
              </div>
              <div class="form-group">
                <label for="email">Last name:</label>
                <input type="text" class="form-control" id="email" placeholder="Enter your lastname" name="lname" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
              </div>
              <div class="form-group">
                <label for="uname">Username:</label>
                <input type="text" class="form-control" id="uname" placeholder="Enter username" name="uname" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
              </div>
          </div>
        </div>
        <div class="col-sm-6 was-notvalidated">
            <div class="form-group">
                <label for="pnumber">Phone Number:</label>
                <input type="tel" class="form-control" id="pnumber" placeholder="Enter Phone number" name="pnumber" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input  onchange= "validate()" type="password" class="form-control" id="pswd" placeholder="Enter password" name="pswd" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback" >Please fill out this field.</div>
                <span id = "pmessage1" style="color:red"> </span> 
              </div>
              <div class="form-group">
                <label for="cpwd">confirm Password:</label>
                <input onchange= "validate()" type="password" class="form-control" id="cpswd" placeholder="Confirm password" name="cpswd" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
                <span id = "cpmessage2" style="color:red"> </span> 
              </div>
              <div class="form-group form-check">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="remember" required> I agree on blabla.
                  <div class="valid-feedback">Valid.</div>
                  <div class="invalid-feedback">Check this checkbox to continue.</div>
                </label>
              </div>
              <button  class="btn btn-primary">Update</button>
              </form>
              
    
        </div>
      </div>
  </div>
  
  <div class="col-sm 1"></div>

</div>
         
</body>
</html>
<?php
    }else{
        header('location:index.php');
      }
      
?>
<script src="bootsrap/jquery.js"></script>
<script src="bootsrap/popper.js"></script>
<script src="bootsrap/bootstrap.min.js"></script>  

