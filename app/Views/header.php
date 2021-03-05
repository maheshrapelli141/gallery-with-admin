
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Jeet Props &mdash; The one stop ,prop shop</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Setup for films, television,Ad's, events, wedding and many more" />
	<meta name="keywords" content="films,television,Ad's, events, wedding" />
	<meta name="author" content="shivamsolutions.com" />

 
  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content="Jeet Props"/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content="Jeet Props"/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="Setup for films, television,Ad's, events, wedding and many more" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,600,400italic,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Animate.css -->
	<link rel="stylesheet" href="/assets/css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="/assets/css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="/assets/css/bootstrap.css">
	<!-- Owl Carousel -->
	<link rel="stylesheet" href="/assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="/assets/css/owl.theme.default.min.css">
	<!-- Theme style  -->
	<link rel="stylesheet" href="/assets/css/style-client.css">

	<!-- Modernizr JS -->
	<script src="/assets/js/modernizr-2.6.2.min.js"></script>
  
  
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	<!-- jQuery -->
	<script src="/assets/js/jquery.min.js"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/randomcolor/0.4.4/randomColor.min.js'></script>
  
  <script>
    //disable right click context menu
    document.addEventListener('contextmenu', event => event.preventDefault());
  </script>
	</head>
	<body>
  <?php
      $uri = service('uri');
     ?>
  <div id="fh5co-page">
		<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle"><i></i></a>
		<aside id="fh5co-aside" role="complementary" class="border js-fullheight">

			<h2 id="fh5co-logo"><a href="">
      <!-- <img src="/assets/images/logo-colored.png" alt="Free HTML5 Bootstrap Website Template"> -->
      Jeet Props
      </a></h2>
			<nav id="fh5co-main-menu" role="navigation">
				<ul>
					<li>
            <form action="/search" class="search-form">
              <input type="search" id="header-search" name="q" class="header-search" placeholder="Search Topics...">
              <button type="submit" class="search-btn"><i class="fa fa-search"></i></button>
            </form>
          </li>
					<li <?= ($uri->getSegment(1) == '' ? 'class="fh5co-active"' : null) ?>><a href="/">Home</a></li>
					<!-- <li <?= ($uri->getSegment(1) == 'photos' ? 'class="fh5co-active"' : null) ?>><a href="photos">Photos</a></li> -->
					<!-- <li <?= ($uri->getSegment(1) == 'about' ? 'class="fh5co-active"' : null) ?>><a href="/about">About</a></li> -->
					<li <?= ($uri->getSegment(1) == 'contact' ? 'class="fh5co-active"' : null) ?>><a href="/contact">Contact</a></li>
				</ul>
			</nav>

			<div class="fh5co-footer">
				<p><small>&copy; 2020 Jeet Props. All Rights Reserved.</span> <span>Designed by <a href="https://shivamsolutions.com/" target="_blank">Shivam Solutions</a> </span></small></p>
				<ul>
					<li><a href="#"><i class="icon-facebook"></i></a></li>
					<li><a href="#"><i class="icon-twitter"></i></a></li>
					<li><a href="#"><i class="icon-instagram"></i></a></li>
					<li><a href="#"><i class="icon-linkedin"></i></a></li>
				</ul>
			</div>

		</aside>
    <script>
    // $('#header-search').on('change',e => {
    //   const search = $(e.currentTarget).val().trim();
    //   if(search){
    //     fetch(`/api/topic/search/${search.toLowerCase()}`)
    //       .then(resp => resp.json())
    //       .then(resp => {
    //         console.log({resp});
    //       })
    //       .catch(err => {
    //         console.log({err});
    //       })
    //   }
    // });
    </script>