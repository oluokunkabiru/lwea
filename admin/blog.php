<?php
 session_start();
 include("connection.php");
 if(isset($_SESSION['phonenumber'])){
   $usernumer  =$_SESSION['phonenumber'];
   $qu = mysqli_query($church, "SELECT* FROM addadmin WHERE phonenumber='$usernumer'");
   $admin = mysqli_fetch_array($qu);
   $adminarea = $admin['admintype'];
//  }


$errors = [];

function test_input($data) 
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if(isset($_POST['postblog'])){
  if(empty($_POST['title'])){
    $errors['title'] = "Please provide title for the blog";
  }

  if (!preg_match("/^[a-zA-Z ]*$/",$_POST['title'])) {
    $error['title'] = "Only letters and white space allowed for blog title";
  }

  if(empty($_POST['user'])){
    $errors['user'] = "Please provide your full name";
  }

  if (!preg_match("/^[a-zA-Z ]*$/",$_POST['user'])) {
    $errors['user'] = "Only letters and white space allowed for user full name";
  }

  if(strlen(trim($_POST['content'])) < 10){
    $errors['content'] = "Please write your full blog";
  }

  $target_dir = "blogs/";
  if(!is_dir($target_dir)){
    mkdir($target_dir);
  }
  if ($_FILES["InputFile"]["size"] > 0) {
    $target_file = $target_dir .time() . basename($_FILES["InputFile"]["name"]);
    // echo $target_file;
    $check = getimagesize($_FILES["InputFile"]["tmp_name"]);
      if($check == false) {
           $errors['image']= "File is not an image.";
      } 
      if ($_FILES["InputFile"]["size"] > 500000) {
        $errors['image']= "Sorry, your file is too large.";
      
    }
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
      $errors['image']= "Sorry, only JPG, JPEG & PNG  files are allowed.";
      }

      if (count($errors)==0) {
        move_uploaded_file($_FILES["InputFile"]["tmp_name"], $target_file);
        
    } else{
      $errors['image']="Please fill the required areas above";
    }


  }else{
    $errors['image'] = "Please select blog image";
  }




  if(count($errors)==0){
    $title = test_input($_POST['title']);
    $content = test_input($_POST['content']);
    $img = $target_file;
    $user = test_input($_POST['user']);

    $blog = mysqli_query($church, "INSERT INTO blog (title, content, user, image) VALUES('$title', '$content', '$user', '$img')");
    if($blog){
      echo '<script> window.location.assign("mblog.php") </script>';
    }
    // else{
    //   echo "Fail please check your  ";
    // }
  }

}
$adminname = ucwords($admin['firstname']." ". $admin['lastname']);

$pagetitle = "Add new blog";

include('header.php')

?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-9">
            <h1>Add Blog</h1>
          </div>
          <div class="col-sm-3">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="Dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Add Blog</li>
            </ol>
          </div>
        </div>
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
              <form role="form" enctype="multipart/form-data" method="POST">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-6">
                                        <div class="form-group">
                    <label for="Topic">Title:</label>
                    <input type="text" class="form-control" id="BlogTitle" name="title" placeholder="Title">
                    <span class="text-danger">
                        <?php echo isset($errors['title'])?$errors['title']:"" ?>
                      </span>
                  </div>

                    </div>
                    <div class="col-sm-6">
                    <div class="form-group">
                    <label for="Categories">User:</label>
                    <input type="text" class="form-control" id="BlogUser" name="user" placeholder="User">
                    <span class="text-danger">
                        <?php echo isset($errors['user'])?$errors['user']:"" ?>
                      </span>
                  </div>

                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                    <div class="form-group">
                    <label for="exampleInputFi">Upload Picture</label>

                   <input type="file" class="form-control-file border" accept="image/*" name="InputFile">

                   <span class="text-danger">
                        <?php echo isset($errors['image'])?$errors['image']:"" ?>
                      </span>
                   </div>

                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for="comment">Blog:</label>
                        <textarea class="form-control blogarea" rows="3" name="content"></textarea>
                        <span class="text-danger">
                              <?php echo isset($errors['content'])?$errors['content']:"" ?>
                            </span>
                        </div>
                    </div>
                  </div>                  

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary float-right" name="postblog">Post</button>
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
	  $('.blogarea').summernote({
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