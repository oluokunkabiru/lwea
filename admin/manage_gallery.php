<?php
 session_start();
 include("connection.php");
 if(isset($_SESSION['phonenumber'])){
   $usernumer  =$_SESSION['phonenumber'];
   $qu = mysqli_query($church, "SELECT* FROM addadmin WHERE phonenumber='$usernumer'");
   $admin = mysqli_fetch_array($qu);
   $adminarea = $admin['admintype'];
   $success=$fail="";


   if(isset($_POST['deleteTopic']))
{   
    $ayo =  $_POST['deleteTopicsId'];
    $fil  = mysqli_query($church, "SELECT* FROM gallery WHERE id='$ayo'");
    $files = mysqli_fetch_array($fil);
    $picture = $files['pictures'];
    unlink($picture);
    $delet = " DELETE FROM gallery  WHERE id= '$ayo' ";
    $fsele = mysqli_query($church,$delet);

  if ($fsele) {
      header("location:manage_gallery.php");
  }
  else {
      $fail = "Fail to delete photo from gallery ". mysqli_error($church);
  }
}


$pagetitle = "Sermon management";
$adminname = ucwords($admin['firstname']." ". $admin['lastname']);
include("header.php");
?>
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Pictures</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="Dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Manage Gallery</li>
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">Gallery history</h3>

                    <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                    </div>
                    <?php
                         $select= "SELECT* FROM gallery";
                         $fselect = mysqli_query($church,$select);
                         $i = 0;
                    ?>                        
                <div class="card-body table-responsive p-0">
                    <table class="table table-head-fixed text-nowrap" id="manageSermon">
                    <thead>
                        <tr>
                        <th>ID</th>
                        <th>Pictures</th>
                        <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                       while($ffselec= mysqli_fetch_array($fselect)){
                    ?>

                    <tr>
                         <td><?php echo  ++$i ?></td>
                         <td>
                        <?php echo '<img width = "80" height = "90" src= '.$ffselec['pictures'] .'>';?>
                        </td>
                        <td>
                        <i title="Delete Pictures" data-toggle="modal" data-target="#delModal"
                         id="<?php echo $ffselec['id'] ;?>"
                         deltopic = "<?php echo $ffselec['pictures'];?>" 
                         class="fa fa-trash pl-3 " style="font-size:30px;color:red;">
                        </i>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>


                    </tbody>
                    <div class="modal fade" id="delModal">
                            <div class="modal-dialog modal-lg">
                            <form role="form" action="manage_gallery.php" method="post">

                              <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                  <h4 class="modal-title text-dark">Are you sure you want to delete? &nbsp <i></h4>
                                  <input type="hidden" value="" id="delCategory" name="deleteTopicsId">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                  <button type="submit" class="btn btn-Primary" name="deleteTopic" >Yes</button>
                                </div>

                              </div>
                             </form> 
                            </div>
                    </div>
                    </table>

                </div>


                </div>
            </div>
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
      $('#delModal').on('show.bs.modal',function(e){
      var id = $(e.relatedTarget).attr('id');
      var deltopic = $(e.relatedTarget).attr('deltopic');
     
      $("#delCategory").val(id);
      $("#delTopic").text(deltopic);
     
  })

</script>

