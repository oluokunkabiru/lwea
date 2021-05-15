<?php
  session_start();
  include("connection.php");
  if(isset($_SESSION['phonenumber'])){
    $usernumer  =$_SESSION['phonenumber'];
    $qu = mysqli_query($church, "SELECT* FROM addadmin WHERE phonenumber='$usernumer'");
    $admin = mysqli_fetch_array($qu);
    $adminarea = $admin['admintype'];
    $status = !empty($qData['status'])?$qData['status']:"";
    //  }

  // include("connection.php");

  if(isset($_GET['disable'])){
    $id = $_GET['disable'];
    
    $q = mysqli_query($church, "UPDATE  addadmin SET status='disabled' WHERE id='$id'");
    if($q){
          header('location:manage_admin.php');

    }
  }
  if(isset($_GET['enable'])){
    $id = $_GET['enable'];
    $q = mysqli_query($church, "UPDATE  addadmin SET status='enabled' WHERE id='$id'");

    if($q){
      header('location:manage_admin.php');

}
  }



  $adminname = ucwords($admin['firstname']." ". $admin['lastname']);

  $pagetitle = "Blog comments";
  include("header.php");

  ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-">
          <h1>Manage Admins</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="Dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Manage Admins</li>
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
            <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap" id="comment">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Phone Number</th>
                      <th>Username</th>
                      <th>Status</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i =0;
                    $c = mysqli_query($church, "SELECT * FROM addadmin ORDER BY id DESC");
                    while($comment = mysqli_fetch_array($c)){
                      $enable= '<a href="manage_admin.php?disable='.$comment["id"].'" class="btn btn-success"><span class="fa fa-check"></span></a>';
                      $disable= '<a href="manage_admin.php?enable='.$comment["id"].'" class="btn btn-danger"><span class="fa fa-times"></span></a>';
                       $status = $comment['status']=="disabled" ? $disable : $enable;
                      $admintype = $comment['admintype'];
                       if($admintype !="overall"){
                    ?>
                    <tr>
                      <td><?php echo ++$i ?></td>
                      <td><?php echo ucwords($comment['firstname']." ".$comment['lastname'] ) ?></td>
                      <td><?php echo $comment['phonenumber'] ?></td>
                      <td><?php echo ucwords($comment['username']) ?></td>
                      <td><?php echo $status ?></td>
                      <td><?php echo $comment['date'] ?></td>
                    </tr>

                    <?php } } ?>
                  </tbody>
                </table>
            </div>



          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- The Modal -->
<div class="modal" id="edit">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title text-uppercase"> edit <span id="commentname"></span> comment</h4>
        <button type="button" class="btn btn-danger" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form role="form" method="POST">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="Topic">Fullname:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Title">
            <span class="text-danger">
                <?php echo isset($errors['name'])?$errors['name']:"" ?>
              </span>
          </div>
        </div>
                      <input type="hidden" id="id" name="id">
        <div class="col-md-6">
          <div class="form-group">
            <label for="Topic">Email or Phone number:</label>
            <input type="text" disabled class="form-control" id="email" name="email" placeholder="Title">
            <span class="text-danger">
                <?php echo isset($errors['email'])?$errors['email']:"" ?>
              </span>
          </div>
        </div>
      </div>
    
     <div class="form-group">
      <label for="comment">Blog:</label>
      <textarea class="form-control mycomment" id="commentbox"rows="3" name="comment">
      </textarea>
      <span class="text-danger">
            <?php echo isset($errors['comment'])?$errors['comment']:"" ?>
          </span>

      </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary float-right text-uppercase" name="updatecomment">update comment</button>
    </div>
  </form>      </div>

     

    </div>
  </div>
</div>

</div>
<?php
include("footer.php");

}else{
    header('location:index.php');
  }
  
?>
<script>
      $("#comment").DataTable();

    $('#edit').on('show.bs.modal',function(e){
      var id = $(e.relatedTarget).attr('id');
    
      var name = $(e.relatedTarget).attr('name');
      var comment = $(e.relatedTarget).attr('comment');
      var email = $(e.relatedTarget).attr('email');

      $("#id").val(id);
      $("#name").val(name);
      $("#email").val(email);
      $("#commentbox").html(comment);
      $("#commentname").text(name);
        // alert(comment);

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