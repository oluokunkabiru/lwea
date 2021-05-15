<?php
$homeactive="active";
$pagetitle = "Home";

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

	// for Blogs
	    // get total sermon from database
		$totalEvent = mysqli_query($church, "SELECT COUNT(id) AS totalEvent FROM event ");
		// fetch database query 
		$totalnoevent = mysqli_fetch_array($totalEvent);
		// fetch result from databse query
		$totalPages = $totalnoevent['totalEvent'];
		// checking if the result is number
		$eventpage = isset($_GET['page']) && is_numeric($_GET['page'])?$_GET['page']:1;
		// numbers of item to be display
		$limitevent = 3;
		// calculate pages
		$calculateeventpage = ($eventpage - 1)*$limitevent;

		// for Events
	    // get total events from database
		$totalBlog = mysqli_query($church, "SELECT COUNT(id) AS totalBlog FROM blog ");
		// fetch database query 
		$totalnoblog = mysqli_fetch_array($totalBlog);
		// fetch result from databse query
		$totalPages = $totalnoblog['totalBlog'];
		// checking if the result is number
		$page = isset($_GET['page']) && is_numeric($_GET['page'])?$_GET['page']:1;
		// numbers of item to be display
		$limitblog = 3;
		// calculate pages
		$calculateblogpage = ($page - 1)*$limitblog;



	
?>

<section class="hero-wrap js-fullheight">
		<div class="home-slider js-fullheight owl-carousel">
		<?php 
					$gal = mysqli_query($church, "SELECT*  FROM  gallery ORDER BY  RAND() LIMIT 10");
					$index =0;
					while($gallery = mysqli_fetch_array($gal)){

					if($index%2){
				?>
			<div class="slider-item js-fullheight" style="background-image:url(admin/<?php echo $gallery['pictures'] ?>);">
				<div class="overlay"></div>
				<div class="container-fluid">
					<div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
						<div class="col-md-8 ftco-animate">
							<div class="text mt-md-5 w-100 text-center">
								<h2>Transforming Live</h2>
								<h1 class="mb-3">Total Surrender to God</h1>
								<p class="mb-4 pb-3">Surrender is trust. Trust is embrace. As you accept his embrace, you begin to understand why we are addicted to the word here. The warmth of his loving embrace holds us in blissful surrender.</p>
								<!-- <p class="mb-0"><a href="#" class="btn btn-primary py-3 px-2 px-md-4">Become A Volunteer</a></p> -->
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php }else{
			?>


			<div class="slider-item js-fullheight" style="background-image:url(admin/<?php echo $gallery['pictures'] ?>);">
				<div class="overlay"></div>
				<div class="container">
					<div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
						<div class="col-md-8 ftco-animate">
							<div class="text mt-md-5 w-100 text-center">
								<h2>Welcome to Living word Evangelical Assembly</h2>
								<h1 class="mb-3">Perfect Church For Imperfect People</h1>
								<p class="mb-4 pb-3">Jesus wants you just as you are, but he wishes to wash you and make you a better version, not of yourself but of himself. Receive the Living Word and watch your life transform.</p>
								<!-- <p class="mb-0"><a href="#" class="btn btn-primary py-3 px-2 px-md-4">Become A Volunteer</a></p> -->
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php }  ?>
			<?php $index++; } ?>

		</div>
    </section>

	<section class="ftco-section ftco-no-pb ftco-no-pt">
		<div class="container-fluid">
			<div class="row no-gutters">
					<div class="row no-gutters">
						<div class="col-md-6">
							<div class="services-2">
								<div class="icon"><span class="flaticon-church"></span></div>
								<div class="text">
									<h4>The Word</h4>
									<span class="subheading">What to expect</span>
									<p> <b>"...of all Jesus began to DO and to Teach - Acts 1:1"</b> 
									<br>We believe all that God has for humanity is wrapped up in the Word of Life. We take teaching seriously and this we do and receive with all vehemence, passion and joy</p>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="services-2">
								<div class="icon"><span class="flaticon-pray"></span></div>
								<div class="text">
									<h4>The Supernatural</h4>
									<span class="subheading">What to Expect</span>
									<p> <b>"He sent His Word, and Healed them, and delivered them from their destructions - Ps 107:20"</b>  <br>We minister the word, lay hands on the sick and see the supernatural manifested naturally to the glory of Jesus the Christ" </p>
								</div>
							</div>
						</div>
					</div>
			</div>
		</div>
    </section>
	<section class="ftco-section ftco-no-pt ftco-no-pb bg-light">
		<div class="container-fluid">
			<div class="row d-flex">
				<div class="col-md-6 d-flex">
					<div class="img img-video d-flex align-self-stretch align-items-center justify-content-center justify-content-md-center mb-4 mb-sm-0" style="background-image:url(images/welcome.jpg);">
					</div>
				</div>
				<div class="col-md-6 pl-md-5 py-md-5">
					<div class="heading-section pt-md-5 mb-4">
						<span class="subheading">Welcome to Living Word Evangelical Assembly</span>
						<h2 class="mb-5"></h2>
						<p style="text-align:justify;">
							Living Word Evangelical Assembly is the church arm of Light of Christ Commission International, an outreach ministry dedicated to reaching the helpless, 
							hopeless and those in need of comfort via prisons, hospital, orphanage outreach ministries. she has been liberating the oppressed of the devil via the 
							dispense of the word of life and the exemplification of the suoernatural in healings, the prophetic and the miraculous.<br>
							Light of Christ Commission has been hosting crusades since the year 1997, upon which Living Word Evangelical Assembly was established in the year 1998.

						</p>
						<p style="text-align:justify;">
							Living Word Evangelical Assembly has a branch officially established in Osogbo, Osun State in the year 2019 under the supervision of Apst Dr Faith Oniya
							who serves as a the Resident Pastor.<span id="dots">.....</span><span id="more"><br>
							Living Word Evangelical Assembly hosts loads of interdenominational power meetings open to people of all nations and tongues amidst whcich includes; <br><br>
						
							<b>LWEA HEADQUARTER OUTREACHES</b> <br>
							Annual Crusade - November, but Varying Dates <br>
							Balm of Gilead - 5pm every Saturday <br>
							Begin the Month - 6am every first day of the Month <br>
							My seed must excel - Varying Dates <br>
							Prayer Rain - 6pm, Throughout July <br>
							Bible study - 6pm, Tuesdays <br>
							Prayer Meetings - 6pm, Thursdays <br> <br>

							<b>LWEA, OSUN STATE OUTREACHES</b><br>
							Apocalypses of Kingdom Sovereignty - March, but with varying Dates <br>
							Finance conference - August, but varying dates <br>
							Jungle Rumble (7 Hour Marathon Prayers) - August, but Varying Dates <br>
							Life and authority revival - September, but Varying Dates <br>
							Open air crusade - July, But Varying Dates <br>
							Prayer Rain - 6pm, Throughout October <br>
							ROAR Concert - July, but Varying Dates <br>
							Bible study - 5pm, Tuesdays <br>
							Prayer Meetings - 5pm, Thursdays <br>
							<span>
						</p>
						<button onclick="myFunction()" id="myBtn" class="btn btn-danger">Read more</button>


						

					
						<!-- <p><a href="#" class="btn btn-primary">Learn More</a></p> -->
					</div>
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
			    $selectfromdatabase = "SELECT sermon.*, categories.catgories AS categoryname FROM sermon JOIN categories ON sermon.categories = categories.id GROUP BY sermon.sermonid ORDER BY sermon.id DESC LIMIT $calculatePage , $limit ";
				$fselect = mysqli_query($church,$selectfromdatabase);
				while($ffselec= mysqli_fetch_array($fselect)){
					$sermonid = $ffselec['sermonid'];
			?>

			<div class="row no-gutters d-flex sermon-wrap ftco-animate bg-light">
				<div class="col-md-6 d-flex align-items-stretch js-fullheight ftco-animate">
					<a href="#" class="img" style="background-image: url('admin/<?php echo $ffselec['Pictures'] ;?>');"></a>
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

				<a href="sermoncategory.php?category=<?php echo $categegory['categoryid'] ?>&categorise=<?php echo ucfirst($categegory['category']) ?>"><?php echo ucfirst($categegory['category']) ?> | <?php  ?>  </a>
									
									<?php
								// $comma++;
								} ?>
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
	</section>
	


	<section class="ftco-section testimony-section">
		<div class="overlay"></div>
		<div class="container-fluid ">
			<div class="row justify-content-center pb-6">
				<div class="col-md-7 heading-section heading-section-white text-center ftco-animate">
					<span class="subheading">Testimony</span>
					<h2>Transform Lives</h2>
				</div>
			</div>
			<div class="text-center">
				<a href="#addtestimony" data-toggle="modal" class="btn btn-light btn-rounded text-uppercase">add Testimony</a>
			</div>
			<div class="modal fade" id="addtestimony">
				<div class="modal-dialog modal-dialog-centered">
				  <div class="modal-content">
				  
					<!-- Modal Header -->
					<div class="modal-header">
					  <h4 class="modal-title font-weight-bold text-uppercase">add testimony</h4>
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					
					<!-- Modal body -->
					<div class="modal-body">
						<span class="text-danger fail"></span>
						<span class="text-success success"></span>
					  <form id="testimonyform" enctype="multipart/form-data">
						<div class="form-group">
							<label for="Url">Fullname </label>
							<input type="text" class="form-control" name="name" placeholder="Full Name">
							<span class="text-danger nameError">
							</span>
	  
						  </div>
						  <div class="form-group">
							<label for="comment">Picture:</label>
							<input type="file" class="form-control-file border" accept="image/*" name="InputFile">
						  </div>
						  <span class="text-danger imageError">
						  </span>
	  
						  <div class="form-group">
							<label for="comment">Testimony:</label>
							<textarea class="form-control testimonyarea" rows="3" name="testimony"></textarea>
							<span class="text-danger testimoneyError">
							</span>
		  
						  </div>
						  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						  	<button id="testimonybtn" name="testimonysubmit" class="btn btn-primary btn-rounded mx-2 float-right">submit</button>
					  </form>
					</div>
					
					<!-- Modal footer -->
					
					
				  </div>
				</div>
			  </div>

			<div class="row ftco-animate">
				<div class="col-md-12">
					<div class="carousel-testimony owl-carousel">
						<?php
						
						$testi = mysqli_query($church, "SELECT * FROM testimony WHERE status='enabled' ORDER BY id DESC ");
						while($testimony = mysqli_fetch_array($testi)){

						
						?>

						<div class="item">
							<div class="testimony-wrap d-md-flex">
								<div class="user-img" style="background-image: url(<?php echo !empty($testimony['picture']) ? $testimony['picture']:"testimonies/avatar.jpg" ?>)">
								</div>
								<div class="text pl-md-3">
									<span class="quote d-flex align-items-center justify-content-center">
										<i class="fa fa-quote-left"></i>
									</span>
									<?php echo html_entity_decode($testimony['testimony']) ?>
									<p class="name"><?php echo $testimony['name'] ?></p>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section">
		<div class="container-fluid">
			<div class="row justify-content-center pb-5 mb-3">
				<div class="col-md-7 heading-section text-center ftco-animate">
					<span class="subheading">Our Blog</span>
					<h2>Latest news from our blog</h2>
				</div>
			</div>
			<div class="row d-flex">
			<?php
					$blog = mysqli_query($church, "SELECT * FROM blog ORDER BY id DESC LIMIT $calculateblogpage , $limitblog");
					while($blogs = mysqli_fetch_array($blog)){
					// echo $blogs['id'];
					$blogid = $blogs['id'];								
			?>
			<div class="col-md-6 col-lg-4 d-flex ftco-animate">
				<div class="blog-entry align-self-stretch">
				  <a href="blog-details.php?blog=<?php echo $blogs['id'] ?>" class="block-20" style="background-image: url('admin/<?php echo $blogs['image'] ?>');">
				  </a>
				  <div class="text p-4">
				   <div class="meta mb-2">
					<div><a href="blog-details.php?blog=<?php echo $blogs['id'] ?>"><?php echo date_format(date_create($blogs['blog_date']), "M d, Y" ) ?></a></div>
					<div><a href="blog-details.php?blog=<?php echo $blogs['id'] ?>"><?php echo $blogs['user'] ?></a></div>
					<?php 
					$q = mysqli_query($church, "SELECT COUNT(id) AS totalcomment FROM comment WHERE blog_id= '$blogid' ");
					$comments = mysqli_fetch_array($q);
					$total = $comments['totalcomment'];
					?>
					<div><a href="blog-details.php?blog=<?php echo $blogs['id'] ?>" class="meta-chat"><span class="fa fa-comment"></span> <?php echo $total ?></a></div>
				  </div>
				  <h3 class="heading"><a href="#"><?php echo $blogs['title'] ?> </a></h3>
				  <?php echo strlen($blogs['content']) < 300 ? html_entity_decode($blogs['content']) : substr( html_entity_decode($blogs['content']), 0 , 300 )  ?>       
				   <p><a href="blog-details.php?blog=<?php echo $blogs['id'] ?>" class="btn btn-primary">Read more</a></p>
				</div>
			  </div>
			</div>
					<?php } ?>
				
				
			</div>
		</div>
	</section>

	<section class="ftco-section ftco-no-pt">
		<div class="container-fluid">
			<div class="row justify-content-center pb-5 mb-3">
				<div class="col-md-7 heading-section text-center ftco-animate">
					<span class="subheading">Events</span>
					<h2>Latest Events</h2>
				</div>
			</div>
			<div class="row">
			<?php
					$event = mysqli_query($church, "SELECT * FROM event ORDER BY id DESC LIMIT $calculateeventpage , $limitevent");
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
									<span><i class="fa fa-map-marker mr-2"></i> <a href="#"><?php echo $events['Venue'] ?></a></span>
									<span><i class="fa fa-building mr-2"></i><?php echo htmlspecialchars_decode( ucfirst($events['About']))?></span>
								</p>
							</div>
							<p><a href="sermons.html" class="btn btn-primary">More Details</a></p>
						</div>
					</div>
				</div>
			<?php } ?>
	
			</div>
		</div>
	</section>
	<section class="ftco-section ftco-no-pb ftco-no-pt">
		<div class="container-fluid px-md-0">
			<div class="row no-gutters justify-content-center pb-5 mb-3">
				<div class="col-md-7 heading-section text-center ftco-animate">
					<span class="subheading">Gallery</span>
					<h2>Gallery</h2>
				</div>
			</div>
			<div class="row no-gutters">
				<?php 
					$gal = mysqli_query($church, "SELECT*  FROM  gallery ORDER BY  RAND() LIMIT 10");
					$index =0;
					while($gallery = mysqli_fetch_array($gal)){

					if($index%7){
				?>

				<div class="col-md-3">
					<a href="admin/<?php echo $gallery['pictures'] ?>" class="image-popup img gallery ftco-animate" style="background-image: url(admin/<?php echo $gallery['pictures'] ?>);">
						<span class="overlay"></span>
					</a>
				</div>
				<?php }else{
				
				?>
				<div class="col-md-6">
					<a href="admin/<?php echo $gallery['pictures'] ?>" class="image-popup img gallery ftco-animate" style="background-image: url(admin/<?php echo $gallery['pictures'] ?>);">
						<span class="overlay"></span>
					</a>
				</div>

				<?php }  ?>
				<?php $index++; } ?>

			</div>
		</div>
	</section>











<?php 
    include("footer.php"); 
?>
<script>
	$(function () {
	  //Initialize Select2 Elements
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


	  $("#testimonybtn").on('click', function(e){
		var form = $("#testimonyform")[0];
		var forData = new FormData(form);
		$.ajax({
			type:"POST",
			url:"addtestimony.php",
			data:forData,
			// dataType:JSON,
			success:function(data){
				var result = JSON.parse(data);
				if(result.name){
				$(".nameError").text(result.name);
				}
				if(result.testimony){
				$(".testimoneyError").text(result.testimony);
				}
				if(result.image){
				$(".imageError").text(result.image);
				}
				if(result.success){
					$(".success").text(result.success);
					setTimeout(() => {
						// alert("done");
						window.location.reload()
					}, 200);
				}
				if(result.fail){
					$(".fail").text(result.fail);
				}
			},
			cache:false,
			contentType:false,
			processData:false
		});

		e.preventDefault();

	  })
  
	})
  
  
  
  </script>