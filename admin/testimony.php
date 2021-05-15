<?php
  session_start();
  include("connection.php");
  if(isset($_SESSION['phonenumber'])){
    $usernumer  = $_SESSION['phonenumber'];
    $qu = mysqli_query($church, "SELECT* FROM addadmin WHERE phonenumber='$usernumer'");
    $admin = mysqli_fetch_array($qu);
    $adminarea = $admin['admintype'];
    $success=$fail="";
 //  }

  // include("connection.php");

  if(isset($_GET['disable'])){
    $id = $_GET['disable'];
    $q = mysqli_query($church, "UPDATE testimony SET status='disabled' WHERE id='$id'");
    if($q){
      $success = "Testimony disabled successfullty";
      header("location:testimony.php");
    }else{
      $fail = "Testimony fail to disabled ". mysqli_error($church);
    }
  }
  if(isset($_GET['enable'])){
    $id = $_GET['enable'];
    $q = mysqli_query($church, "UPDATE testimony SET status='enabled' WHERE id='$id'");
    if($q){
      $success = "Testimony enabled successfullty";
      header("location:testimony.php");
    }else{
      $fail = "Testimony fail to enabled ". mysqli_error($church);
    }
  }

  if(isset($_GET['deleteTestimony'])){
    $id = $_GET['deleteTestimony'];
    $pr = mysqli_query($church, "SELECT * FROM testimony WHERE id ='$id'");
    $dat = mysqli_fetch_array($pr);
    $picture = $dat['picture'];
    if(!empty($picture)){
          unlink("../".$picture);
    }
    
    $q = mysqli_query($church, "DELETE FROM testimony WHERE id='$id'");
    if($q){
      $success = "Testimony deleted successfullty";
      header("location:testimony.php");
    }else{
      $fail = "Testimony fail to delete ". mysqli_error($church);
    }

  }

  $lwea=[];
function test_input($data) 
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = str_replace("'", "&apos;", $data);
    return $data;
}

if (isset($_POST['updatebutton'])) {
    $id =  $_POST['editId'];
    $previousSermon= "SELECT* FROM testimony WHERE id='$id'";
    $qPreviouseSermon = mysqli_query($church,$previousSermon);
    $previousSermonData = mysqli_fetch_array($qPreviouseSermon);


  if (empty($_POST["name"])) {
    $lwea['title']="input name";
  } else {
    $title = test_input($_POST["name"]);
  }
  if (empty($_POST["testimony"])) {
    $lwea['date']="input testimony";
  } else {
    $date = test_input($_POST["testimony"]);
  }

  $target_dir = "testimonies/";
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
        unlink($previousSermonData['picture']);
    } else{
      $lwea['image']="Please fill the required areas above";
    }

    }else{
    $target_file =$previousSermonData['picture']; 
  }

  // foreach($lwea as $err){
  //   echo "<br> $err";
  // }

  if (count($lwea) ==0) {
    $id =  $_POST['editId'];
    $title = test_input($_POST["name"]);
    $date = test_input($_POST["testimony"]);
    // echo "id = $id <br>Titke = $title <br> date  = $date";

    // foreach ($categories as $category) {
      # code...
      $new= mysqli_query($church, "UPDATE testimony set name='$title',testimony='$date',picture='$target_file' WHERE id= $id");
      // }
    if($new){
      $success = "Testimony updated Successfully ";
    }
    else{
      $fail = "Testimony fail to update ".mysqli_error($church);
    }
  }


}

  $pagetitle = "Testimony management";

  $adminname = ucwords($admin['firstname']." ". $admin['lastname']);

  include("header.php");

  ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-">
          <h1>Manage Testimony</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="Dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Manage Testimony</li>
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
            <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap" id="manageTestimony">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Testimony</th>
                      <th>Poster Image</th>
                      <th>Status</th>
                      <th>Date</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php

                      	$i=0;
						$testi = mysqli_query($church, "SELECT * FROM testimony ORDER BY id DESC");
						while($testimony = mysqli_fetch_array($testi)){
              $image = !empty($testimony['picture'])?$testimony['picture']:"testimonies/avatar.jpg";

                    $enable= '<a href="testimony.php?disable='.$testimony["id"].'" class="btn btn-success"><span class="fa fa-check"></span></a>';
                    $disable= '<a href="testimony.php?enable='.$testimony["id"].'" class="btn btn-danger"><span class="fa fa-times"></span></a>';
                     $status = $testimony['status']=="disabled" ? $disable : $enable;
                    ?>
                    <tr>
                   
                      <?php echo '<td>' . ++$i.'</td>' ;?>
                      <?php echo '<td>'. ucfirst($testimony['name']) .'</td>' ;?>
                      <?php echo '<td>'. htmlspecialchars_decode(ucfirst($testimony['testimony'])) .'</td>' ;?>
                      <?php echo '<td> <img style="width: 100px;" class="rounded card-img" src= "../'.$image .'"></td>' ;?>
                      <?php echo '<td>'. $status .'</td>' ;?>
                      <?php echo '<td>'. ucfirst($testimony['testimony_date']) .'</td>' ;?>

                      <td>
                   
                        <i title="Edit Sermon" data-toggle="modal" 
                          id="<?php echo $testimony['id'] ;?>"
                          category= "<?php echo ucfirst($testimony['name'])  ?>"
                          topic = "<?php echo ucfirst($testimony['testimony'])  ?>"
                          comment = "<?php echo ucfirst($testimony['picture']) ?>"
                          data-target="#editModal" class="fa fa-edit">
                        </i>
                        <a href="testimony.php?deleteTestimony=<?php  echo $testimony['id'] ?>"><i class="fa fa-trash text-danger" onclick="return confirm('Are you sure you want to delete this item?');" > </i></a>
                         
                      </td>
                    </tr>


                    <?php } ?>
                  </tbody>
                  <div class="modal fade" id="editModal">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                  <h4 class="modal-title text-dark">Edit Testimony</h4>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body text-dark">
                                <form action="testimony.php" method="post" enctype="multipart/form-data">

                                <div class="form-group">
                                    <!-- <label for="Url">id </label> -->
                                    <input type="hidden" class="form-control" name="editId" id="editId" placeholder="Full Name">
                                    <span class="text-danger nameError">
                                    </span>
                          
                                    </div>

                                  <div class="form-group">
                                    <label for="Url">Fullname </label>
                                    <input type="text" class="form-control" name="name" id="editCategory"placeholder="Full Name">
                                    <span class="text-danger nameError">
                                    </span>
                          
                                    </div>
                                    <div class="form-group">
                                    <label for="comment">Picture:</label>
                                    <input type="file" class="form-control-file border" id="editComment" accept="image/*" name="InputFile">
                                    </div>
                                    <span class="text-danger imageError">
                                    </span>
                          
                                    <div class="form-group">
                                    <label for="comment">Testimony:</label>
                                    <textarea class="form-control testimonyarea" id="editTopic" rows="3" name="testimony"></textarea>
                                    <span class="text-danger testimoneyError">
                                    </span>
                            
                                    </div>
                                      <button id="testimonybtn" name="updatebutton" class="btn btn-primary btn-rounded mx-2 float-right">Edit</button>
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
    $("#manageTestimony").DataTable();


  })
  function ConfirmDelete()
    {
      var x = confirm("Are you sure you want to delete?");
      if (x)
          return true;
      else
        return false;
    }




	//   $("#testimonybtn").on('click', function(e){
	// 	var form = $("#testimonyform")[0];
	// 	var forData = new FormData(form);
	// 	$.ajax({
	// 		type:"POST",
	// 		url:"addtestimony.php",
	// 		data:forData,
	// 		// dataType:JSON,
	// 		success:function(data){
	// 			var result = JSON.parse(data);
	// 			if(result.name){
	// 			$(".nameError").text(result.name);
	// 			}
	// 			if(result.testimony){
	// 			$(".testimoneyError").text(result.testimony);
	// 			}
	// 			if(result.image){
	// 			$(".imageError").text(result.image);
	// 			}
	// 			if(result.success){
	// 				$(".success").text(result.success);
	// 				setTimeout(() => {
	// 					// alert("done");
	// 					window.location.reload()
	// 				}, 200);
	// 			}
	// 			if(result.fail){
	// 				$(".fail").text(result.fail);
	// 			}
	// 		},
	// 		cache:false,
	// 		contentType:false,
	// 		processData:false
	// 	});

	// 	e.preventDefault();

	//   })
  
	// })

  $('#editModal').on('show.bs.modal',function(e){
      var id = $(e.relatedTarget).attr('id');
      var topic = $(e.relatedTarget).attr('topic');
      var category = $(e.relatedTarget).attr('category');
      var comment = $(e.relatedTarget).attr('comment');
      

      $("#editId").val(id);
      $("#editTopic").val(topic);
      $("#editCategory").val(category);
      $("#editComment").attr('src', comment);

      $('.testimonyarea').summernote({
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