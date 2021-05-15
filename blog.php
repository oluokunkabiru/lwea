<?php
$blogactive = "active";
$pagetitle = "Blog";

    include("header.php");
    // get total sermon from database
		$total = mysqli_query($church, "SELECT COUNT(id) AS totalBlog FROM blog ");
		// fetch database query 
		$totalSermon = mysqli_fetch_array($total);
		// fetch result from databse query
		$totalPage = $totalSermon['totalBlog'];
		// checking if the result is number
		$page = isset($_GET['page']) && is_numeric($_GET['page'])?$_GET['page']:1;
		// numbers of item to be display
		$limit = 6;
		// calculate pages
		$calculatePage = ($page - 1)*$limit;

?>
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/blog.png');">
        <div class="overlay"></div>
        <div class="container-fluid">
            <div class="row no-gutters slider-text align-items-end js-fullheight">
            <div class="col-md-9 ftco-animate pb-5">
            <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.php">Home <i class="fa fa-chevron-right"></i></a></span> <span>Blog <i class="fa fa-chevron-right"></i></span></p>
            <h1 class="mb-0 bread">Our Blog</h1>
            </div>
        </div>
        </div>
    </section>

    <section class="ftco-section">
  <div class="container-fluid">
    <div class="row d-flex">
      <?php
        $blog = mysqli_query($church, "SELECT * FROM blog ORDER BY id DESC LIMIT $calculatePage , $limit");
        while($blogs = mysqli_fetch_array($blog)){
          // echo $blogs['id'];
          $blogid = $blogs['id'];
      ?>
      <div class="col-md-6 col-lg-4 d-flex ftco-animate">
        <div class="blog-entry align-self-stretch">
          <a href="blog-single.html" class="block-20" style="background-image: url('admin/<?php echo $blogs['image'] ?>');">
          </a>
          <div class="text p-4">
           <div class="meta mb-2">
            <div><a href="#"><?php echo date_format(date_create($blogs['blog_date']), "M d, Y" ) ?></a></div>
            <div><a href="#"><?php echo $blogs['user'] ?></a></div>
            <?php 
            $q = mysqli_query($church, "SELECT COUNT(id) AS totalcomment FROM comment WHERE blog_id= '$blogid' ");
            $comments = mysqli_fetch_array($q);
            $total = $comments['totalcomment'];
            ?>
            <div><a href="#" class="meta-chat"><span class="fa fa-comment"></span> <?php echo $total ?></a></div>
          </div>
          <h3 class="heading"><a href="#"><?php echo $blogs['title'] ?> </a></h3>
          <?php echo strlen($blogs['content']) < 300 ? html_entity_decode($blogs['content']) : substr( html_entity_decode($blogs['content']), 0 , 300 )  ?>       
           <p><a href="blog-details.php?blog=<?php echo $blogs['id'] ?>" class="btn btn-primary">Read more</a></p>
        </div>
      </div>
    </div>

    <?php } ?>
 
</div>
<div class="row mt-5">
  <div class="col text-center">
    <div class="block-27">
    <?php
			if (ceil(($totalPage/$limit)) > 0){;?>
			 
	   <ul class="">
		   <?php if ($page > 1){ ?>
		 <li class=""><a class="" href="blog.php?page=<?php echo $page-1 ?>">&lt;</a></li>
		 <?php }; ?>
	   
		   <?php if ($page > 3){ ?>
		 <li class=""><a class="" href="blog.php?page=1">1</a></li>
		   <li class="">...</li>
		 <?php } ; ?>
	   
		 <?php if ($page-2 > 0){ ?><li class="page "><a class="" href="blog.php?page=<?php echo $page-2 ?>"><?php echo $page-2 ?></a></li><?php }; ?>
		 <?php if ($page-1 > 0){?><li class="page "><a class="" href="blog.php?page=<?php echo $page-1 ?>"><?php echo $page-1 ?></a></li><?php }; ?>
	   
		 <li class="active "><a class="" href="blog.php?page=<?php echo $page ?>"><?php echo $page ?></a></li>
	   
		 <?php if ($page+1 < ceil($totalPage / $limit)+1){ ?><li class="page "><a class="" href="blog.php?page=<?php echo $page+1 ?>"><?php echo $page+1 ?></a></li><?php }; ?>
		 <?php if ($page+2 < ceil($totalPage / $limit)+1){ ?><li class="page "><a  class="" href="blog.php?page=<?php echo $page+2 ?>"><?php echo $page+2 ?></a></li><?php }; ?>
	   
		   <?php if ($page < ceil($totalPage / $limit)-2){ ?>
		   <li class="">...</li>
		 <li class=""><a class="" href="blog.php?page=<?php echo ceil($totalPage / $limit) ?>"><?php echo ceil($totalPage / $limit) ?></a></li>
		 <?php }; 
	   
	   
		 ?>
		 <?php if ($page < ceil($totalPage / $limit)){ ?>
		   <li class=""><a class="" href="blog.php?page=<?php echo $page+1 ?>">&gt;</a></li>
		 <?php };
			 }
		 ; ?>
	   </ul>
    </div>
  </div>
</div>
</div>
</section>



<?php
    include("footer.php")
?>