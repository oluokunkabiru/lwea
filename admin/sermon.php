<?php
 session_start();
 include("connection.php");
 if(isset($_SESSION['phonenumber'])){
   $usernumer  =$_SESSION['phonenumber'];
   $qu = mysqli_query($church, "SELECT* FROM addadmin WHERE phonenumber='$usernumer'");
   $admin = mysqli_fetch_array($qu);
   $adminarea = $admin['admintype'];
//  }
 
  $lwea=[];
    function test_input($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
   
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
     if (empty($_POST["sermontopic"])) {
        $lwea['topic']="Please provide sermon topic ";
      } else {
        $sermon = test_input($_POST["sermontopic"]);
      }

      if (empty($_POST["minister"])) {
        $lwea['minister']="minister area need to be fill";
      } else {
        $minister = test_input($_POST["minister"]);
      }
      if (empty($_POST["date"])) {
        $lwea['date']="Please specify sermon date";
      } else {
        $date = test_input($_POST["date"]);
      }

     
      $cat = isset($_POST["category"])?$_POST["category"]:[];
      // $cat = $_POST['category'];
       if (count($cat)==0) {
        $lwea['category']="Please choose atleast one categories ";
      }
      if (empty($_POST["url"])) {
        $lwea['url']="Please supply the sermon url";
      } else {
        $url = test_input($_POST["url"]);
      }
      if (empty($_POST["comment"])) {
        $lwea['comment']="Please supply comment message ";
      } else {
        // echo test_input($_POST["comment"]);
        // $dom = new DomDocument();
        // $dom->loadHTML($_POST["comment"], libxml_use_internal_errors(true));
        // $vb = $dob->saveHTML();
        // echo html_entity_decode($vb);
        // echo $vb;
        $comment = test_input($_POST["comment"]);
      }


      // echo "Error before images = ". count($lwea). "<br>";
      $target_dir = "pictures/";
      if ($_FILES["InputFile"]["size"] > 0) {
        $target_file = $target_dir . time(). basename($_FILES["InputFile"]["name"]);
        // echo $target_file;
        $check = getimagesize($_FILES["InputFile"]["tmp_name"]);
         $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

          if($check == false) {
               $lwea['image']= "File is not an image.";
          } 
         elseif ($_FILES["InputFile"]["size"] > 5000000) {
            $lwea['image']= "Sorry, your file is too large.";
          
        }
        elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
          $lwea['image']= "Sorry, only JPG, JPEG & PNG  files are allowed.";
          }
// print_r($lwea);
          elseif (count($lwea)==0) {
            move_uploaded_file($_FILES["InputFile"]["tmp_name"], $target_file);
            
        } else{
          $lwea['image']="Please fill the required areas above";
        }


      }else{
        $lwea['image'] = "Please select sermon image";
      }
// foreach($lwea as $error){
//   echo $error."<br>";
// }

      if (count($lwea) ==0) {
        $sermon = test_input($_POST["sermontopic"]);
        $categories = $_POST["category"];
        $url = test_input($_POST["url"]);
        $comment = test_input($_POST["comment"]);
        $minister = test_input($_POST["minister"]);
        $date = test_input($_POST["date"]);
        $last = mysqli_query($church, "SELECT MAX(id) AS sermonid FROM sermon ");
        $lastid = mysqli_fetch_array($last);
        $sermonid = isset($lastid['sermonid'])? $lastid['sermonid']:0;
        // echo  "$sermonid";
        foreach ($categories as $category) {
        $new="INSERT INTO sermon(Topic,Categories,Link,Comment,Pictures, date, minister, sermonid) VALUE ('$sermon','$category','$url','$comment','$target_file', '$date', '$minister', '$sermonid')";
        $adten= mysqli_query($church,$new);
         }
        if($adten){
          header("location:msermon.php");
        }
        else{
         $lwea['notinsert']= "New sermon fail to create, please contact your server administrator";
        }

         
      }


    }

    $pagetitle = "Add new sermon";
    $adminname = ucwords($admin['firstname']." ". $admin['lastname']);

  
    include("header.php");

?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-">
          <h1>Add New Sermon</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="Dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Add New Sermon</li>
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
            <?php if(isset($lwea['notinsert'])){
         
          ?>
          <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Error! </strong> <?php echo $lwea['notinsert'] ?>
          </div>
        <?php  } ?>
            <form role="form" action="sermon.php" method="POST" enctype="multipart/form-data">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="Topic">Topic</label>
                      <input type="text" class="form-control" name="sermontopic" placeholder="Enter Sermon Topic">
                      <span class="text-danger">
                        <?php echo isset($lwea['topic'])?$lwea['topic']:"" ?>
                      </span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Category</label>
                      <div class="select2-purple">
                        <select class="select2" name="category[]" multiple="multiple" style="width:100%"
                          data-placeholder="Select a Category" data-dropdown-css-clas="select2-purple">
                          <?php
                     $select= "SELECT* FROM categories";
                     $fselect = mysqli_query($church, $select);
                     while($ffselec= mysqli_fetch_array($fselect)){
                    ?>
                          <option value="<?php echo $ffselec['id'] ?>">
                            <?php echo ucfirst($ffselec['catgories']) ?>
                          </option>

                          <?php  } ?>

                        </select>
                      </div>
                      <span class="text-danger">
                        <?php echo isset($lwea['category'])?$lwea['category']:"" ?>
                      </span>
                    </div>
                  </div>
                </div>


                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="Url">Sermon Url</label>
                      <input type="text" class="form-control" name="url" placeholder="Sermon Url">
                      <span class="text-danger">
                        <?php echo isset($lwea['url'])?$lwea['url']:"" ?>
                      </span>

                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="Url">Minister </label>
                      <input type="text" class="form-control" name="minister" placeholder="Sermon Minister">
                      <span class="text-danger">
                        <?php echo isset($lwea['minister'])?$lwea['minister']:"" ?>
                      </span>

                    </div>

                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="Url">Sermon Date</label>
                      <input type="date" class="form-control" name="date" placeholder="Sermon date">
                      <span class="text-danger">
                        <?php echo isset($lwea['date'])?$lwea['date']:"" ?>
                      </span>

                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="comment">Sermon picture:</label>
                      <input type="file" class="form-control-file border" name="InputFile">
                    </div>
                    <span class="text-danger">
                      <?php echo isset($lwea['image'])?$lwea['image']:"" ?>
                    </span>

                  </div>

                </div>

                <div class="form-group">
                  <label for="comment">Comment:</label>
                  <textarea class="form-control mycomment" rows="3" name="comment"></textarea>
                  <span class="text-danger">
                    <?php echo isset($lwea['comment'])?$lwea['comment']:"" ?>
                  </span>

                </div>


              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Add New Sermon</button>
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