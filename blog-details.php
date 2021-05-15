<?php
$pagetitle = "Blog Details";

    include("header.php");
    // get total sermon from database

    if(isset($_GET['blog']) && !empty($_GET['blog'])){
    $blogid = $_GET['blog'];

    function test_input($data) 
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

		$blogs = mysqli_query($church, "SELECT * FROM blog where id ='$blogid' ");
		$blog = mysqli_fetch_array($blogs);
      $errors =[];
    if(isset($_POST['postcomment'])){
      if(empty($_POST['name'])){
        $errors['name'] = "Please provide your fullname";
      }

      if(empty($_POST['email'])){
        $errors['email'] = "Please provide your email or phone number";
      }

      if(strlen($_POST['comment']) < 10){
        $errors['comment'] ="Please provide your comment in this comment box";
      }

      if(count($errors)==0){
        $name = test_input($_POST['name']);
        $email = test_input($_POST['email']);
        $comment = test_input($_POST['comment']);
        $status = "disabled";
        $query = mysqli_query($church, "INSERT INTO comment(name, email, comment, status, blog_id) VALUES('$name', '$email', '$comment', '$status', '$blogid')");
        if($query){
          echo "<script>
          alert('successfully posted for further check');
          </script>
";
          // header("location:blog-details.php");
        }
      }
    }
?>
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="width:100% ; object-fit:contain; background-image: url('admin/<?php echo $blog['image'] ?>'); ">
        <div class="overlay"></div>
        <div class="container-fluid">
            <div class="row no-gutters slider-text align-items-end js-fullheight">
            <div class="col-md-9 ftco-animate pb-5">
            <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span> <span>Blog details <i class="fa fa-chevron-right"></i></span></p>
            <h1 class="mb-0 bread"><?php echo $blog['title'] ?></h1>
            </div>
        </div>
        </div>
    </section>

    <section class="ftco-section">
  <div class="container-fluid">
    <!-- <div class="row d-flex"> -->
     
      <div class="col-md-12 col-lg-12 d-flex ftco-animate">
        <div class="blog-entry align-self-stretch">
          <!-- <a href="blog-single.html" class="block-20" style="background-image: url('admin/<?php //echo $blog['image'] ?>');"> -->
          </a>
          <div class="text p-4">
           <div class="meta mb-2">
            <div><a href="#"><?php echo date_format(date_create($blog['blog_date']), "M d, Y" ) ?></a></div>
            <div><a href="#"><?php echo $blog['user'] ?></a></div>
            <?php 
            $q = mysqli_query($church, "SELECT COUNT(id) AS totalcomment FROM comment WHERE blog_id= '$blogid' ");
            $comments = mysqli_fetch_array($q);
            $total = $comments['totalcomment'];
            ?>
            <div><a href="#" class="meta-chat"><span class="fa fa-comment"></span> <?php echo $total ?></a></div>
          </div>
        
          <?php echo strlen($blog['content']) > 300 ? html_entity_decode($blog['content']) : substr( html_entity_decode($blog['content']), 0 , 300 )  ?>        
        </div>
      </div>
    </div>

    <?php } ?>
 <div class="container" id="commentdetails">
   <?php 
   $comments = mysqli_query($church, "SELECT * FROM comment WHERE blog_id ='$blogid' AND status='enabled'");
   while($comment = mysqli_fetch_array($comments)){
   ?>
   <div class="card w-75 rounded my-2">
   <!-- <div class="item"> -->
							<div class="testimony-wrap d-md-flex">
								<div class="user-img" style="background-image: url('testimonies/avatar.jpg')">
								</div>
								<div class="text pl-md-3">
									<span class="quote d-flex align-items-center justify-content-center">
										<i class="fa fa-quote-left"></i>
									</span>
									<?php echo html_entity_decode($comment['comment']) ?>
									<p class="name"><?php echo ucwords($comment['name']) ?></p>
                  <small class="text-muted "><?php echo date_format(date_create($comment['comment_date']), "M d, Y" ) ?></small>
								</div>
							</div>
						<!-- </div> -->
   </div>
   <?php } ?>
 </div>
</div>


<div class="card card-primary container">
  <!-- <div class="card-header">
  </div> -->
  <!-- /.card-header -->
  <!-- form start -->
  <form role="form" method="POST">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="Topic">Fullname:</label>
            <input type="text" class="form-control" name="name" placeholder="Full name">
            <span class="text-danger">
                <?php echo isset($errors['name'])?$errors['name']:"" ?>
              </span>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="Topic">Email or Phone number:</label>
            <input type="text" class="form-control"  name="email" placeholder="Email or phone number">
            <span class="text-danger">
                <?php echo isset($errors['email'])?$errors['email']:"" ?>
              </span>
          </div>
        </div>
      </div>
    
     <div class="form-group">
      <label for="comment">Blog:</label>
      <textarea class="form-control blogcommentarea" rows="3" name="comment"></textarea>
      <span class="text-danger">
            <?php echo isset($errors['comment'])?$errors['comment']:"" ?>
          </span>

      </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary float-right text-uppercase" name="postcomment">Post a comment</button>
    </div>
  </form>
</div>
</div>

</section>



<?php
    include("footer.php")
?>
<script>
  $(function () {
  //Initialize Select2 Elements
  $('.blogcommentarea').summernote({
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