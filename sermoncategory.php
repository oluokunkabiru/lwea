<?php
$pagetitle = "sorted event";

  include("header.php");

  	// for sermon
	// get total sermon from database
	$total = mysqli_query($church, "SELECT COUNT(id) AS totalGroupSermon FROM sermon");
	// fetch database query 
	$totalSermon = mysqli_fetch_array($total);
	// fetch result from databse query
	$totalPage = $totalSermon['totalGroupSermon'];
	// checking if the result is number
	$pages = isset($_GET['page']) && is_numeric($_GET['page'])?$_GET['page']:1;
	// numbers of item to be display
	$limit = 3;
	// calculate pages
	$calculatePage = ($pages - 1)*$limit;
	$category = isset($_GET['category'])?$_GET['category']:"";

?>



<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/about-33.jpeg');">
  <div class="overlay"></div>
  <div class="container-fluid">
    <div class="row no-gutters slider-text js-fullheight align-items-end">
      <div class="col-md-9 ftco-animate pb-5">
       <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.php">Home <i class="fa fa-chevron-right"></i></a></span> <span>Sorted Sermon <i class="fa fa-chevron-right"></i></span></p>
       <h1 class="mb-0 bread">Sorted Sermon</h1>
     </div>
   </div>
 </div>
</section>

<section class="ftco-section">
		<div class="container-fluid">
			<div class="row justify-content-center pb-5 mb-3">
				<div class="col-md-7 heading-section text-center ftco-animate">
					<span class="subheading">Our Sermons</span>
					<h2>Watch and Listen to our Sermons</h2>
				</div>
			</div>

			<?php
			    $selectfromdatabase = "SELECT sermon.*, Categories.catgories AS categoryname FROM sermon JOIN Categories ON sermon.Categories = Categories.id WHERE  sermon.Categories='$category'  ORDER BY sermon.id DESC LIMIT $calculatePage , $limit ";
				$fselect = mysqli_query($church,$selectfromdatabase);
				while($ffselec= mysqli_fetch_array($fselect)){
					$sermonid = $ffselec['sermonid'];
			?>

			<div class="row no-gutters d-flex sermon-wrap ftco-animate bg-light">
				<div class="col-md-6 d-flex align-items-stretch js-fullheight ftco-animate">
					<a href="#" class="img" style="background-image: url('admin/<?php echo ucfirst($ffselec['Pictures']) ;?>');"></a>
				</div>
				<div class="col-md-6 py-4 py-md-5 ftco-animate d-flex align-items-center">
					<div class="text p-md-5">
						<h2 class="mb-4"><?php echo ucfirst($ffselec['Topic']) ;?></h2>
						<div class="meta">
							<p>
								<span> Minister: <a href="#" disabled class="ptr"><?php echo ucfirst($ffselec['minister']) ?></a></span>
								<span>Categories:<?php
								// $comma=0;
								$cat = mysqli_query($church, "SELECT Categories.catgories AS category, Categories.id AS categoryid, sermon.sermonid AS sermonid FROM Categories JOIN sermon ON Categories.id = sermon.Categories WHERE sermon.sermonid = '$sermonid'  ");
								while($categegory = mysqli_fetch_array($cat)){
								
				?>

				<a href="sermoncategory.php?category=<?php echo $categegory['categoryid'] ?>&categorise=<?php echo ucfirst($categegory['category']) ?>"><?php echo ucfirst($categegory['category']) ?> | <?php  ?>  </a>
									
									<?php
								// $comma++;
								} ?>
								<!-- <a href="#"></a><?php// echo ucfirst($ffselec['categoryname']) ;?>, <a href="#">Pray</a>, <a href="#">Faith</a></span> -->
								<span><a href="#">On <?php echo date_format(date_create($ffselec['date']), "D d M, Y" ) ?></a></span>
							</p>
						</div>
						<p><?php echo htmlspecialchars_decode( ucfirst($ffselec['Comment'])) ;?></p>
						<p class="mt-4 btn-customize">
							<a href="<?php echo ($ffselec['Link']) ;?>" class="btn btn-primary px-4 py-3 mr-md-2 popup-vimeo"><span class="fa fa-play"></span> Watch Sermons</a> <a href="#" class="btn btn-primary btn-outline-primary px-4 py-3 ml-lg-2"><span class="fa fa-download"></span> Download Sermons</a>
						</p>
					</div>
				</div>
			</div>
<?php } ?>
	</section>


<?php 
    include("footer.php"); 
?>
