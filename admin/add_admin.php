<?php
  // include("connection.php");
  session_start();
  include("connection.php");
  if(isset($_SESSION['phonenumber'])){
    $usernumer  =$_SESSION['phonenumber'];
    $qu = mysqli_query($church, "SELECT* FROM addadmin WHERE phonenumber='$usernumer'");
    $admin = mysqli_fetch_array($qu);
    $adminarea = $admin['admintype'];
 //  }

$ife =[];
function test_input($data) 
  {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
  }
$vb =[];
  if ($_SERVER["REQUEST_METHOD"] == "POST") 
      {
      if (empty($_POST["fname"])) {
          $vb[]="Please specify new admin firstname";
        }
      
  

      if (empty($_POST["pnumber"])) {
        $vb[] ="Please provide new admin phone number";

      }

      if (empty($_POST["pswd"])) {
        $vb[] ="Please provide your password";

      }
      if (empty($_POST["cpswd"])) {
        $vb[] ="Please confirmed the new admin password";

      }
      if ($_POST["pswd"] != $_POST["cpswd"]) {
        $vb[] = "password not match and must ";
      }
    if(count($vb)==0) {
        $fname = test_input($_POST["fname"]);
        $pnumber = test_input($_POST["pnumber"]);
        $pswd = md5(test_input($_POST["pswd"]));
        // $cpswd = test_input($_POST["cpswd"]);  
        $admintype ="normal";
        $status = "enabled";
        $new="INSERT INTO addadmin(
          firstname, admintype,phonenumber,password, status) VALUE('$fname', '$admintype','$pnumber','$pswd', '$status')";
          $adten= mysqli_query($church,$new);
          if($adten){
              header("location:manage_admin.php");
          }else{  
                    $vb[] = "The admin not added successfully : <br><b> Causes</b> <br>1 Please check the phone number <br>2 Unique phone number must provide <br>3 Someone already use this phone number <br>4 Contact your server administrator ";
                }

      }
    }
    $adminname = ucwords($admin['firstname']." ". $admin['lastname']);

    $pagetitle = "Add new admin";

include('header.php')
?>
<div class="row bg-dark">
  <div class="col-sm-2"></div>
  <div class="col-sm-8">            
        <h2 class="text-center">Add admin</h2>
        <p class="text-center">Input all required information</p>
        


      <div class="row text-dark bg-white" style=" border-radius: 1em; margin:3em; padding:5em">
          <div class="container">
<?php if(count($vb) > 0){
          foreach ($vb as $error) {
         
          ?>
          <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Error! </strong> <?php echo  $error ?>
          </div>
        <?php } } ?>
            <div class="row">
                <div class="col-md-6">  
            <form onsubmit= "validate()"  name="myForm"  action="add_admin.php" method="post"  class="was-validated">      
              <div class="form-group">
                <label for="fname">First name:</label>
                <input type="text" class="form-control" id="fname" placeholder="Enter admin fullname" name="fname" required>
                <div class="valid-feedback">Correct.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
              </div>

              <div class="form-group">
                <label for="pnumber">Phone Number:</label>
                <input type="number" class="form-control" id="pnumber" placeholder="Enter Phone number" name="pnumber" required>
                <div class="valid-feedback">Correct.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
                </div>
            </div>
                <div class="col-md-6 was-validated">            
                <div class="form-group">
                <label for="pwd">Password:</label>
                <input  onchange= "validate()" type="password" class="form-control" id="pswd" placeholder="Enter password" name="pswd" require>
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
              <!-- <div class="form-group form-check">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="remember" required> I agree on blabla.
                  <div class="valid-feedback">Valid.</div>
                  <div class="invalid-feedback">Check this checkbox to continue.</div>
                </label>
              </div> -->
              <button  class="btn btn-primary">Register</button>
              </form>
        </div>
            </div>
              <!-- <div class="form-group">
                <label for="email">Last name:</label>
                <input type="text" class="form-control" id="email" placeholder="Enter your email" name="email" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
              </div> -->
              <!-- <div class="form-group">
                <label for="uname">Username:</label>
                <input type="text" class="form-control" id="uname" placeholder="Enter username" name="uname" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
              </div> -->
          
    
      </div>
  </div>
  
  <div class="col-sm 2"></div>

</div>

<?php
include("footer.php");
}else{
    header('location:index.php');
  }
  
?>
    <script>
      function validate(){
        var a = document.forms["myForm"]["pswd"].value;
        var b = document.forms["myForm"]["cpswd"].value;
        // var c = document.forms["myForm"]["pnumber"].value;
        // var d = document.forms["myForm"]["uname"].value;
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
        // else{
        //   document.getElementById("pmessage1").innerHTML = "**Password length must not exceed 15 characters"; 
        // }
      }

    </script>
