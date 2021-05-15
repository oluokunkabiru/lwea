<?php

    // get total sermon from database
		$total = mysqli_query($church, "SELECT COUNT(id) AS totalBlog FROM blog ");
		// fetch database query 
		$totalSermon = mysqli_fetch_array($total);
		// fetch result from databse query
		$totalPage = $totalSermon['totalBlog'];
		// checking if the result is number
		$page = isset($_GET['page']) && is_numeric($_GET['page'])?$_GET['page']:1;
		// numbers of item to be display
		$limit = 2;
		// calculate pages
		$calculatePage = ($page - 1)*$limit;

?>

<footer class="footer">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6 col-lg-3 mb-4 mb-md-0">
					<h2 class="footer-heading">LWEA</h2>
					<address style="color: white;">LWEA, HQ<br>
					Camp Zion,<br>
					Off Offa-Ajasse Expressway,<br>
					Beside After Fatigue Guest House,<br>
					Ijagbo, Kwara State,<br>
					Nigeria</address>
					<address style="color: white;">
					LWEA, OSUN<br>
					Ajibolayan Shopping Complex<br>
					Gandhi Bus Stop, 
					Beside Hotel De Charity,
					Kobongbogboe, Area,
					Osogbo, Osun State,
					Nigeria.
					</address>
					<ul class="ftco-footer-social p-0">
						<li class="ftco-animate"><a href="https://tinyurl.com/livingwordea" data-toggle="tooltip" data-placement="top" title="Twitter"><span class="fa fa-twitter"></span></a></li>
						<li class="ftco-animate"><a href="https://www.facebook.com/LWEAVideos/" data-toggle="tooltip" data-placement="top" title="Facebook"><span class="fa fa-facebook"></span></a></li>
						<li class="ftco-animate"><a href="https://www.instagram.com/lccilwea/" data-toggle="tooltip" data-placement="top" title="Instagram"><span class="fa fa-instagram"></span></a></li>
						<li class="ftco-animate"><a href="tinyurl.com/DrFaithOniyaTV" data-toggle="tooltip" data-placement="top" title="youtube"><span class="fa fa-youtube"></span></a></li>

					</ul>
				</div>
				<div class="col-md-6 col-lg-3 mb-4 mb-md-0">
					<h2 class="footer-heading">Latest News</h2>
					<?php
						$blog = mysqli_query($church, "SELECT * FROM blog ORDER BY id DESC LIMIT $calculatePage , $limit");
						while($blogs = mysqli_fetch_array($blog)){
						// echo $blogs['id'];
						$blogid = $blogs['id'];
					?>

					<div class="block-21 mb-4 d-flex">
						<a class="img mr-4 rounded" style="background-image: url('admin/<?php echo $blogs['image'] ?>');"></a>
						<div class="text">
							
							<h3 class="heading"><a href="blog.php?blog=<?php echo $blogs['id'] ?>"><?php echo $blogs['title'] ?></a></h3>
							<div class="meta">
								<div><a href="#"><?php echo date_format(date_create($blogs['blog_date']), "M d, Y" ) ?></a></div>
								<div><a href="#"><?php echo $blogs['user'] ?></a></div>
								<?php 
								$q = mysqli_query($church, "SELECT COUNT(id) AS totalcomment FROM comment WHERE blog_id= '$blogid' ");
								$comments = mysqli_fetch_array($q);
								$total = $comments['totalcomment'];
								?>
								<div><a href="blog-details.php?blog=<?php echo $blogs['id'] ?>" class="meta-chat"><span class="fa fa-comment"></span> <?php echo $total ?></a></div>

							</div>
						</div>
					</div>
					<?php } ?>
				</div>
				<div class="col-md-6 col-lg-3 pl-lg-5 mb-4 mb-md-0">
					<h2 class="footer-heading">Quick Links</h2>
					<ul class="list-unstyled">
						<li><a href="index.php" class="py-2 d-block">Home</a></li>
						<li><a href="about.php" class="py-2 d-block">About</a></li>
						<li><a href="sermon.php" class="py-2 d-block">Sermons</a></li>
						<li><a href="event.php" class="py-2 d-block">Events</a></li>
						<li><a href="blog.php" class="py-2 d-block">Blog</a></li>
						<li><a href="contact.php" class="py-2 d-block">Contact</a></li>
					</ul>
				</div>
				<div class="col-md-6 col-lg-3 mb-4 mb-md-0">
					<h2 class="footer-heading">Have a Questions?</h2>
					<div class="block-23 mb-3">
						<ul>
							<li><a href="contact.php"><span class="icon fa fa-phone"></span><span class="text">+234 8068828370</span></a></li>
							<li><a href="mailto:lccilwea@gmail.com"><span class="icon fa fa-paper-plane"></span><span class="text">info@livingwordea.org</span></a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="row mt-5">
				<div class="col-md-12 text-center">

					<p class="copyright">
					<strong>Copyright &copy; <?php echo date('Y') ?> LWEA </strong>
					All rights reserved.

					</div>
				</div>
			</div>
		</footer>

		
		

		<!-- loader -->
		<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>



		
	</body>
	</html>
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery-migrate-3.0.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.easing.1.3.js"></script>
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/jquery.stellar.min.js"></script>
	<script src="js/jquery.animateNumber.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/jquery.timepicker.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/scrollax.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
	<script src="js/google-map.js"></script>
	<script src="js/main.js"></script>
	<script src="admin/plugins/summernote/summernote-bs4.min.js"></script>
	<script>
		function myFunction() {
		  var dots = document.getElementById("dots");
		  var moreText = document.getElementById("more");
		  var btnText = document.getElementById("myBtn");
		
		  if (dots.style.display === "none") {
			dots.style.display = "inline";
			btnText.innerHTML = "Read more"; 
			moreText.style.display = "none";
		  } else {
			dots.style.display = "none";
			btnText.innerHTML = "Read less"; 
			moreText.style.display = "inline";
		  }
		}
	</script>