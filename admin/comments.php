<?php
  session_start();
  include("connection.php");
  if(isset($_SESSION['phonenumber'])){
    $usernumer  =$_SESSION['phonenumber'];
    $qu = mysqli_query($church, "SELECT* FROM addadmin WHERE phonenumber='$usernumer'");
    $admin = mysqli_fetch_array($qu);
    $adminarea = $admin['admintype'];
 //  }

  // include("connection.php");

  if(isset($_GET['disable'])){
    $id = $_GET['disable'];
    $q = mysqli_query($church, "UPDATE  comment SET status='disabled' WHERE id='$id'");
    if($q){
          header('location:comments.php');

    }
  }
  if(isset($_GET['enable'])){
    $id = $_GET['enable'];
    $q = mysqli_query($church, "UPDATE  comment SET status='enabled' WHERE id='$id'");

    if($q){
      header('location:comments.php');

}
  }

  if(isset($_GET['deleteComment'])){
    $id = $_GET['deleteComment'];
    
    $q = mysqli_query($church, "DELETE FROM  comment WHERE id='$id'");
    if($q){
      header('location:comments.php');

}


  }
  
  function test_input($data) 
  {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
  }

  $errors=[];
  if(isset($_POST['updatecomment'])){
    if(empty($_POST['name'])){
      $errors['name'] = "Please provide your fullname";
    }

    // if(empty($_POST['email'])){
    //   $errors['email'] = "Please provide your email or phone number";
    // }

    if(strlen($_POST['comment']) < 10){
      $errors['comment'] ="Please provide your comment in this comment box";
    }

    if(count($errors)==0){
      $name = test_input($_POST['name']);
      $id = $_POST['id'];
      $comment = test_input($_POST['comment']);
      $q = mysqli_query($church, "UPDATE comment SET comment='$comment', name='$name' WHERE id ='$id'");

          if($q){
              header('location:comments.php');
        }

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
        <div class="col-sm-9">
          <h1>Manage Blog comment</h1>
        </div>
        <div class="col-sm-3">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="Dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Manage Comment</li>
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
          <?php 
          foreach ($errors as $error) {
            ?>
            <div class="alert alert-danger  alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong><?php echo $error ?></strong> 
            </div>
            <?php
          }
          ?>
          <div class="card card-primary">
            <!-- <div class="card-header">
              </div> -->
            <!-- /.card-header -->
            <!-- form start -->
            <div class="card-body table-responsive p-0" style="heit: 300px;">
                <table class="table table-head-fixed text-nowrap" id="comment">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email/Phone Number</th>
                      <th>Comment</th>
                      <th>Status</th>
                      <th>Date</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i =0;
                    $c = mysqli_query($church, "SELECT * FROM comment ORDER BY id DESC");
                    while($comment = mysqli_fetch_array($c)){
                      $enable= '<a href="comments.php?disable='.$comment["id"].'" class="btn btn-success"><span class="fa fa-check"></span></a>';
                      $disable= '<a href="comments.php?enable='.$comment["id"].'" class="btn btn-danger"><span class="fa fa-times"></span></a>';
                       $status = $comment['status']=="disabled" ? $disable : $enable;
                    ?>
                    <tr>
                      <td><?php echo ++$i ?></td>
                      <td><?php echo ucwords($comment['name']) ?></td>
                      <td><?php echo $comment['email'] ?></td>
                      <td><?php echo ucfirst(html_entity_decode($comment['comment'])) ?></td>
                      <td><?php echo $status ?></td>
                      <td><?php echo $comment['comment_date'] ?></td>
                      <td>
                        <div class="row">
                          <div class="col">
                            <a href="#edit" class="text-success" id=<?php echo $comment['id'] ?> name=<?php echo ucwords($comment['name']) ?> comment="<?php echo ucfirst(html_entity_decode($comment['comment'])) ?>" email="<?php echo $comment['email'] ?>" data-toggle="modal"><span class="fa fa-edit"></span></a>
                          </div>
                          <div class="col">
                            <a href="comments.php?deleteComment=<?php echo $comment['id'] ?>" class="text-danger"><span class="fa fa-trash " onclick="return confirm('Are you sure you want to delete this item?');" ></span></a>
                          </div>
                        </div>
                      </td>
                    </tr>

                    <?php } ?>
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

function ConfirmDelete()
    {
      var x = confirm("Are you sure you want to delete?");
      if (x)
          return true;
      else
        return false;
    }

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