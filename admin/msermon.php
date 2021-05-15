<?php
 session_start();
 include("connection.php");
 if(isset($_SESSION['phonenumber'])){
   $usernumer  =$_SESSION['phonenumber'];
   $qu = mysqli_query($church, "SELECT* FROM addadmin WHERE phonenumber='$usernumer'");
   $admin = mysqli_fetch_array($qu);
   $adminarea = $admin['admintype'];
   $success =$fail="";
//  }


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

    $previousSermon= "SELECT  sermon.*, categories.catgories AS categoryname, categories.id AS categoryid FROM sermon JOIN categories ON sermon.categories = categories.id WHERE sermon.id='$id'";
    $qPreviouseSermon = mysqli_query($church,$previousSermon);
    $previousSermonData = mysqli_fetch_array($qPreviouseSermon);

  if (empty($_POST["editTopic"])) {
    $lwea['topic']="sermontopic error";
  } else {
    $sermon = test_input($_POST["editTopic"]);
  }
  if (empty($_POST["minister"])) {
    $lwea['minister']="minister area need to bill fill";
  } else {
    $minister = test_input($_POST["minister"]);
  }
  if (empty($_POST["date"])) {
    $lwea['date']="minister area need to bill fill";
  } else {
    $date = test_input($_POST["date"]);
  }
  if (empty($_POST["editCategory"])) {
    $lwea['category']="choose atleast one categories ";
  }

  if (empty($_POST["editUrl"])) {
    $lwea['url']="url error";
  } else {
    $url = test_input($_POST["editUrl"]);
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
    $sermon = test_input($_POST["editTopic"]);
    $category = $_POST["editCategory"];
    $url = test_input($_POST["editUrl"]);
    $comment = test_input($_POST["editComment"]);
    $date = test_input($_POST["date"]);
    $minister = test_input($_POST["minister"]);

    // foreach ($categories as $category) {
      # code...
      $new= mysqli_query($church,"UPDATE sermon set Topic='$sermon', minister='$minister', date='$date',  categories='$category',Link='$url',Comment='$comment',Pictures='$target_file' WHERE id= $id");
      // }
    if($new){
     $success =   "Sermon updated successfully";
    }
    else{
      $fail = "Sermon  updated failed ".mysqli_error($church);
    }
  }


}


if(isset($_POST['deleteTopic']))
{   
    $ayo =  $_POST['deleteTopicsId'];
    $delet = " DELETE FROM sermon  WHERE id= '$ayo' ";
    $fsele = mysqli_query($church,$delet);

  if ($fsele) {
      $success=  "Sermon deleted successfully";
  }
  else {
      $fail= "Sermon fail to delete ". mysqli_error($church);
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
            <h1>All Sermon</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="Dashboard.php">Home</a></li>
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
                <h3 class="card-title">Sermon history</h3>

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
                 $select= "SELECT  sermon.*, categories.catgories AS categoryname FROM sermon JOIN categories ON sermon.categories = categories.id ";
                 $fselect = mysqli_query($church,$select);
                 $i = 0;
              ?>
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap" id="manageSermon">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Topic</th>
                      <th>Categories</th>
                      <th>Short note</th>
                      <th>Url</th>
                      <th>Pictures</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php
                       while($ffselec= mysqli_fetch_array($fselect)){
                         $sermon =  (htmlspecialchars_decode($ffselec['Comment'])); //< 30 ? htmlspecialchars_decode($ffselec['Comment']):substr(htmlspecialchars_decode($ffselec['Comment']), 0, 30)."....";
                        // $a = strlen(htmlspecialchars_decode($ffselec['Comment'])) < 20 ? htmlspecialchars_decode($ffselec['Comment']) : substr(htmlspecialchars_decode($ffselec['Comment']), 0,20)."</p>";
                        // echo $a;
                            // print_r($a);
                            
                    ?>
                    <tr>
                   <td><?php echo  ++$i ?></td>
                    <td>  <?php echo ucfirst($ffselec['Topic'])  ?></td>
                    <td> <?php echo  ucfirst($ffselec['categoryname'])  ?></td>
                    <td><?php echo strlen($ffselec['Comment']) < 80 ? html_entity_decode($ffselec['Comment']) : substr( html_entity_decode($ffselec['Comment']), 0 , 80 ).'"</p> ' ?></td>
                    <td> <?php echo ucfirst($ffselec['Link']) ?></td>
                    <td>  <img width = "80" height = "90" src="<?php echo $ffselec['Pictures']  ?>"></td>
                      <td>
                   
                        <i title="Edit Sermon" data-toggle="modal" id="<?php echo $ffselec['id'] ;?>"
                          category= "<?php echo ucfirst($ffselec['categoryname'])  ?>"
                          topic = "<?php echo ucfirst($ffselec['Topic'])  ?>"
                          comment = "<?php echo $ffselec['Comment'] ?>"
                          url = "<?php echo ucfirst($ffselec['Link'])  ?>"
                          picture = "<?php echo ucfirst($ffselec['Pictures'])?>"
                          minister =  "<?php echo ucfirst($ffselec['minister'])?>" 
                          date =  "<?php echo ($ffselec['date'])?>"
                          data-target="#editModal" class="fa fa-edit pr-3" style="font-size:30px;color:blue;border-right:solid black 2px">
                        </i>
                        <i title="View Sermon" data-toggle="modal" id="<?php echo $ffselec['id'] ;?>" 
                        category= "<?php echo ucfirst($ffselec['categoryname'])  ?>"
                        topic = "<?php echo ucfirst($ffselec['Topic'])  ?>"
                        comment =  "<?php echo ($ffselec['Comment']) ?>"
                        url = "<?php echo $ffselec['Link']  ?>"
                        picture = "<?php echo $ffselec["Pictures"]?>"  
                        data-target="#myModal" class="fa fa-eye pl-3 pr-3" 
                        style="font-size:30px;color:green;border-right:solid black 2px">
                        </i>
                        <i title="Delete sermon" data-toggle="modal" id="<?php echo $ffselec['id'] ;?>"
                         deletetopic = "<?php echo ucfirst($ffselec['Topic']) ;?>"
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
                                  <h4 class="modal-title text-dark">View Sermon</h4>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body text-dark">
                                  <input type="hidden" value="" id="ourCategory" name="ido">  
                                  <h4> Topic: &nbsp <i> <Span name="" id="delTopic"></i></Span></h4>
                                  <h4> Category: &nbsp <span><i name="" id="mCategory"></i></span> </h4>
                                  <h4>Short note: &nbsp <span ><i name="" id="mComment"></i></span></h4>
                                  <h4>Url: &nbsp <span><i name="" id="mUrl"></i></span></h4>
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
                    <form action="msermon.php" method="post">
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
                                  <h4 class="modal-title text-dark">Edit Sermon</h4>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body text-dark">
                                <form role="form" action="msermon.php" method="post" enctype="multipart/form-data">
                                      <div class="card-body ">
                                        <div class="row">
                                         <input type="hidden" value="" class="form-control" name="editId" id="editId" placeholder="Enter Sermon Topic">

                                          <!-- <div class="col-md-6">
                                             <div class="form-group">
                                        </div>
                                          </div> -->
                                          <div class="col-md-6">
                                             <div class="form-group">
                                          <label for="Topic">Topic</label>
                                          <input type="text" value="" class="form-control" name="editTopic" id="editTopic" placeholder="Enter Sermon Topic">
                                        </div>
                                          </div>

                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label for="Url">Minister </label>
                                              <input type="text" class="form-control" id="minister" name="minister" placeholder="Sermon Minister">
                                              <span class="text-danger">
                                                <?php echo isset($lwea['minister'])?$lwea['minister']:"" ?>
                                              </span>
                        
                                            </div>
                                          </div>
                                        </div>
                                     
                                        <div class="row">

                                          <div class="col-md-6">
                                          <div class="form-group">
                                            <label>Category</label>

                                        <div class="select2-purple">
                                        <select class="select2" name="editCategory" id="editCategory" multiple="sigle" style="width:100%" data-placeholder="Select a Category" data-dropdown-css-class="select2-purple">
                                        <!-- <option selected id="selectCategory" value="32">323</option> -->

                                        <?php
                                          $select= "SELECT* FROM categories";
                                          $fselect = mysqli_query($church, $select);

                                          while($ffselec= mysqli_fetch_array($fselect)){

                                          ?>
                                          <option  value="<?php echo $ffselec['id'] ?>"><?php echo ucfirst($ffselec['catgories']) ?></option>
                                          <?php  } ?>
                                        </select>
                                        </div>
                                         </div>
                                          </div>

                                          <div class="col-md-6">
                                            <div class="form-group">
                                          <label for="Url">Sermon Url</label>
                                          <input type="text" value="" class="form-control" name="editUrl" id="editUrl" placeholder="Sermon Url">
                                        </div>
                                          </div>
                                        </div>

                                        <div class="row">
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label for="comment">Sermon picture:</label>
                                              <input type="file" class="form-control-file border" name="InputFile">
                                            </div>
                                            <span class="text-danger">
                                              <?php echo isset($lwea['image'])?$lwea['image']:"" ?>
                                            </span>
                                          </div>

                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label for="Url">Sermon Date</label>
                                              <input type="date" class="form-control" id="date" name="date" placeholder="Sermon date">
                                              <span class="text-danger">
                                                <?php echo isset($lwea['date'])?$lwea['date']:"" ?>
                                              </span>
                        
                                            </div>
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
  $('#myModal').on('show.bs.modal',function(e){
      var id = $(e.relatedTarget).attr('id');
      var topic = $(e.relatedTarget).attr('topic');
      var category = $(e.relatedTarget).attr('category');
      var comment = $(e.relatedTarget).attr('comment');
      var url = $(e.relatedTarget).attr('url');
      var picture = $(e.relatedTarget).attr('picture');
    

      

      $("#ourCategory").val(id);
  
      $("#mTopic").text(topic);
      $("#mCategory").text(category);
      $("#mComment").html(comment);
      $("#mUrl").text(url);
      $("#mPicture").attr('src', picture);
  })

  $('#dModal').on('show.bs.modal',function(e){
      var id = $(e.relatedTarget).attr('id');
      var deletetopic = $(e.relatedTarget).attr('deletetopic');
      

      $("#deleteTopicsId").val(id);
      $("#deletetopic").text(deletetopic);
      // $("#mCategory").val(category);
      // $("#mComment").val(comment);
      // $("#mUrl").val(url);
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