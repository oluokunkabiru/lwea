<?php
$sermonsactive = "active";
$pagetitle = "Sermons";

    include("header.php");
		// get total sermon from database
		$total = mysqli_query($church, "SELECT COUNT( DISTINCT sermonid) AS totalGroupSermon FROM sermon");
		// fetch database query 
		$totalSermon = mysqli_fetch_array($total);
		// fetch result from databse query
		$totalPage = $totalSermon['totalGroupSermon'];
		// checking if the result is number
		$page = isset($_GET['page']) && is_numeric($_GET['page'])?$_GET['page']:1;
		// numbers of item to be display
		$limit = 6;
		// calculate pages
		$calculatePage = ($page - 1)*$limit;

?>

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/sermon.png');">
  <div class="overlay"></div>
  <div class="container-fluid">
    <div class="row no-gutters slider-text js-fullheight align-items-end">
      <div class="col-md-9 ftco-animate pb-5">
       <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.php">Home <i class="fa fa-chevron-right"></i></a></span> <span>Sermons <i class="fa fa-chevron-right"></i></span></p>
       <h1 class="mb-0 bread">Sermons</h1>
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
			// GROUP BY sermon.sermonid
			    $selectfromdatabase = "SELECT sermon.*, categories.catgories AS categoryname FROM sermon JOIN categories ON sermon.categories = categories.id  ORDER BY sermon.id DESC LIMIT $calculatePage , $limit ";
				$fselect = mysqli_query($church,$selectfromdatabase);
				while($ffselec= mysqli_fetch_array($fselect)){
					$sermonid = $ffselec['sermonid'];
			?>

			<div class="row no-gutters d-flex sermon-wrap ftco-animate bg-light">
				<div class="col-md-6 d-flex align-items-stretch js-fullheight ftco-animate">
					<a href="#" class="img" style="background-image: url('admin/<?php echo ($ffselec['Pictures']) ;?>');"></a>
				</div>
				<div class="col-md-6 py-4 py-md-5 ftco-animate d-flex align-items-center">
					<div class="text p-md-5">
						<h2 class="mb-4"><?php echo ucfirst($ffselec['Topic']) ;?></h2>
						<div class="meta">
							<p>
								<span> Minister: <a href="#" disabled class="ptr"><?php echo ucfirst($ffselec['minister']) ?></a></span>
								<span>Categories:<?php
								// $comma=0;
								$cat = mysqli_query($church, "SELECT categories.catgories AS category, categories.id AS categoryid, sermon.sermonid AS sermonid FROM categories JOIN sermon ON categories.id = sermon.categories WHERE sermon.sermonid = '$sermonid'  ");
								while($categegory = mysqli_fetch_array($cat)){
								
				?>

							<a href="<?php echo $categegory['categoryid'] ?>"><?php echo ucfirst($categegory['category']) ?> | <?php  ?>  </a>
									
									<?php
								// $comma++;
								} ?>
								<!-- On Sunday 13 Jan, 2019 -->
								<!-- <a href="#"></a><?php// echo ucfirst($ffselec['categoryname']) ;?>, <a href="#">Pray</a>, <a href="#">Faith</a></span> -->
								<span><a href="#">On <?php echo date_format(date_create($ffselec['date']), "D d M, Y" ) ?></a></span>
							</p>
						</div>
						<p><?php echo htmlspecialchars_decode( ucfirst($ffselec['Comment'])) ;?></p>
						<p class="mt-4 btn-customize">
							<a href="<?php echo ($ffselec['Link']) ;?>" class="btn btn-primary px-4 py-3 mr-md-2 popup-vimeo"><span class="fa fa-play"></span> Watch Sermons</a> <a href="http://t.me/ApostleFaithOniya" class="btn btn-primary btn-outline-primary px-4 py-3 ml-lg-2"><span class="fa fa-download"></span> Download Sermons</a>
						</p>
					</div>
				</div>
			</div>
<?php } ?>
		</div>

        <div class="row mt-5">
        <div class="col text-center">
            <div class="block-27">
            <!-- <ul>
                <li><a href="#">&lt;</a></li>
                <li class="active"><span>1</span></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">&gt;</a></li>
            </ul> -->

			<?php
			if (ceil(($totalPage/$limit)) > 0){;?>
			 
	   <ul class="">
		   <?php if ($page > 1){ ?>
		 <li class=""><a class="" href="sermons.php?page=<?php echo $page-1 ?>">&lt;</a></li>
		 <?php }; ?>
	   
		   <?php if ($page > 3){ ?>
		 <li class=""><a class="" href="sermons.php?page=1">1</a></li>
		   <li class="">...</li>
		 <?php } ; ?>
	   
		 <?php if ($page-2 > 0){ ?><li class="page "><a class="" href="sermons.php?page=<?php echo $page-2 ?>"><?php echo $page-2 ?></a></li><?php }; ?>
		 <?php if ($page-1 > 0){?><li class="page "><a class="" href="sermons.php?page=<?php echo $page-1 ?>"><?php echo $page-1 ?></a></li><?php }; ?>
	   
		 <li class="active "><a class="" href="sermons.php?page=<?php echo $page ?>"><?php echo $page ?></a></li>
	   
		 <?php if ($page+1 < ceil($totalPage / $limit)+1){ ?><li class="page "><a class="" href="sermons.php?page=<?php echo $page+1 ?>"><?php echo $page+1 ?></a></li><?php }; ?>
		 <?php if ($page+2 < ceil($totalPage / $limit)+1){ ?><li class="page "><a  class="" href="sermons.php?page=<?php echo $page+2 ?>"><?php echo $page+2 ?></a></li><?php }; ?>
	   
		   <?php if ($page < ceil($totalPage / $limit)-2){ ?>
		   <li class="">...</li>
		 <li class=""><a class="" href="sermons.php?page=<?php echo ceil($totalPage / $limit) ?>"><?php echo ceil($totalPage / $limit) ?></a></li>
		 <?php }; 
	   
	   
		 ?>
		 <?php if ($page < ceil($totalPage / $limit)){ ?>
		   <li class=""><a class="" href="sermons.php?page=<?php echo $page+1 ?>">&gt;</a></li>
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