<?php include('cms/includes/config.inc.php');?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>DBH Limo, Airport Transportation, Charleston SC, Limo service, Corporate Travel</title>
<meta name="keywords" content="airport transportation, charleston sc, limo service, night on town, corporate travel">
<meta name="description" content="Full service transportation company, limousine service, and corporate travel in Charleston SC.">
		<meta charset="utf-8">
		<meta name = "format-detection" content = "telephone=no" />
		<link rel="icon" href="images/favicon.ico">
		<link rel="shortcut icon" href="images/favicon.ico" />
		<link rel="stylesheet" href="booking/css/booking.css">
		<link rel="stylesheet" href="css/camera.css">
		<link rel="stylesheet" href="css/owl.carousel.css">
		<link rel="stylesheet" href="css/style.css">
		<script src="js/jquery.js"></script>
		<script src="js/jquery-migrate-1.2.1.js"></script>
		<script src="js/script.js"></script>
		<script src="js/superfish.js"></script>
		<script src="js/jquery.ui.totop.js"></script>
		<script src="js/jquery.equalheights.js"></script>
		<script src="js/jquery.mobilemenu.js"></script>
		<script src="js/jquery.easing.1.3.js"></script>
		<script src="js/owl.carousel.js"></script>
		<script src="js/camera.js"></script>
		<!--[if (gt IE 9)|!(IE)]><!-->
		<script src="js/jquery.mobile.customized.min.js"></script>
		<!--<![endif]-->
		<script src="booking/js/booking.js"></script>
		<script>
			$(document).ready(function(){
				jQuery('#camera_wrap').camera({
					loader: false,
					pagination: false ,
					minHeight: '444',
					thumbnails: false,
					height: '28.28125%',
					caption: true,
					navigation: true,
					fx: 'mosaic'
				});
				$().UItoTop({ easingType: 'easeOutQuart' });
			});
		</script>
		<!--[if lt IE 8]>
			<div style=' clear: both; text-align:center; position: relative;'>
				<a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
					<img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
				</a>
			</div>
			<![endif]-->
		<!--[if lt IE 9]>
			<script src="js/html5shiv.js"></script>
			<link rel="stylesheet" media="screen" href="css/ie.css">
		<![endif]-->
	</head>
	<body class="page1" id="top">
		<div class="main">
<!--==============================header=================================-->
			<header>
				<div class="menu_block ">
					<div class="container_12">
						<div class="grid_12">
							<nav class="horizontal-nav full-width horizontalNav-notprocessed">
								<ul class="sf-menu">
									<li class="current"><a href="index.php">Home</a></li>
									<li><a href="about.php">About</a></li>
									<li><a href="services.php">Services</a></li>
                                    <li><a href="cars.php">Our Fleet</a></li>
                                    <li><a href="rates.php">Rates</a></li>
                                    <li><a href="reserve.php">Reserve Online</a></li>
									<li><a href="contact.php">Contact</a></li>
								</ul>
							</nav>
							<div class="clear"></div>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				<div class="container_12">
					<div class="grid_12">
						<h1>
							<a href="index.php">
								<img src="images/logo.png" alt="Charleston Limo Service">
							</a>
						</h1>
					</div>
				</div>
				<div class="clear"></div>
			</header>
            <!--==============================Content=================================-->
			<div class="content"><div class="ic">More Website Templates @ TemplateMonster.com - April 07, 2014!</div>
				<div class="container_12">
					<div class="grid_12">
						<h3>Our Fleet</h3>
					</div>
					<div class="clear"></div>
					<div class="gallery"> <?php
    $SQL = mysqli_query($mbd, 'SELECT * FROM site_pages WHERE id="4" LIMIT 1') or die('Invalid Page Query: ' . mysqli_error($mbd));
    $p = mysqli_fetch_array($SQL);
    
    echo	$p['ctext'];
    ?>
						<div class="grid_4"><a href="images/big1.jpg" class="gal"><img src="images/page3_img1.jpg" alt=""></a></div>
						<div class="grid_4"><a href="images/big2.jpg" class="gal"><img src="images/page3_img2.jpg" alt=""></a></div>
						<div class="grid_4"><a href="images/big3.jpg" class="gal"><img src="images/page3_img3.jpg" alt=""></a></div>
					</div>
					
					
				</div>
			</div>
		</div>
<!--==============================footer=================================-->
		<footer>
			<div class="container_12">
				<div class="grid_12">
					<div class="f_phone"><span>Call Us: </span> 843 303 4761</div>
					<div class="socials">
						
						<a href="https://www.facebook.com/pages/DBH-Limo/148378275237202" class="fa fa-facebook"></a>
						
					</div>
					<div class="copy">
						<div class="st1">
						<div class="brand">DBH<span class="color1">Limo</span> </div>
						&copy; 2015	|</div> 
						<a href="http://www.geeksinabox.com/" rel="nofollow">Web designed and hosting by Geeks In A Box</a>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</footer>
		<script>
			$(function (){
				$('#bookingForm').bookingForm({
					ownerEmail: '#'
				});
			})
			$(function() {
				$('#bookingForm input, #bookingForm textarea').placeholder();
			});
		</script>
	</body>
</html>