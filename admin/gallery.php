<?php
 session_start();
 include("connection.php");
 if(isset($_SESSION['phonenumber'])){
    $usernumer  =$_SESSION['phonenumber'];
    $qu = mysqli_query($church, "SELECT* FROM addadmin WHERE phonenumber='$usernumer'");
    $admin = mysqli_fetch_array($qu);
    $adminarea = $admin['admintype'];

    $lwea=[];
    if (isset($_POST['addgallery'])) {
        $target_dir = "gallery/";
        for($i=0 ; $i < count($_FILES["InputFile"]['name']);  $i++ ){
        if ($_FILES["InputFile"]["size"][$i] > 0) {

          $target_file = $target_dir . basename($_FILES["InputFile"]['name'][$i]);
          // echo $target_file;
          $check = getimagesize($_FILES["InputFile"]["tmp_name"][$i]);
           $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  
            if($check == false) {
                 $lwea['image']= "File is not an image.";
            } 
           elseif ($_FILES["InputFile"]["size"][$i] > 5000000) {
              $lwea['image']= "Sorry, your file is too large.";
            
          }
          elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
            $lwea['image']= "Sorry, only JPG, JPEG & PNG  files are allowed.";
            }
            elseif (count($lwea)==0) {
              move_uploaded_file($_FILES["InputFile"]['tmp_name'][$i], $target_file);
              
          } else{
            $lwea['image']="Please fill the required areas above";
          }
  
  
        }else{
          $lwea['image'] = "Please select sermon image";
        }
        if (count($lwea) ==0) {
          $category= $_POST['catgory'];
            $new="INSERT INTO gallery(Pictures, category_id) VALUE ('$target_file', '$category')";
            $adten= mysqli_query($church,$new);


             }
            // if($adten){
            //   header("location:manage_gallery.php");
            // }
            // else{
            //  $lwea['notinsert']= "New sermon fail to create, please contact your server administrator";
            // }
    
             
          }


        }

        if(isset($_POST['addgallerycategory'])){
          $catError = [];
          if(empty($_POST['gallerycategory'])){
            $catError['cat'] ="Please provide category name";
          }
          if(count($catError)==0){
            $category = $_POST['gallerycategory'];
            $cat = mysqli_query($church, "INSERT INTO gallery_category (name) VALUE('$category')");
            if($cat){
              header('location:gallery.php');
            }
          }
        }
    
    
        }

        if(isset($_GET['deleteComment'])){
          $id = $_GET['deleteComment'];
          
          $q = mysqli_query($church, "DELETE FROM  gallery_category WHERE id='$id'");
          if($q){
            header('location:gallery.php');
      
      }
      
      
        }
      
        $pagetitle = "Add New pictures";
        $adminname = ucwords($admin['firstname']." ". $admin['lastname']);

        include("header.php");
?>

<div class="content-wrapper">
  <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-5">
            <h1>Add New Pictures</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="Dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">Add New Pictures</li>
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
              <div class="card-body">
              <div class="row">
                  <div class="col-md-6">
                       <form role="form" action="gallery.php" method="POST" enctype="multipart/form-data">
                       <div class="form-group">
                            <label for="sel1">Picture Category:</label>
                            <select class="form-control" id="sel1" name="catgory">
                            <?php
                          $i=0;
                           $catg = mysqli_query($church, "SELECT* FROM gallery_category ORDER BY id DESC ");
                           while($catge = mysqli_fetch_array($catg)){
                          ?>
                              <option value="<?php echo $catge['id'] ?>"><?php echo ucwords($catge['name'])  ?></option>
                              <?php } ?>

                            </select>
                           </div>
                    <div class="form-group">
                      <label for="comment">Sermon picture:</label>
                      <input type="file" class="form-control-file border" multiple  name="InputFile[]">
                    </div>
                    <p class="text-danger">
                      <?php echo isset($lwea['image'])?$lwea['image']:"" ?>
                    </p>
                    <button type="submit" class="btn btn-primary" name="addgallery">Add New pictures</button>
                    </form>
                  </div>

                </div>
                <br>
                <hr>

                <div class="row">
                    <div class="col-md-5">
                    <h3>Add picture category</h3>

                    <form role="form" action="gallery.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="comment">Gallery Category</label>
                      <input type="text" class="form-control" multiple  name="gallerycategory">
                    </div>
                    <p class="text-danger">
                      <?php echo isset( $catError['cat'])? $catError['cat']:"" ?>
                    </p>

                <button type="submit" class="btn btn-primary" name="addgallerycategory">Add New Gallery category</button>

                    </form>
                    </div>
                    <div class="col-md-7">
                    <h3>Existing picture category</h3>

                    <?php 
                      $catg = mysqli_query($church, "SELECT* FROM gallery_category");
                      $catgo = mysqli_fetch_array($catg);
                      $idss = isset($catgo['id'])?$catgo['id']:"";
                      if(!empty($idss)){
                    ?>
                    <table class="table table-hover table-responsive">
                        <thead>
                          <tr>
                              <th>S/N</th>
                              <th>Name</th>
                              <th>Date</th>
                              <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $i=0;
                           $catg = mysqli_query($church, "SELECT* FROM gallery_category ORDER BY id DESC");
                           while($catge = mysqli_fetch_array($catg)){
                          ?>
                            <tr>
                            <td><?php echo ++$i ?></td>
                            <td><?php echo ucwords($catge['name'])  ?></td>
                            <td><?php echo $catge['date'] ?></td>
                            <td>
                            <a href="gallery.php?deleteComment=<?php echo $catge['id'] ?>" class="text-danger" onclick="return confirm('Are you sure you want to delete this item?');" ><span class="fa fa-trash "></span></a>
                            </td>
                            </tr>
                          <?php } ?>
                        </tbody>
                                                
                    </table>
                    <?php } ?>
                    </div>
                    </div>
                   



              </div>
              <!-- /.card-body -->

              <!-- <div class="card-footer">
              </div> -->
           
          </div>
  </section>
</div>

<script>
    function ConfirmDelete()
    {
      var x = confirm("Are you sure you want to delete?");
      if (x)
          return true;
      else
        return false;
    }


</script>    

    
          