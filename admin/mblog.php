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

$lwea=[];
function test_input($data) 
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['updateButton'])) {
    $id =  $_POST['editId'];
    $previousSermon= "SELECT* FROM blog WHERE id='$id'";
    $qPreviouseSermon = mysqli_query($church,$previousSermon);
    $previousSermonData = mysqli_fetch_array($qPreviouseSermon);


  if (empty($_POST["editTopic"])) {
    $lwea['title']="Title error";
  } else {
    $sermon = test_input($_POST["editTopic"]);
  }
  if (empty($_POST["editUrl"])) {
    $lwea['user']="minister area need to bill fill";
  } else {
    $minister = test_input($_POST["editUrl"]);
  }

  if (empty($_POST["editComment"])) {
    $lwea['content']="comment error";
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
        unlink($previousSermonData['image']);
    } else{
      $lwea['image']="Please fill the required areas above";
    }

    }else{
    $target_file =$previousSermonData['image']; 
  }

  // foreach($lwea as $err){
  //   echo "<br> $err";
  // }

  if (count($lwea) ==0) {
    $id =  $_POST['editId'];
    $title = test_input($_POST["editTopic"]);
    $date = test_input($_POST["editUrl"]);
    $comment = test_input($_POST["editComment"]);

    // foreach ($categories as $category) {
      # code...
      $new= mysqli_query($church, "UPDATE blog set title='$title',user='$date',content='$comment',image='$target_file' WHERE id= $id");
      // }
    if($new){
      $success = "Blog updated successfully";
    }
    else{
      $fail = "Blog fail to update ".mysqli_error($church);
    }
  }


}




  if(isset($_POST['deleteTopic']))
{   
    $ayo =  $_POST['deleteTopicsId'];
    $pre = mysqli_query($church, "SELECT* FROM blog WHERE id='$ayo'");
    $prev = mysqli_fetch_array($pre); 
    $prevpicture = $prev['image'];
    // echo "prkahkdhjakhdajkch ajk $prevpicture";
    unlink($prevpicture);
    $delet = " DELETE FROM blog  WHERE id= '$ayo' ";
    $fsele = mysqli_query($church,$delet);

  if ($fsele) {
      $success =  "Blog deleted successfully";
  }
  else {
      $fail = "Blog fail to delete ". mysqli_error($church);
  }
}

$adminname = ucwords($admin['firstname']." ". $admin['lastname']);

$pagetitle = "Blog management";

include("header.php");

?>
    <div class="content-wrapper">
     <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="Dasboard.php">Home</a></li>
              <li class="breadcrumb-item active">Manage Sermon</li>
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
                <h3 class="card-title">Manage Blog</h3>

              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap blogtable">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Title</th>
                      <th>User</th>
                      <th>Images</th>
                      <th>Blogs</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php
                   $i = 0;
                   $que = mysqli_query($church, "SELECT * FROM blog ORDER BY id DESC");
                   while($blog = mysqli_fetch_array($que)){
                   
                   ?>

                    <tr>
                    <td><?php echo ++$i ?></td>
                    <td><?php echo  $blog['title'] ?></td>
                    <td><?php echo $blog['user'] ?></td>
                    <td><img width = "80" height = "90" src="<?php echo $blog['image'] ?>" alt="blog image" srcset=""></td>
                    <td><?php echo strlen($blog['content']) < 80 ? html_entity_decode($blog['content']) : substr( html_entity_decode($blog['content']), 0 , 80 ).'"</p>.... <a href="../blog-details.php?blog='. $blog['id'].'"> <span class="fa fa-angle-double-right"></span> </a> ' ?></td>
                    <td>
                    <i title="Edit Blog" data-toggle="modal" id="<?php echo $blog['id'] ;?>"
                          topic = "<?php echo ucfirst($blog['title'])  ?>"
                          comment = "<?php echo $blog['content'] ?>"
                          url = "<?php echo ucfirst($blog['user'])  ?>"
                          picture = "<?php echo ucfirst($blog['image'])?>"
                          data-target="#editModal" class="fa fa-edit pr-3" style="font-size:30px;color:blue;border-right:solid black 2px">
                        </i>
                        <i title="View Blog" data-toggle="modal" id="<?php echo $blog['id'] ;?>"
                          topic = "<?php echo ucfirst($blog['title'])  ?>"
                          comment = "<?php echo $blog['content'] ?>"
                          url = "<?php echo ucfirst($blog['user'])  ?>"
                          picture = "<?php echo $blog['image']?>"

                        data-target="#myModal" class="fa fa-eye pl-3 pr-3" 
                        style="font-size:30px;color:green;border-right:solid black 2px">
                        </i>
                        <i title="Delete Blog" data-toggle="modal" id="<?php echo $blog['id'] ;?>"
                         deletetopic = "<?php echo ucfirst($blog['title']) ;?>"
                          data-target="#dModal" class="fa fa-trash pl-3 " style="font-size:30px;color:red;">
                            
                        </i>

                    </td> 
                  </tr>
                <?php } ?>
                  </tbody>

                  <div class="modal fade" id="myModal">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                  <h4 class="modal-title text-dark">View Blog</h4>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body text-dark">
                                  <input type="hidden" value="" id="ourCategory" name="ido">  
                                  <h4> Title: &nbsp <i> <Span name="" id="mTopic"></i></Span></h4>
                                  <h4>Content: &nbsp <span ><i name="" id="mComment"></i></span></h4>
                                  <h4>User: &nbsp <span><i name="" id="mUrl"></i></span></h4>
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
                  <div class="modal fade" id="dModal">
                    <form action="mblog.php" method="post">
                        <div class="modal-dialog modal-lg">
                                  <div class="modal-content">

                                <!-- Modal Delete -->
                                <div class="modal-header">
                                <h4 class="modal-title text-dark"> Are you sure you want to delete  <i><Span id="deletetopic"></i></Span>?</h4>
                                  <input type="hidden" value="" id="deleteTopicsId" name="deleteTopicsId">
                                  <!-- <input type="text" value="" id="delTopic" name="delTopic"> -->
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                  <button type="submit" class="btn btn-Primary" name="deleteTopic" >Yes</button>
                                </div>

                              </div>
                            </div>
                    </form>
                            
                  </div>

                  <div class="modal fade" id="editModal">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                  <h4 class="modal-title text-dark">Edit Blog</h4>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body text-dark">
                                <form role="form" action="mblog.php" method="post" enctype="multipart/form-data">
                                      <div class="card-body ">
                                        <div class="row">
                                         <input type="hidden" value="" class="form-control" name="editId" id="editId" placeholder="Enter Sermon Topic">

                                          <!-- <div class="col-md-6">
                                             <div class="form-group">
                                        </div>
                                          </div> -->
                                          <div class="col-md-6">
                                             <div class="form-group">
                                          <label for="Topic">Title</label>
                                          <input type="text" value="" class="form-control" name="editTopic" id="editTopic" placeholder="Enter Sermon Topic">
                                        </div>
                                          </div>
                                          
                                          <div class="col-md-6">
                                            <div class="form-group">
                                          <label for="Url">User</label>
                                          <input type="text" value="" class="form-control" name="editUrl" id="editUrl" placeholder="Sermon Url">
                                        </div>
                                          </div>
                                        <!-- </div> -->
                                        </div>
                                     

                                          

                                        <div class="row">
                                          <div class="col-md-8">
                                            <div class="form-group">
                                              <label for="comment">Blog image:</label>
                                              <input type="file" class="form-control-file border" name="InputFile">
                                            </div>
                                            <span class="text-danger">
                                              <?php echo isset($lwea['image'])?$lwea['image']:"" ?>
                                            </span>
                                          </div>

                                        </div>
                                                                               
                                        <div class="form-group">
                                          <label for="comment">Comment:</label>
                                          <textarea class="form-control mycomment" rows="3" name="editComment" id="editComment"></textarea>
                                      </div>

                                      
                                      </div>
                                      <!-- /.card-body -->

                                      <div class="card-footer">
                                        <button type="submit" class="btn btn-primary" name="updateButton">Update</button>
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
      $(".blogtable").DataTable();

  $('#myModal').on('show.bs.modal',function(e){
      var id = $(e.relatedTarget).attr('id');
      var topic = $(e.relatedTarget).attr('topic');
      // var category = $(e.relatedTarget).attr('category');
      var comment = $(e.relatedTarget).attr('comment');
      var url = $(e.relatedTarget).attr('url');
      var picture = $(e.relatedTarget).attr('picture');
    

      

      $("#ourCategory").val(id);
  
      $("#mTopic").text(topic);
      // $("#mCategory").text(category);
      $("#mComment").html(comment);
      $("#mUrl").text(url);
      $("#mPicture").attr('src', picture);
  })

  $('#dModal').on('show.bs.modal',function(e){
      var id = $(e.relatedTarget).attr('id');
      var deletetopic = $(e.relatedTarget).attr('deletetopic');
      

      $("#deleteTopicsId").val(id);
      $("#deletetopic").text(deletetopic);
  })

  $('#editModal').on('show.bs.modal',function(e){
      var id = $(e.relatedTarget).attr('id');
      var topic = $(e.relatedTarget).attr('topic');
      var category = $(e.relatedTarget).attr('category');
      var comment = $(e.relatedTarget).attr('comment');
      var url = $(e.relatedTarget).attr('url');
      var picture = $(e.relatedTarget).attr('picture');
      var minister = $(e.relatedTarget).attr('minister');
      var date = $(e.relatedTarget).attr('date');
      

      $("#minister").val(minister);
      $("#date").val(date);
      // var catid = $(e.relatedTarget).attr('catid');
// alert(comment);
      $("#editId").val(id);
      $("#editTopic").val(topic);
      $("#editCategory").val(category);
      $("#editComment").html(comment);
      $("#editUrl").val(url);
      $("#editPicture").attr('src', picture);
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
      // $("#selectCategory").attr('title', category);
      // $("#selectCategory").attr('value', catid);
      // alert(catid);
      
  })

  
 $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
    $("#manageSermon").DataTable();

 
 })




</script>