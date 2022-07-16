
<!DOCTYPE html>
<head>

<!-- Basic Page Needs
================================================== -->
<title>Mr Realtor</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Access-Control-Allow-Origin" content="*">
<!-- CSS
================================================== -->
<link rel="stylesheet" href="https://www.vasterad.com/themes/findeo_updated/css/style.css">
<link rel="stylesheet" href="https://www.vasterad.com/themes/findeo_updated/css/color.css">

<link rel="stylesheet" href="<?=base_url()?>/assets/fontello.tff">


<link href="<?=base_url()?>/assets/css/bootstrap.min.css" rel="stylesheet">
<link href="https://maps.bbgindia.com/Content/css/rsr.css" rel="stylesheet">
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3&amp;key=AIzaSyBzk6PWUXVMCtTjYVD_DJH3ybOweFq0pls"></script>
<link href="https://maps.bbgindia.com/Content/css/newmappage.css" rel="stylesheet">

<link href="<?=base_url()?>/assets/css/search.css" rel="stylesheet">
<script src="<?=base_url()?>/assets/js/jquery-2.0.3.min.js"></script>
<script src="<?=base_url()?>/assets/js/rsr.js"></script>
<script src="<?=base_url()?>/assets/js/cspline.js"></script>
<script src="<?=base_url()?>/assets/js/settextpathstyle.js"></script>
<script src="<?=base_url()?>/assets/js/map.js"></script>
    <style>
        @font-face {
  font-family: 'fontello';
  src: url('../fonts/fontello.eot');
  src: url('<?=base_url()?>fontello.eot') format('embedded-opentype'),
       url('<?=base_url()?>fontello.woff') format('woff'),
       url('<?=base_url()?>/fontello.ttf') format('truetype'),
       url('<?=base_url()?>fontello.svg') format('svg');
  font-weight: normal;
  font-style: normal;
}
        html {
            overflow: hidden;
        }

        #top-bar{
            padding-top: 10px;
            padding-bottom: 8px;
            border-color: #e6e6e6;
            border: 1px solid #e6e6e6;
            background-color: #fff;
        }
        .btn-default {
     background-color: #FFF; 
    margin: 5px 0px 5px 0px;
    color: #000;
    height: 45px;
    border: none;
    width: 100%;
    font-size: 16px;
    border-radius: 0px;
    border: 1px solid #e6e6e6;
}
        
        P {
            margin: 0px;
            font-size: 25px;
        }
        
        .ol-full-screen {
            display: none;
        }
        
        .list-horizontal {
            text-align: center;
            padding-left: 0px;
            margin: 5px 0px 5px 0px;
        }
        
        .list-horizontal .listgroup {
            display: inline-block;
            padding-right: 20px;
        }
        
        .list-horizontal .listgroup span {
            font-weight: bold;
        }
        
        .navbar-brand {
            padding: 5px 15px;
            height: 100%;
        }
        
        .nav navbar-nav navbar-right {
            margin-left: 140px;
        }
        
        .nav-stacked>li+li {
            margin-top: 15px;
        }
        
        .ol-popup {
            position: absolute;
            background-color: white;
            -webkit-filter: drop-shadow(0 1px 4px rgba(0, 0, 0, 0.2));
            filter: drop-shadow(0 1px 4px rgba(0, 0, 0, 0.2));
            padding: 15px;
            border-radius: 10px;
            border: 1px solid #cccccc;
            bottom: 12px;
            left: -50px;
            min-width: 314px;
        }
        
        .ol-popup:after,
        .ol-popup:before {
            top: 100%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
        }
        
        .ol-popup:after {
            border-top-color: white;
            border-width: 10px;
            left: 48px;
            margin-left: -10px;
        }
        
        .ol-popup:before {
            border-top-color: #cccccc;
            border-width: 11px;
            left: 48px;
            margin-left: -11px;
        }
        
        .ol-popup-closer {
            text-decoration: none;
            position: absolute;
            top: 2px;
            right: 8px;
        }
        
        .ol-popup-closer:before {
            content: "✖";
        }
        
        <!--.ol-unselectable {
            background-size: 100% 100%;
        }
        
        -->
    </style>
    <style>
        #map {
            background-image: url('https://localballot.in/mrrealtor/assets/img/lord.png');
            background-size: 120px;
            background-repeat: no-repeat;
        }
        
        #olmap {
            margin-left: -114px;
        }
        
        .ol-zoom {
            top: 50px;
        }
        
        a[href^="http://maps.google.com/maps"] {
            display: none !important;
        }
        
        a[href^="https://maps.google.com/maps"] {
            display: none !important;
        }
        
        .gmnoprint a,
        .gmnoprint span,
        .gm-style-cc {
            display: none;
        }
    </style>
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
<header id="header-container">

    <!-- Topbar -->
    <div id="top-bar">
        <div class="container">

            <!-- Left Side Content -->
            <div class="left-side">

                <img src="https://nextpagetechnologies.com/img/logo_white.png"  width="10%" class="img img-responsive"/>

            </div>
            <!-- Left Side Content / End -->


            <!-- Left Side Content -->
            <div class="right-side">

                <!-- Social Icons -->
                <ul class="social-icons">
                    <li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
                    <li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
                    <li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
                    <li><a class="pinterest" href="#"><i class="icon-pinterest"></i></a></li>
                </ul>

            </div>
            <!-- Left Side Content / End -->

        </div>
    </div>

</header>
<!-- Content
================================================== -->
<div class="container-fluid">
    <div class="row sticky-wrapper">
    <!-- Sidebar
        ================================================== -->
        <div class="col-md-3">
            <div class="sidebar sticky right">

                <!-- Widget -->
                <div class="widget margin-bottom-40">
                    <h3 class="margin-top-0 margin-bottom-35">Ventures List</h3>
                    <?php 
                      if(count($ventures)>0){
                      foreach($ventures as $v){?>
                    <!-- Row -->
                    <div class="row with-forms">
                        <!-- Status -->
                        <div class="col-md-12">
                            <button class="btn btn-default"><?php echo $v['VentureName'];?></button>
                        </div>
                    </div>
                    <!-- Row / End -->

                <?php }} ?>
                    <br>
                </div>
                <!-- Widget / End -->

            </div>
        </div>
        <!-- Sidebar / End -->
    <div class="col-md-9">

        <div class="row" style="margin:0px;">
        <div class="col-md-12" style="background-color:#e6effa;border:1px solid red">
            <ul class="list-horizontal">

                <li class="listgroup">Total Plots:<span id="txt_totalplots">0</span></li>
                <li class="listgroup"><span style="font-size:13px;background-color:#C89400;color:#C89400;margin-right:3px">00</span>Plots Alloted:<span style="padding-left:3px" id="txt_alloted">0</span></li>
                <li class="listgroup"><span style="font-size:13px;background-color:#FFFBD6;color:#FFFBD6;margin-right:3px">00</span>Plots Available:<span style="padding-left:3px" id="txt_available">0</span></li>
                <li class="listgroup"><span id="error_message" style="margin-right:30px;color:red"></span></li>
            </ul>
        </div>
        </div>
        <div class="row" style="margin:0px;">

            <div class="">
                <div class="pull-right" id="search_icon" style="position:absolute;z-index:2;right:0;margin-top:9px;margin-right:30px;">
                    <div class="tablistcol pull-right">
                        <ul class="nav nav-tabs nav-stacked text-center" role="tablist">
                            <li onclick="fullscreen();" title="fullscreen">

                                <span class="glyphicon glyphicon-resize-full" style="color: #fff"> </span>
                            </li>
                            <li id="resetmap" title="Reset Map">

                                <span class="glyphicon glyphicon-refresh" style="color: #fff"> </span>
                            </li>

                            <li class="tablist" href="#messages" title="Search" aria-controls="messages" role="tab" data-toggle="tab">

                                <span class="glyphicon glyphicon-search" style="color: #fff"> </span>
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


        
    </div>
</div>


<!-- Scripts
================================================== -->
<script type="text/javascript" src="https://www.vasterad.com/themes/findeo_updated/scripts/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="https://www.vasterad.com/themes/findeo_updated/scripts/jquery-migrate-3.1.0.min.js"></script>
<script type="text/javascript" src="https://www.vasterad.com/themes/findeo_updated/scripts/chosen.min.js"></script>
<script type="text/javascript" src="https://www.vasterad.com/themes/findeo_updated/scripts/magnific-popup.min.js"></script>
<script type="text/javascript" src="https://www.vasterad.com/themes/findeo_updated/scripts/owl.carousel.min.js"></script>
<script type="text/javascript" src="https://www.vasterad.com/themes/findeo_updated/scripts/rangeSlider.js"></script>
<script type="text/javascript" src="https://www.vasterad.com/themes/findeo_updated/scripts/sticky-kit.min.js"></script>
<script type="text/javascript" src="https://www.vasterad.com/themes/findeo_updated/scripts/slick.min.js"></script>
<script type="text/javascript" src="https://www.vasterad.com/themes/findeo_updated/scripts/mmenu.min.js"></script>
<script type="text/javascript" src="https://www.vasterad.com/themes/findeo_updated/scripts/tooltips.min.js"></script>
<script type="text/javascript" src="https://www.vasterad.com/themes/findeo_updated/scripts/masonry.min.js"></script>
<script type="text/javascript" src="https://www.vasterad.com/themes/findeo_updated/scripts/custom.js"></script>





</div>
<!-- Wrapper / End -->


</body>
</html>