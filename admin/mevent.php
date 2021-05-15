<?php
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

if (isset($_POST['updatebutton'])) {
    $id =  $_POST['editId'];
    $previousSermon= "SELECT* FROM event WHERE id='$id'";
    $qPreviouseSermon = mysqli_query($church,$previousSermon);
    $previousSermonData = mysqli_fetch_array($qPreviouseSermon);


  if (empty($_POST["editTitle"])) {
    $lwea['title']="sermontopic error";
  } else {
    $sermon = test_input($_POST["editTitle"]);
  }
  if (empty($_POST["editDate"])) {
    $lwea['date']="minister area need to bill fill";
  } else {
    $minister = test_input($_POST["editDate"]);
  }
  if (empty($_POST["editVenue"])) {
    $lwea['date']="minister area need to bill fill";
  } else {
    $date = test_input($_POST["editVenue"]);
  }

  if (empty($_POST["editComment"])) {
    $lwea['comment']="comment error";
  } else {
    $comment = test_input($_POST["editComment"]);
  }
  $target_dir = "pictures/";
  if ($_FILES["InputFile"]["size"] > 0) {
    $target_file = $target_dir . basename($_FILES["InputFile"]["name"]);
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
        unlink($previousSermonData['Pictures']);
    } else{
      $lwea['image']="Please fill the required areas above";
    }

    }else{
    $target_file =$previousSermonData['Pictures']; 
  }

  // foreach($lwea as $err){
  //   echo "<br> $err";
  // }

  if (count($lwea) ==0) {
    $id =  $_POST['editId'];
    $title = test_input($_POST["editTitle"]);
    $date = test_input($_POST["editDate"]);
    $venue = test_input($_POST["editVenue"]);
    $comment = test_input($_POST["editComment"]);

    // foreach ($categories as $category) {
      # code...
      $new= mysqli_query($church, "UPDATE event set Title='$title',Date='$date',Venue='$venue',About='$comment',Pictures='$target_file' WHERE id= $id");
      // }
    if($new){
      header("location:mevent.php");
      $success = "New event created successfully";
    }
    else{
      $fail = "New event fail to created ".mysqli_error($church);
    }
  }


}


if(isset($_POST['delEvent']))
{   
    $ayo =  $_POST['delCategory'];
    $pre = mysqli_query($church, "SELECT* FROM event WHERE id ='$ayo' ");
    $prev = mysqli_fetch_array($pre);
    $previouspicture = $prev['Pictures'];
    unlink($previouspicture);
    $delet = " DELETE FROM event  WHERE id= '$ayo' ";
    $fsele = mysqli_query($church,$delet);

  if ($fsele) {
    header("location:mevent.php");
      $success =  "Event deleted successfully";
  }
  else {
      $fail = "Event failed to deleted ". mysqli_error($church);
  }
}


$pagetitle = "Event management";
$adminname = ucwords($admin['firstname']." ". $admin['lastname']);

include("header.php");


?>
    <div class="content-wrapper">
     <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Event management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="Dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Manage Event</li>
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
                <h3 class="card-title">Manage history</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <?php
                         $select= "SELECT* FROM event";
                         $fselect = mysqli_query($church,$select);
                         $i = 0;
              ?>

              <div class="card-body table-responsive p-0" >
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Title</th>
                      <th>Venue</th>
                      <th>Date</th>
                      <th>Short note</th>
                      <th>pictures</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                       while($ffselec= mysqli_fetch_array($fselect)){
                    ?>

                    <tr>
                      <?php echo '<td>' . ++$i.'</td>' ;?>
                      <?php echo '<td>'. ucfirst($ffselec['Title']) .'</td>' ;?>
                      <?php echo '<td>'. ucfirst($ffselec['Venue']) .'</td>' ;?>
                      <?php echo '<td>'. ucfirst($ffselec['Date']) .'</td>' ;?>
                      <?php echo '<td>'. htmlspecialchars_decode( ucfirst($ffselec['About'])).'</td>' ;?>
                      <?php echo '<td> <img width = "80" height = "90" src= '. $ffselec['Pictures'] .'></td>' ;?>

                      <td>
                        <i title="Edit Sermon" data-toggle="modal" data-target="#editModal"
                          id="<?php echo $ffselec['id'] ;?>"
                          titles= "<?php echo ucfirst($ffselec['Title'])  ?>"
                          date = "<?php echo ucfirst($ffselec['Date'])  ?>"
                          venue = "<?php echo ucfirst($ffselec['Venue']) ?>"
                          about = "<?php echo ucfirst($ffselec['About'])  ?>"
                          picture = "<?php echo $ffselec["Pictures"]?>"  

                         class="fa fa-edit pr-3" style="font-size:30px;color:blue;border-right:solid black 2px">
                          
                        </i>
                        <i title="View Sermon" data-toggle="modal" data-target="#viewModal"class="fa fa-eye pl-3 pr-3" style="font-size:30px;color:green;border-right:solid black 2px"
                        id="<?php echo $ffselec['id'] ;?>" 
                        title= "<?php echo ucfirst($ffselec['Title'])  ?>"
                        date = "<?php echo ucfirst($ffselec['Date'])  ?>"
                        venue = "<?php echo ucfirst($ffselec['Venue']) ?>"
                        about = "<?php echo ucfirst($ffselec['About'])  ?>"
                        picture = "<?php echo $ffselec['Pictures']?>"
                        >
                        </i>
                        <i title="Delete sermon" data-toggle="modal" data-target="#delModal"
                         id="<?php echo $ffselec['id'] ;?>"
                         deltopic = "<?php echo ucfirst($ffselec['Title']) ;?>" 
                        class="fa fa-trash pl-3 " style="font-size:30px;color:red;">
                        </i>
                      </td>
                    </tr>
                    <?php
                    }
                    ?>

                  </tbody>
                  <form action="mevent.php" method="post">
                                    <div class="modal fade" id="delModal">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                  <h4 class="modal-title text-dark">Are you sure you want to delete? &nbsp <i> <Span name="deltopic" id="delTopic"></i></Span>&nbsp Event </h4>
                                  <input type="hidden" value="" id="delCategory" name="delCategory">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                  <button type="submit" class="btn btn-Primary" name="delEvent" >Yes</button>
                                </div>

                              </div>
                            </div>
                  </div>

                  </form>

                          <div class="modal fade" id="viewModal">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                  <h4 class="modal-title text-dark">View Events</h4>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body text-dark">
                                  <input type="hidden" value="" id="ourCategory" name="ido">  
                                  <h4> Title: &nbsp <i> <Span name="" id="mTopic"></i></Span></h4>
                                  <h4> Date: &nbsp <span><i name="" id="mCategory"></i></span> </h4>
                                  <h4> Venue: &nbsp <span ><i name="" id="mComment"></i></span></h4>
                                  <h4> About: &nbsp <span><i name="" id="mUrl"></i></span></h4>
                                  <div class="card">
                                  <img src="" id ="mPicture" style="height: 500px; object-fit: contain ;" class="card-img img-fluid">
                                  </div>
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>

                              </div>
                            </div>
                          </div>

                          <div class="modal fade" id="editModal">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                  <h4 class="modal-title text-dark">Edit Event</h4>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body text-dark">
                                    <form role="form" action="mevent.php" method="post" enctype="multipart/form-data">
                                      <div class="card-body ">
                                      <div class="form-group">
                                          <!-- <label for="Id">Id</label> -->
                                          <input type="hidden" value="" class="form-control" name="editId" id="editId" placeholder="Enter Sermon Topic">
                                        </div>
                                        <div class="form-group">
                                          <label for="Topic">Title:</label>
                                          <input type="text"  class="form-control" name="editTitle" id="editTitle" >
                                        </div>
                                        <div class="form-group">
                                          <label for="date">Date:</label>
                                          <input type="date" value="" class="form-control" name="editDate" id="editDate" >
                                        </div>
                                        <div class="form-group">
                                          <label for="Venue">Venue</label>
                                          <input type="text" value="" class="form-control" name="editVenue" id="editVenue" >
                                        </div>
                                        <div class="form-group">
                                          <label for="comment">About:</label>
                                          <textarea class="form-control" rows="3" name="editComment" id="editComment"></textarea>
                                      </div>

                                        <div class="form-group">
                                          <label for="exampleInputFile">File input</label>
                                          <div class="input-group">
                                            <div class="custom-file">
                                              <input type="file" class="custom-file-input" id="editPicture" name="InputFile">
                                              <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                              <!-- <span class="input-group-text" id="">Upload</span> -->
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <!-- /.card-body -->

                                      <div class="card-footer">
                                        <button type="submit" class="btn btn-primary" name="updatebutton">Update</button>
                                      </div>
                                    </form>


                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>

                              </div>
                            </div>
                          </div>


                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
     </section>
 </div>
<?php
include("footer.php");
}else{
  header('location:index.php');
}

?>
<script>
    $('#viewModal').on('show.bs.modal',function(e){
      var id = $(e.relatedTarget).attr('id');
      var title = $(e.relatedTarget).attr('Title');
      var date = $(e.relatedTarget).attr('Date');
      var venue = $(e.relatedTarget).attr('Venue');
      var about = $(e.relatedTarget).attr('About');
      var picture = $(e.relatedTarget).attr('picture');

      $("#ourCategory").val(id);
      $("#mTopic").text(title);
      $("#mCategory").text(date);
      $("#mComment").text(venue);
      $("#mUrl").text(about);
      $("#mPicture").attr('src', picture);
  })

  $('#delModal').on('show.bs.modal',function(e){
      var id = $(e.relatedTarget).attr('id');
      var deltopic = $(e.relatedTarget).attr('deltopic');
      // var category = $(e.relatedTarget).attr('category');
      // var comment = $(e.relatedTarget).attr('comment');
      // var url = $(e.relatedTarget).attr('url');

      $("#delCategory").val(id);
      $("#delTopic").text(deltopic);
      // $("#mCategory").val(category);
      // $("#mComment").val(comment);
      // $("#mUrl").val(url);
  })

  $('#editModal').on('show.bs.modal',function(e){
      var id = $(e.relatedTarget).attr('id');
      var title = $(e.relatedTarget).attr('Titles');
      var date = $(e.relatedTarget).attr('Date');
      var venue = $(e.relatedTarget).attr('Venue');
      var about = $(e.relatedTarget).attr('About');
      var picture = $(e.relatedTarget).attr('picture');

      $("#editId").val(id);
      $("#editTitle").val(title);
      $("#editDate").val(date);
      $("#editVenue").val(venue);
      $("#editComment").val(about);
      $("#editPicture").attr('src', picture);
  })


</script>