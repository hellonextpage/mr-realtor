
<!DOCTYPE html>
<head>

<!-- Basic Page Needs
================================================== -->
<title>Mr Realtor</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="https://www.vasterad.com/themes/listeo_22/css/style.css">
<link rel="stylesheet" href="https://www.vasterad.com/themes/listeo_22/css/main-color.css" id="colors">
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

<link href="<?=base_url()?>/assets/css/bootstrap.min.css" rel="stylesheet">
<link href="https://maps.bbgindia.com/Content/css/rsr.css" rel="stylesheet">
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3&amp;key=AIzaSyBzk6PWUXVMCtTjYVD_DJH3ybOweFq0pls"></script>
<link href="https://maps.bbgindia.com/Content/css/newmappage.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link href="<?=base_url()?>/assets/css/search.css" rel="stylesheet">
<link href="<?=base_url()?>/assets/css/styles/custom.css" rel="stylesheet">
<script src="<?=base_url()?>/assets/js/jquery-2.0.3.min.js"></script>
<script src="<?=base_url()?>/assets/js/rsr.js"></script>
<script src="<?=base_url()?>/assets/js/cspline.js"></script>
<script src="<?=base_url()?>/assets/js/settextpathstyle.js"></script>

    <script type="text/javascript">
        function fullscreen() {
            if ((document.fullScreenElement && document.fullScreenElement !== null) ||
                (!document.mozFullScreen && !document.webkitIsFullScreen)) {
                if (document.documentElement.requestFullScreen) {
                    document.documentElement.requestFullScreen();
                } else if (document.documentElement.mozRequestFullScreen) {
                    document.documentElement.mozRequestFullScreen();
                } else if (document.documentElement.webkitRequestFullScreen) {
                    document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
                }
            } else {
                if (document.cancelFullScreen) {
                    document.cancelFullScreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.webkitCancelFullScreen) {
                    document.webkitCancelFullScreen();
                }
            }
        }


        $(document).on('click', '.tablist', function() {
            $('.tabcont').fadeToggle();
        });
        $(document).on('click', '.closesearch', function() {
            $(".tabcont").fadeOut();
        });
    </script>


</head>

<body>

<!-- Wrapper -->
<div id="wrapper">

<!-- Header Container
================================================== -->
<header id="header-container" class="fixed fullwidth">

	<!-- Header -->
	<div id="header" class="not-sticky">
		<div class="container">
			
			<!-- Left Side Content -->
			<div class="left-side">
				
				<!-- Logo -->
				<div id="logo">
					<a href="index.html"><img width="80px" src="https://nextpagetechnologies.com/img/logo_white.png" alt=""></a>
				</div>

				<!-- Mobile Navigation -->
				<div class="mmenu-trigger">
					<button class="hamburger hamburger--collapse" type="button">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</button>
				</div>				
			</div>

		</div>
	</div>
	<!-- Header / End -->

</header>
<div class="clearfix"></div>
<!-- Header Container / End -->

<!-- Content
================================================== -->
<div class="fs-container">

	<div class="fs-inner-container content" style="width:95%">
		<div class="fs-content">

			


		<section class="listings-container ">
			<!-- Sorting / Layout Switcher -->
			<div class="row fs-switcher">

				<div class="col-md-12">
					
				</div>

			</div>



		</section>

		</div>
	</div>


</div>


</div>



<!-- Scripts
================================================== -->
<script type="text/javascript" src="https://www.vasterad.com/themes/listeo_22/scripts/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://www.vasterad.com/themes/listeo_22/scripts/jquery-migrate-3.3.2.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://www.vasterad.com/themes/listeo_22/scripts/mmenu.min.js"></script>
<script type="text/javascript" src="https://www.vasterad.com/themes/listeo_22/scripts/chosen.min.js"></script>
<script type="text/javascript" src="https://www.vasterad.com/themes/listeo_22/scripts/slick.min.js"></script>
<script type="text/javascript" src="https://www.vasterad.com/themes/listeo_22/scripts/rangeslider.min.js"></script>
<script type="text/javascript" src="https://www.vasterad.com/themes/listeo_22/scripts/magnific-popup.min.js"></script>
<script type="text/javascript" src="https://www.vasterad.com/themes/listeo_22/scripts/waypoints.min.js"></script>
<script type="text/javascript" src="https://www.vasterad.com/themes/listeo_22/scripts/counterup.min.js"></script>
<script type="text/javascript" src="https://www.vasterad.com/themes/listeo_22/scripts/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://www.vasterad.com/themes/listeo_22/scripts/tooltips.min.js"></script>
<script type="text/javascript" src="https://www.vasterad.com/themes/listeo_22/scripts/custom.js"></script>



<!-- Maps -->
<script type="text/javascript" src="https://www.vasterad.com/themes/listeo_22/scripts/infobox.min.js"></script>
<script type="text/javascript" src="https://www.vasterad.com/themes/listeo_22/scripts/markerclusterer.js"></script>

<script src="<?=base_url()?>/assets/js/map.js"></script>

</body>
</html>