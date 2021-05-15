<?php
$ministeractive ="active";
$pagetitle = "Minister";

include("header.php")
?>
<section class="  hero-wrap-2 js-fullheight col-sm  " style="background-image: url('images/ministry.jpg');width:100%; background-repeat: no-repeat; background-position:center; background-color: black; padding-top:500,background-size:100% 80px;">
		<div class="overlay"></div>
		<div class="container-fluid">
			<div class="row no-gutters slider-text js-fullheight align-items-end ">
				<div class="col-md-9 ftco-animate pb-5">
					<p class="breadcrumbs mb-2 text-white"><span class="mr-2 "><a href="index.php">Home <i class="fa fa-chevron-right"></i></a></span> <span>Ministries <i class="fa fa-chevron-right"></i></span></p>
					<h1 class="mb-0 bread text-white"> <b>Church Ministries</b> </h1>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4 ministry ftco-animate">
					<div class="img width:100%"style="background-image: url(images/youth.jpeg);"></div>
					<div class="text p-4">
						<h2 class="mb-4"><a >Children's Ministry</a></h2>
						<p >Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
						<p><a type="button" class="btn btn-primary" data-toggle="modal" data-target="#childModal">More Details</a></p>

					</div>
				</div>
				<div class="col-md-4 ministry ftco-animate">
					<div class="img"style="background-image: url(images/women.jpg);"></div>
					<div class="text p-4">
						<h2 class="mb-4"><a>Women's Ministry</a></h2>
						<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
						<p><a type="button" class="btn btn-primary" data-toggle="modal" data-target="#womenModal">More Details</a></p>

					</div>
				</div>
				<div class="col-md-4 ministry ftco-animate">
					<div class="img"style="background-image: url(images/men.jpg);"></div>
					<div class="text p-4">
						<h2 class="mb-4"><a>Men Ministry</a></h2>
						<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
						<p><a type="button" class="btn btn-primary" data-toggle="modal" data-target="#menModal">More Details</a></p>

					</div>
				</div>
			</div>
			<div class="row">	
				<div class="col-md-4 ministry ftco-animate">
					<div class="img"style="background-image: url(images/community-1.jpg);"></div>
					<div class="text p-4">
						<h2 class="mb-4"><a>Community Ministry</a></h2>
						<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
						<p><a type="button" class="btn btn-primary" data-toggle="modal" data-target="#commModal">More Details</a></p>

					</div>
				</div>

				<div class="col-md-4 ministry ">
				<div class="img"style="background-image: url(images/children.jpg);"></div>
					<div class="text p-4">
						<h2 class="mb-4">Youth Fellowship</h2>
						<p>	LWEA youth ministry, is a faith group open to youths usually from ages 19 to 30,
							with a mission is to involve and engage with other young people both on the internal 
							LWEA platform and also on other interdenominational platform basis.</p>
						<p><a type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">More Details</a></p>
					</div>	
				</div>

				<div class="col-md-4 ministry ">
					<div class="img"style="background-image: url(images/music.jpg);"></div>
					<div class="text p-4">
						<h2 class="mb-4"><a>Music Ministry</a></h2>
						<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
						<p><a type="button" class="btn btn-primary" data-toggle="modal" data-target="#musicModal">More Details</a></p>

					</div>
				</div>
			</div>
		</div>

							 <!-- Youth Modal -->
							 <div class="modal fade" id="myModal">
							<div class="modal-dialog modal-lg">
							<div class="modal-content">
							
								<!-- Modal Header -->
								<div class="modal-header">
								<h4 class="modal-title">Youth Fellowship</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
								
								<!-- Modal body -->
								<div class="modal-body">
									<p>	LWEA youth ministry, is a faith group open to youths usually from ages 19 to 30,
										 with a mission is to involve and engage with other young people both on the internal 
										 LWEA platform and also on other interdenominational platform basis.
									</p>

								<p>	We believe that investing in today's youth is necessary in growing the body of Christ. </p>

								<p>Teaching young people in the church to grow in their relationship with the Lord prepares them to serve Christ in all they do. ... 
									Serving young people cannot only prepare them to become future leaders, but also allow them to contribute to the church. 
									This is why we think the youth ministry is one of the most important any church can have especially the LWEA Youths.</p>

								</div>
								
								<!-- Modal footer -->
								<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
								</div>
								
							</div>
							</div>
						</div>

							<!-- children Modal -->
						<div class="modal fade" id="childModal">
							<div class="modal-dialog modal-lg">
							<div class="modal-content">
							
								<!-- Modal Header -->
								<div class="modal-header">
								<h4 class="modal-title">Children Fellowship</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
								
								<!-- Modal body -->
								<div class="modal-body">

								</div>
								
								<!-- Modal footer -->
								<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
								</div>
								
							</div>
							</div>
						</div>

						<!-- women Modal -->
						<div class="modal fade" id="womenModal">
							<div class="modal-dialog modal-lg">
							<div class="modal-content">
							
								<!-- Modal Header -->
								<div class="modal-header">
								<h4 class="modal-title">Women's Ministry</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
								
								<!-- Modal body -->
								<div class="modal-body">
									<p>								1 Peter 3:1-4 <br>
								“…wives, …they behold your chaste conversation coupled with fear… [your] adorning …let it be the hidden [wo]-man of the heart, in that which is not corruptible, even the ornament of a meek and quiet spirit, which is in the sight of God of great price.”
									</p>
									<p>								Women are pillars of the home. The woman fellowship is the place where women are equipped for the great challenge of making the home both a godly place and a place where the man would truly find rest. The place where godly children are raised into giants FOR THE advancement of God’s Kingdom.
									</p>



								</div>
								
								<!-- Modal footer -->
								<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
								</div>
								
							</div>
							</div>
						</div>
	
							<!-- Men Modal -->
						<div class="modal fade" id="menModal">
							<div class="modal-dialog modal-lg">
							<div class="modal-content">
							
								<!-- Modal Header -->
								<div class="modal-header">
								<h4 class="modal-title">Men's Fellowship</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
								
								<!-- Modal body -->
								<div class="modal-body">
									<p>	“I write unto you, fathers, because ye have known him that is from the beginning…” ~ 1 John 2:13</p>
									<p>	Fathers are men and all men would eventually be fathers and as so we believe that the father who is the man in the house should be the priest of his house. Men’s ministry is dedicated to raising men who know the lord indeed. Only then can the family be healthy and thus the nation and the world.</p>


								</div>
								
								<!-- Modal footer -->
								<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
								</div>
								
							</div>
							</div>
						</div>


							 <!-- community Modal -->
						<div class="modal fade" id="commModal">
							<div class="modal-dialog modal-lg">
							<div class="modal-content">
							
								<!-- Modal Header -->
								<div class="modal-header">
								<h4 class="modal-title">Community Ministry</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
								
								<!-- Modal body -->
								<div class="modal-body">
									<p>	We strongly believe the “Go Ye” commission and more importantly believe it goes beyond organizing big interdenominational 
										crusade meetings alone, hence the need for a community-centered encroachment strategy which involves the following branches;
									</p>

									~ Counseling Ministry <br>
									~ Evangelism and Outreach Ministry <br>
									~ Hospital Ministry <br>
									~ Prison’s Ministry, <br>
									~ Orphanages Ministry.

								</div>
								
								<!-- Modal footer -->
								<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
								</div>
								
							</div>
							</div>
						</div>

							 <!-- Music Modal -->
							 <div class="modal fade" id="musicModal">
							<div class="modal-dialog modal-lg">
							<div class="modal-content">
							
								<!-- Modal Header -->
								<div class="modal-header">
								<h4 class="modal-title">Music Ministry</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
								
								<!-- Modal body -->
								<div class="modal-body">
									<p>THE LWEA Music Ministry is a dynamic one which does not only gives you good music but also serves as a hub for the discovery of leadership 
										teams and individuals who would rise to serve God with the gifts he has given them in music and beyond. 
									</p>

									<p>	We value this ministry because Colossians 3:16 shows us it is a ministry of God’s Word, to build up his church.
									</p>

									<p>	On an interdenominational basis, we run conferences, in-church workshops, and encourage regular koinonia with the Holy Spirit to help anyone involved in music in their churches, whether that be full time, part time, or lay, and whether as a pastor or a musician bring God’s word to men in the form of music adequately.
									</p>
									<p>	We believe that Colossians 3:16 is true and music plays a critical role within God’s church, helping us let the Word of Christ dwell in us richly. We believe that music ministry has lacked priority within many local churches for a long time and needs to be encouraged, developed and grown to help God’s people ‘Rejoice in the Lord’ and be filled with ‘an inexpressible and glorious joy (1 Peter 1:8)’. We believe music is such an important part of today’s society. To reach this nation with the gospel, the music of the local church needs not to be a stumbling block to hearing the good news of Jesus but rather a tool.
									</p>
								</div>
								
								<!-- Modal footer -->
								<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
								</div>
								
							</div>
							</div>
						</div>

	</section>
<?php
include("footer.php")
?>