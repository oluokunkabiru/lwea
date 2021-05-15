<?php
  include('admin/connection.php');

  

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>LWEA | <?php echo $pagetitle ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- <link rel="stylesheet" href="admin/plugins/fontawesome-free/css/all.css"> -->
	
	<link rel="stylesheet" href="css/animate.css">
	
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<link rel="stylesheet" href="css/magnific-popup.css">


	<link rel="stylesheet" href="css/bootstrap-datepicker.css">
	<link rel="stylesheet" href="css/jquery.timepicker.css">

	<link rel="stylesheet" href="css/flaticon.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="admin/plugins/summernote/summernote-bs4.css">
	<style>
		#more {display: none;}
	</style>

</head>
<body>

	<div class="wrap">
		<div class="container-fluid ">
			<div class="row">
				<div class="col-md-6 d-flex align-items-center">
					<p class="mb-0 location">
						<span class="fa fa-map-marker mr-2 text-danger "> <i class="text-white" >Behind After fatigue guest house, off Offa Ajase-ipo road, Ijagbo, Kwara State</i> .</span>
					</p>
				</div>
				<div class="col-md-6 d-flex justify-content-md-end">
					<div class="social-media">
						<p class="mb-0 pt-2 d-flex">
							<a href="https://www.facebook.com/LWEAVideos/" class="d-flex align-items-center justify-content-center"><span class="fa fa-facebook text-danger"><i class="sr-only">Facebook</i></span></a>
							<a href="https://tinyurl.com/livingwordea" class="d-flex align-items-center justify-content-center"><span class="fa fa-twitter text-danger"><i class="sr-only">Twitter</i></span></a>
							<a href="https://www.instagram.com/lccilwea/" class="d-flex align-items-center justify-content-center"><span class="fa fa-instagram text-danger"><i class="sr-only">Instagram</i></span></a>
							<a href="tinyurl.com/DrFaithOniyaTV" class="d-flex align-items-center justify-content-center"><span class="fa fa-youtube text-danger"><i class="sr-only">Youtube</i></span></a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
		<div class="container-fluid">
			<a class="navbar-brand mb-0 p-0" href="index.php">Living Word</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="true" aria-label="Toggle navigation">
				
				<span class="oi oi-menu fa fa-bars"></span> 
			</button>

			<div class="collapse navbar-collapse " id="ftco-nav">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item <?php  echo $homeactive ?>"><a href="index.php" class="nav-link">Home</a></li>
					<li class="nav-item  <?php  echo $aboutactive ?>" ><a href="about.php" class="nav-link">About</a></li>
					<li class="nav-item  <?php  echo $ministeractive ?>"><a href="ministries.php" class="nav-link">Ministries</a></li>
					<li class="nav-item  <?php  echo $sermonsactive ?>"><a href="sermons.php" class="nav-link">Sermons</a></li>
					<li class="nav-item  <?php  echo $galleryactive ?>"><a href="gallery.php" class="nav-link">Gallery</a></li>
					<li class="nav-item  <?php  echo $eventsactive ?>"><a href="events.php" class="nav-link">Events</a></li>
					<li class="nav-item  <?php  echo $blogactive ?>"><a href="blog.php" class="nav-link">Blog</a></li>
					<li class="nav-item  <?php  echo $contactactive ?>"><a href="contact.php" class="nav-link">Contact</a></li>
					<li class="nav-item cta" ><a href="#" class="nav-link" >Donate</a>
					</li>
				</ul>
		</div>
		</div>

	</nav>
	<!-- END nav -->
