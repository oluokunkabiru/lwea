<?php  
// include("connection.php");
session_start();
include("connection.php");
if(isset($_SESSION['phonenumber'])){
  $usernumer  =$_SESSION['phonenumber'];
  $qu = mysqli_query($church, "SELECT* FROM addadmin WHERE phonenumber='$usernumer'");
  $admin = mysqli_fetch_array($qu);
  $adminarea = $admin['admintype'];
  $success=$fail="";
//  }

$lwea=[];
  function test_input($data) 
  {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
  }

  if (isset($_POST['addevent'])) {
    if (empty($_POST["eventTopic"])) {
      $lwea['eventTopic']="please enter a topic ";
    } else {
      $title = test_input($_POST["eventTopic"]);
    }
    
    if (empty($_POST["calendar"])) {
      $lwea['calendar']="kindly choose the date of the event";
    } else {
      $calender = test_input($_POST["calendar"]);
    }

    if (empty($_POST["venue"])) {
      $lwea['venue']="kindly enter the Venue";
    } else {
      $venue = test_input($_POST["venue"]);
    }

    if (empty($_POST["comment"])) {
      $lwea['comment']="why not tell us about the event";
    } else {
      $comment = test_input($_POST["comment"]);
    }
    $target_dir = "pictures/";
    if ($_FILES["InputFile"]["size"] > 0) {
      $target_file = $target_dir . time(). basename($_FILES["InputFile"]["name"]);
      // echo $target_file;
      $check = getimagesize($_FILES["InputFile"]["tmp_name"]);
        if($check == false) {
            $lwea['image']= "File is not an image.";
        } 
        if ($_FILES["InputFile"]["size"] > 500000) {
          $lwea['image']= "Sorry, your file is too large.";
        
      }
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
        $lwea['image']= "Sorry, only JPG, JPEG & PNG  files are allowed.";
        }

        if (count($lwea)==0) {
          move_uploaded_file($_FILES["InputFile"]["tmp_name"], $target_file);
          
      } else{
        $lwea['image']="Please fill the required areas above";
      }


    }else{
      $lwea['image'] = "Please select sermon image";
    }

// foreach ($lwea as $value) {
//   # code...
//   echo "$value <br>";
// }
    if (count($lwea) ==0) {
      $title = test_input($_POST["eventTopic"]);
      $calendar = test_input($_POST["calendar"]) ;
      $venue = test_input($_POST["venue"]);
      $comment = test_input($_POST["comment"]);
    
      $new="INSERT INTO event(Title,Date,Venue,About,Pictures) VALUE ('$title','$calendar','$venue','$comment','$target_file')";
      $adten= mysqli_query($church,$new);
       if($adten){
        // header("location:mevent.php");
        $success = "Event added successfully";
  
      }
      else{
        $fail = "Fail to create event ".mysqli_error($church);
      }
        }

     
    
  }
  $pagetitle = "Add new event";
  $adminname = ucwords($admin['firstname']." ". $admin['lastname']);

  include('header.php')

?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-9">
            <h1>Add New Event</h1>
          </div>
          <div class="col-sm-3">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="Dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Add New Event</li>
            </ol>
          </div>
        </div>
        <?php
        if(isset($success) && !empty($success)){
        ?>
        <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success!</strong> <?php echo  $success ?>
      </div>
        <?php } ?>

        <?php
        if(isset($fail) && !empty($fail)){
        ?>
        <div class="alert alert-danger alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Failed!</strong> <?php echo  $fail ?>
      </div>
        <?php } ?>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <!-- <div class="card-header">
              </div> -->
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="aevent.php" method="post" enctype="multipart/form-data">
               <div class="card-body">

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="Topic">Title:</label>
                    <input type="text" class="form-control" name ="eventTopic" placeholder="Enter Event Title">
                    <span class="text-danger">
                      <?php echo isset($lwea['eventTopic'])?$lwea['eventTopic']:"" ?>
                    </span>
                  </div>
                </div>
                <div class="col-md-6" >  
                  <div class="form-group">
                    <label for="Calendar">Date:</label>
                    <input type="date" class="form-control" name ="calendar" placeholder="categories">
                    <span class="text-danger">
                      <?php echo isset($lwea['calendar'])?$lwea['calendar']:"" ?>
                    </span>
                  </div>

                </div>
                  </div>  
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="Venue">Venue:</label>
                      <input type="text" class="form-control" name ="venue" placeholder="Event Venue">
                      <span class="text-danger">
                      <?php echo isset($lwea['venue'])?$lwea['venue']:"" ?>
                    </span>
                    </div>
                  </div>
                    <div class="col-md-6">
                      <div class="form-group">
                      <label for="exampleInputFile">Upload Event Picture</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="fileupload" name="InputFile" >
                          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                         
                        </div>
                        
                      </div>
                       <span class="text-danger">
                          <?php echo isset($lwea['image'])?$lwea['image']:"" ?>
                        </span>
                    </div>
                </div>
                </div>
               
                  <div class="form-group">
                    <label for="comment">About the Event:</label>
                    <textarea class="form-control mycomment" rows="3" Name ="comment"></textarea>
                    <span class="text-danger">
                      <?php echo isset($lwea['comment'])?$lwea['comment']:"" ?>
                    </span>
                 </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="addevent" class="btn btn-primary float-right">Post</button>
                </div>
              </form>
            </div>
    </section>
</div>


<?php
include("footer.php");
}else{
  header('location:index.php');
}

?>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
    $('.mycomment').summernote({
      height: 100,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'italic', 'underline', 'clear', 'superscript', 'subscript']],
        ['color', ['color']],
        ['para', ['ol', 'ul', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link']],
        ['view', ['fullscreen', 'help', 'undo', 'redo']],
      ]

    })

  })



</script>