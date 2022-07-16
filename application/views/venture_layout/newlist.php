
<!DOCTYPE html>
<head>

<!-- Basic Page Needs
================================================== -->
<title>Mr Realtor</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme/css/style.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme/css/main-color.css" id="colors">
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

<link href="<?= base_url() ?>/assets/css/bootstrap.min.css" rel="stylesheet">
<link href="https://maps.bbgindia.com/Content/css/rsr.css" rel="stylesheet">
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3&amp;key=AIzaSyBzk6PWUXVMCtTjYVD_DJH3ybOweFq0pls"></script>
<link href="https://maps.bbgindia.com/Content/css/newmappage.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link href="<?= base_url() ?>/assets/css/search.css" rel="stylesheet">
<link href="<?= base_url() ?>/assets/css/styles/custom.css" rel="stylesheet">
<script src="<?= base_url() ?>/assets/js/jquery-2.0.3.min.js"></script>
<script src="<?= base_url() ?>/assets/js/rsr.js"></script>
<script src="<?= base_url() ?>/assets/js/cspline.js"></script>
<script src="<?= base_url() ?>/assets/js/settextpathstyle.js"></script>

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
					<a href="index.html"><img width="80px" src="<?php echo base_url(); ?>assets/images/MrRealtorLogo.png" alt=""></a>
				</div>

				<div class="a2a_kit a2a_kit_size_32 a2a_default_style pull-right">
					<a class="a2a_dd" href="https://www.addtoany.com/share"></a>
					<a class="a2a_button_facebook"></a>
					<a class="a2a_button_twitter"></a>
					<a class="a2a_button_whatsapp"></a>
					<a class="a2a_button_linkedin"></a>
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

<input type="hidden" id="venture_id" value="<?php if (isset($venture_id)) {
    echo $venture_id["VentureID"];
} else {
    echo $ventures[0]["VentureID"];
} ?>"/>
<input type="hidden" id="company_id" value="<?php echo $company_id[
    "CompID"
]; ?>"/>
<!-- Content
================================================== -->
<div class="fs-container">

	<div class="fs-inner-container content">
		<div class="fs-content">

			<!-- Search -->
			<section class="search ">

				<div class="row">
					<div class="col-md-12">
							<div class="row with-forms">
								<div class="col-fs-6">
									<div class="col-md-12">
										<!-- Showing Results -->
										<p class="showing-results">Mr Realtor - <?php echo count($ventures); ?> Ventures</p>
									</div>
									<div class="input-with-icon location">
										<div class="listing-item-container list-layout active" data-marker-id="1">
											<a data-toggle="modal" data-target="#myModal" class="listing-item">		<div class="listing-item-image">
												<?php 
													if (isset($venture_id)) {
										                if (
										                    $venture_id["VentureLogo"] == "" ||
										                    $venture_id["VentureLogo"] == null
										                ) {
										                    $venture_id["VentureLogo"] =
										                        "uploads\/ventures\/1573209023virinchihills.png";
										                } ?>
                                    			<img src="<?php echo base_url()?>/<?php echo $venture_id["VentureLogo"]; ?>" alt="">
												<?php
									            } else {
									                if (
									                    $ventures[0]["VentureLogo"] == "" ||
									                    $ventures[0]["VentureLogo"] == null
									                ) {
									                    $ventures[0]["VentureLogo"] =
									                        "uploads\/ventures\/1573209023virinchihills.png";
									                } ?>

                                    			<img src="<?php echo base_url()?>/<?php echo $ventures[0]["VentureLogo"]; ?>" alt="">

												<?php
            									} ?>
												
												</div>
													
													<!-- Content -->
												<div class="listing-item-content">
													<div class="listing-item-inner">
														<h3>
															<?php 
																if (isset($venture_id)) {
												                  echo $venture_id["VentureName"];
												              } else {
												                  echo $ventures[0]["VentureName"];
												              } 
											              	?>
          												</h3>
														<p class="black-text"><?php if (isset($venture_id)) {
											                  echo $venture_id["ZoneName"];
											              } else {
											                  echo $ventures[0]["ZoneName"];
											              } ?>
          												</p>
													</div>
													<span class="like-icon">
													</span>

												</div>
											</a>
										</div>
									</div>
								</div>
							</div>
							<!-- Row With Forms / End -->

					</div>
				</div>

			</section>
			<!-- Search / End -->


		<section class="listings-container ">
			<!-- Sorting / Layout Switcher -->
			<div class="row fs-switcher">

				<div class="col-md-12">
					<!-- Showing Results -->
					<p class="showing-results">Mr Realtor - <?php echo count(
         $ventures
     ); ?> Ventures</p>
				</div>

			</div>


			<!-- Listings -->
			<div class="row fs-listings">
				<?php foreach ($ventures as $key => $v) {

        $active = "";
        if (isset($venture_id)) {
            if ($venture_id["VentureID"] == $v["VentureID"]) {
                $active = "active";
            }
        } else {
            if ($key == 0) {
                $active = "active";
            }
        }
        ?>
				<!-- Listing Item -->
				<div class="col-lg-12 col-md-12">
					<div class="listing-item-container list-layout <?php echo $active; ?>" data-marker-id="1">
						<a href="<?php echo base_url(); ?>/CompanyVentures/showVentures/<?php echo $v["slug"]; ?>/<?php echo $v[
    "venture_slug"
]; ?>/<?php echo $status;?>" class="listing-item">
							
							<!-- Image -->
							<div class="listing-item-image">
								<?php if ($v["VentureLogo"] == "" || $v["VentureLogo"] == null) {
            $v["VentureLogo"] =
                "uploads\/ventures\/1573209023virinchihills.png";
        } ?>
								<img src="<?php echo base_url()?>/<?php echo $v["VentureLogo"]; ?>" alt="">
							</div>
							
							<!-- Content -->
							<div class="listing-item-content">
								<div class="listing-item-inner">
									<h3><?php echo $v["VentureName"]; ?></h3>
									<p class="black-text"><?php echo $v["ZoneName"]; ?></p>
								</div>

							</div>
						</a>
					</div>
				</div>
				<!-- Listing Item -->
				<?php
    } ?>



				

			</div>
			<!-- Listings Container / End -->


			<!-- Pagination Container -->
			<div class="row fs-listings">
				<div class="col-md-12">

					
					<!-- Copyrights -->
					<div class="copyrights margin-top-0">© 2022 Mr Realtor. All Rights Reserved.</div>

				</div>
			</div>
			<!-- Pagination Container / End -->
		</section>

		</div>
	</div>
	<div class="fs-inner-container map-fixed">

		<div class="row" style="margin:0px;">
			<div class="style-1">
						<!-- Tabs Navigation -->
						<ul class="tabs-nav web-tab">
							<li class="active"><a href="#tab1b"><i class="fa fa-sun-o"></i></a><span class="mobile-tab-text">Layout</span></a></li>
							<li class=""><a href="#tab2b"><i class="fa fa-tag"></i></a><span class="mobile-tab-text">Features</span></a></li>
							<li class=""><a href="#tab3b"><i class="fa fa-file-pdf-o"></i></a><span class="mobile-tab-text">Brochure</span></a></li>
							<li class=""><a href="#tab4b"><i class="fa fa-map-marker"></i></a><span class="mobile-tab-text">Location</span></a></li>
							<li class=""><a href="#tab5b"><i class="fa fa-bullhorn"></i></a><span class="mobile-tab-text">Highlights</span></a></li>
							<li class=""><a href="#tab6b"><i class="fa fa-server"></i></a><span class="mobile-tab-text">Statement</span></a></li>
						</ul>

						
						<!-- Tabs Content -->
						<div class="tabs-container">
							<div class="tab-content" id="tab1b" style="">
								<div class="col-md-12 plot-text" >
						            <ul class="list-horizontal">

						                <li class="listgroup">Total Plots <span id="txt_totalplots">0</span></li>
						                <li class="listgroup" style="color:red">  Sold <span style="padding-left:3px" id="txt_alloted">0</span></li>
						                <li class="listgroup" style="color:green"> Available <span style="padding-left:3px" id="txt_available">0</span></li>
						            </ul>
						        </div>
						        <div class="row" style="margin:0px;">

            <div class="">
                <div class="pull-right" id="search_icon" style="position:absolute;z-index:2;right:0;margin-top:9px;margin-right:30px;">
                    <div class="tablistcol pull-right">
                        <ul class="nav nav-tabs nav-stacked text-center" role="tablist">
                            <li onclick="fullscreen();" title="fullscreen">

                                <span class="glyphicon glyphicon-resize-full" style="color: #fff"> Full Screen</span>
                            </li>
                            <li id="resetmap" title="Reset Map">

                                <span class="glyphicon glyphicon-refresh" style="color: #fff"> Refresh</span>
                            </li>

                            <li class="tablist" href="#messages" title="Search" aria-controls="messages" role="tab" data-toggle="tab">

                                <span class="glyphicon glyphicon-search" style="color: #fff"> Search</span>
                            </li>
                        </ul>
                    </div>
                    <div class="tabcont" style="display:none;">
                        <div class="tab-content">

                            <div id="messages">
                                <h4 align="center">Search
                                    <span class="pull-right closesearch">x</span>
                                </h4>

                                <div class="form-group">
                                    <select class="form-control" id="select1">
                                        <option value="0">--Select-Type-</option>
                                        <option value="1">Plot Number</option>
                                        <option value="2">Status</option>
                                        <option value="3">Facing</option>

                                    </select>

                                </div>
                                <div class="form-group">
                                    <input type="text" id="txt_search" class="form-control" style="border-radius:4px;padding:5px;" />
                                </div>
                                <select class="form-control" id="select2">
                                    <option value="-1">--Select-Status-</option>
                                    <option value="A">Available</option>
                                    <option value="NA">Booked</option>
                                </select>
                                <select class="form-control" id="select3" style="margin-top:10px;">
                                    <option value="0">--Select-Facing-</option>
                                    <option value="1">East</option>
                                    <option value="2">West</option>
                                    <option value="3">North</option>
                                    <option value="4">South</option>
                                    <option value="5">NorthWest</option>
                                    <option value="6">SouthEast</option>
                                    <option value="7">NorthEast</option>
                                    <option value="8">SouthWest</option>
                                </select>

                                <button type="button" id="btn_apply" class="btn btn-default" style="background-color:#c79147">Apply</button>
                                <button type="button" id="btn_reset" class="btn btn-default" style="background-color:#c79147">Reset</button>
                            </div>
                        </div>
                    </div>


                </div>


                <div id="map" style="width:100%;height:100vh;"></div>
                <div id="olmap" style="width:100%;height:100%"></div>
                <div id="div_hids"></div>
                <div id="div_facing"></div>
                <div id="divplot" style="text-align: left;">
                </div>
                <div style="display:none;">
                    <div id="popup" class="ol-popup">
                        <a href="#" id="popup-closer" class="ol-popup-closer" style="color:#000"></a>
                        <div id="popup-content"></div>
                    </div>
                </div>

            </div>

        </div>
							</div>

							<div class="tab-content" id="tab2b" style="display: none;">
								<?php if (isset($venture_id)) {
									if($venture_id["AboutVenture"]!="" && $venture_id["AboutVenture"]!=null){
										echo $venture_id["AboutVenture"];
									}else{
										echo "N/A";
									}
						            
						        } else {
						        	if($ventures[0]["AboutVenture"]!="" && $ventures[0]["AboutVenture"]!=null){
										echo $ventures[0]["AboutVenture"];
						        	}else{
						        		echo "N/A";
						        	}
						            
						        } ?>
							</div>

							<div class="tab-content" id="tab3b" style="display: none;">
								<?php if (isset($venture_id)) {
									if( $venture_id["brochure"] != "" && $venture_id["brochure"] != null)
									{ 
										$file_extenstion = explode(".",$venture_id["brochure"]);
										if($file_extenstion[1]!='pdf'){ ?>
											<img src="<?php echo base_url()?>/uploads/ventures/<?php echo $venture_id['brochure']; ?>" alt="">
										<?php }else{ ?>
											<object  type="application/pdf" data="<?php echo base_url()?>/uploads/ventures/<?php echo $venture_id['brochure']; ?>" style="width: 100%;height: 600px;border: none;">
<p>Your web browser doesn't have a PDF plugin.
  Instead you can <a href="<?php echo base_url()?>/uploads/ventures/<?php echo $venture_id['brochure']; ?>">click here to
  download the PDF file.</a></p>
</object>
										<?php }
									?>
									
								<?php }else{
									echo "No Brochure";
								}}else{
									if ($ventures[0]["brochure"] != "" && $ventures[0]["brochure"] != null)
									{
										$file_extenstion = explode(".",$ventures[0]["brochure"]);
										if($file_extenstion[1]!='pdf'){
									?>
									<img src="<?php echo base_url()?>/uploads/ventures/<?php echo $ventures[0]['brochure']; ?>" alt="">
								<?php }else{?>
<object  type="application/pdf" data="<?php echo base_url()?>/uploads/ventures/<?php echo $ventures[0]['brochure']; ?>" style="width: 100%;height: 600px;border: none;">
<p>Your web browser doesn't have a PDF plugin.
  Instead you can <a href="<?php echo base_url()?>/uploads/ventures/<?php echo $ventures[0]['brochure']; ?>">click here to
  download the PDF file.</a></p>
</object>
								<?php } ?>
								<?php }else{
									echo "No Brochure";
								}}?>
							</div>


							<div class="tab-content" id="tab4b" style="display: none;">
								<?php if (isset($venture_id)) {
									if( $venture_id["location"] != "" && $venture_id["location"] != null)
									{ ?>
									<iframe src="<?php echo $venture_id["location"];?>" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
								<?php }else{
									echo "N/A";
								}}else{
									if ($ventures[0]["location"] != "" && $ventures[0]["location"] != null)
									{
									?>
									<iframe src="<?php echo $ventures[0]["location"];?>" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
								<?php }else{
									echo "N/A";
								}}?>

							</div>
							<div class="tab-content" id="tab5b" style="display: none;">
								<?php if (isset($venture_id)) {
									if($venture_id["highlights"]!="" && $venture_id["highlights"]!=null){
										echo $venture_id["highlights"];
									}else{
										echo "N/A";
									}
						            
						        } else {
						        	if($ventures[0]["highlights"]!="" && $ventures[0]["highlights"]!=null){
										echo $ventures[0]["highlights"];
						        	}else{
						        		echo "N/A";
						        	}
						            
						        } ?>
							</div>
							<div class="tab-content" id="tab6b" style="display: none;">
								

						        <?php if (isset($venture_id)) {
									if($venture_id["statement_area"]!="" && $venture_id["statement_area"]!=null){
										echo $venture_id["statement_area"];
									}else{
										echo "N/A";
									}
						            
						        } else {
						        	if($ventures[0]["statement_area"]!="" && $ventures[0]["statement_area"]!=null){
										echo $ventures[0]["statement_area"];
						        	}else{
						        		echo "N/A";
						        	}
						            
						        } ?>
							</div>
						</div>
					</div>
        
        </div>
        

	</div>


</div>


</div>

<a href="#">
<button class="scroll-top scroll-to-target open" >
    <span class="fa fa-angle-up"></span>
</button>
</a>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ventures List</h4>
      </div>
      <div class="modal-body">

<?php foreach ($ventures as $key => $v) {

    $active = "";
    if (isset($venture_id)) {
        if ($venture_id["VentureID"] == $v["VentureID"]) {
            $active = "active";
        }
    } else {
        if ($key == 0) {
            $active = "active";
        }
    }
    ?>
      	
        <div class="listing-item-container list-layout <?php echo $active; ?>" data-marker-id="1">
			<a href="<?php echo base_url(); ?>/CompanyVentures/showVentures/<?php echo $v["slug"]; ?>/<?php echo $v[
    "venture_slug"
]; ?>/<?php echo $status;?>" class="listing-item">
							
							<!-- Image -->
							<div class="listing-item-image">
								<?php if ($v["VentureLogo"] == "" || $v["VentureLogo"] == null) {
            $v["VentureLogo"] =
                "uploads\/ventures\/1573209023virinchihills.png";
        } ?>
								<img src="<?php echo base_url()?>/<?php echo $v["VentureLogo"]; ?>" alt="">
							</div>
							
							<!-- Content -->
							<div class="listing-item-content">
								<div class="listing-item-inner">
									<h3><?php echo $v["VentureName"]; ?></h3>
									<p class="black-text"><?php echo $v["ZoneName"]; ?></p>
								</div>

							</div>
						</a>
		</div>

		<?php
} ?>

      </div>
    </div>

  </div>
</div>
<!-- Wrapper / End -->

<!-- AddToAny BEGIN -->

<script async src="https://static.addtoany.com/menu/page.js"></script>
<!-- AddToAny END -->

<!-- Scripts
================================================== -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/scripts/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/scripts/jquery-migrate-3.3.2.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/scripts/mmenu.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/scripts/chosen.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/scripts/slick.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/scripts/rangeslider.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/scripts/magnific-popup.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/scripts/waypoints.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/scripts/counterup.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/scripts/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/scripts/tooltips.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/scripts/custom.js"></script>



<!-- Maps -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/scripts/infobox.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/scripts/markerclusterer.js"></script>

<script src="<?= base_url() ?>/assets/js/map.js"></script>

</body>
<script>
	$(".scroll-top").on("click", function() {
    $("body").scrollTop(0);
});
</script>
</html>