<?php
$pagetitle = "Event";
$eventsactive = "active";

    include("header.php");
	// for Events
	    // get total sermon from database
		// $totalEvent = mysqli_query($church, "SELECT COUNT(id) AS totalEvent FROM event ");
		// fetch database query 
		// $totalnoevent = mysqli_fetch_array($totalEvent);
		// fetch result from databse query
		// $totalPages = $totalnoevent['totalEvent'];
		// checking if the result is number
		// $eventpage = isset($_GET['page']) && is_numeric($_GET['page'])?$_GET['page']:1;
		// numbers of item to be display
		// $limitevent = 7;
		// calculate pages
		// $calculateeventpage = ($eventpage - 1)*$limitevent;	


		    // get total sermon from database
			$total = mysqli_query($church, "SELECT COUNT(id) AS totalEvent FROM event ");
			// fetch database query 
			$totalSermon = mysqli_fetch_array($total);
			// fetch result from databse query
			$totalPage = $totalSermon['totalEvent'];
			// checking if the result is number
			$page = isset($_GET['page']) && is_numeric($_GET['page'])?$_GET['page']:1;
			// numbers of item to be display
			$limit = 6;
			// calculate pages
			$calculatePage = ($page - 1)*$limit;
	
?>
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/events.png');">
		<div class="overlay"></div>
		<div class="container-fluid">
			<div class="row no-gutters slider-text align-items-end js-fullheight">
				<div class="col-md-9 ftco-animate pb-5">
					<p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span> <span>Events <i class="fa fa-chevron-right"></i></span></p>
					<h1 class="mb-0 bread">Events</h1>
				</div>
			</div>
		</div>
	</section>

    <section class="ftco-section">
		<div class="container-fluid">
			<div class="row justify-content-center pb-5 mb-3">
				<div class="col-md-7 heading-section text-center ftco-animate">
					<span class="subheading">Events</span>
					<h2>Upcoming Events</h2>
				</div>
			</div>

			<div class="row">
			<?php
					$event = mysqli_query($church, "SELECT * FROM event ORDER BY id DESC LIMIT $calculatePage , $limit");
					while($events = mysqli_fetch_array($event)){
					// echo $blogs['id'];
					$eventid = $events['id'];								
			?>

				<div class="col-md-12 event-wrap d-md-flex ftco-animate">
					<div class="img"style="background-image: url('admin/<?php echo $events['Pictures'] ?>');"></div>
					<div class="text p-4 px-md-5 d-flex align-items-center">
						<div class="desc">
							<h2 class="mb-4"><a href=""><?php echo $events['Title'] ?></a></h2>
							<div class="meta">
								<p>
									<span><i class="fa fa-calendar mr-2"></i><?php echo date_format(date_create($events['Date']), "M d, Y" ) ?></span>
									<span><i class="fa fa-map-marker mr-2"></i> <a ><?php echo $events['Venue'] ?></a></span>
									<span><i class="fa fa-building mr-2"></i><?php echo  htmlspecialchars_decode( ucfirst($events['About'])) ?></span>
								</p>
							</div>
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
		 <li class=""><a class="" href="event.php?page=<?php echo $page-1 ?>">&lt;</a></li>
		 <?php }; ?>
	   
		   <?php if ($page > 3){ ?>
		 <li class=""><a class="" href="event.php?page=1">1</a></li>
		   <li class="">...</li>
		 <?php } ; ?>
	   
		 <?php if ($page-2 > 0){ ?><li class="page "><a class="" href="blog.php?page=<?php echo $page-2 ?>"><?php echo $page-2 ?></a></li><?php }; ?>
		 <?php if ($page-1 > 0){?><li class="page "><a class="" href="blog.php?page=<?php echo $page-1 ?>"><?php echo $page-1 ?></a></li><?php }; ?>
	   
		 <li class="active "><a class="" href="event.php?page=<?php echo $page ?>"><?php echo $page ?></a></li>
	   
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