<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Mr.Realtor</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap 3.3.6 -->
      <link rel="stylesheet" href="<?=base_url()?>bower_components/bootstrap/dist/css/bootstrap.min.css">
		  <!-- Font Awesome -->
		  <link rel="stylesheet" href="<?=base_url()?>bower_components/font-awesome/css/font-awesome.min.css">
		  <!-- Ionicons -->
		  <link rel="stylesheet" href="<?=base_url()?>bower_components/Ionicons/css/ionicons.min.css">
		  <!-- Theme style -->
		  <link rel="stylesheet" href="<?=base_url()?>dist/css/AdminLTE.min.css">
		  <!-- AdminLTE Skins. Choose a skin from the css/skins
			   folder instead of downloading all of them to reduce the load. -->
		  <link rel="stylesheet" href="<?=base_url()?>dist/css/skins/_all-skins.min.css">
		  <!-- Morris chart -->
		  <link rel="stylesheet" href="<?=base_url()?>bower_components/morris.js/morris.css">
		  <!-- jvectormap -->
		  <link rel="stylesheet" href="<?=base_url()?>bower_components/jvectormap/jquery-jvectormap.css">
		  <!-- Date Picker -->
		  <link rel="stylesheet" href="<?=base_url()?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
		  <!-- Daterange picker -->
		  <link rel="stylesheet" href="<?=base_url()?>bower_components/bootstrap-daterangepicker/daterangepicker.css">
		  <!-- bootstrap wysihtml5 - text editor -->
		  <link rel="stylesheet" href="<?=base_url()?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
		  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		  <!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		  <![endif]-->

		  <!-- Google Font -->
		  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
		  
		   <!-- data table -->
          <link rel="stylesheet" href="<?=base_url()?>resources/css/jquery.dataTables.min.css">
            
            
<!-- jQuery 3 -->
<script src="<?=base_url()?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?=base_url()?>bower_components/jquery-ui/jquery-ui.min.js"></script>
<script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCqD_u0fql94lyAkirAlzi_doJbHmmuMc4&callback=myMap&sensor=false&amp;libraries=places">
        </script>
    </head>
    <style>

          .float-right{

            float:right;
            margin-left:%;
          }
          .skin-blue .main-header .navbar {
              background-color: rgb(238,59,47);
          }

          .skin-blue .main-header .logo {
              background-color: rgb(238,59,47);
              color: #fff;
              border-bottom: 0 solid transparent;
          }
          table.dataTable {
            width: 100% !important;
 
        }
          .select2-container--default .select2-selection--multiple .select2-selection__choice {
               
                color: #171414 !important;
            }
    </style>
    
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
          
  <header class="main-header">
    <!-- Logo -->
    <a href="<?=base_url()?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">MR</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">Mr.Realtor</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <?php if($this->session->userdata('photo_path') != '') {?>
              <img src="<?=base_url()?><?=$this->session->userdata('photo_path')?>" class="user-image" alt="User Image">
            <?php }else{ ?>
                
                <img src="<?=base_url()?>/resources/img/noavatar.png" class="user-image" alt="User Image">
             <?php } ?>
              <span class="hidden-xs"><?=$this->session->userdata('user_name')?></span>
            </a>
            <ul class="dropdown-menu">
              
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?=site_url()?>CompanyAdmins/edit/<?=$this->session->userdata('user_id')?>" class="btn btn-default btn-flat">Profile</a>
                </div> 
                <div class="pull-right">
                  <a href="<?=site_url()?>/Login/logOut" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
       
        </ul>
      </div>
    </nav>
  </header>
  <?php if($this->session->flashdata('success') != null &&  $this->session->flashdata('success') != ''){?>
         <input type='hidden' value='<?=$this->session->flashdata('success');?>' status='success' id='notification'>
        
        <?php }else if($this->session->flashdata('error') != null &&  $this->session->flashdata('error') != ''){?>


                <input type='hidden' value='<?=$this->session->flashdata('error');?>' 
                            status='failure' id='notification'>
        
        <?php } ?>	
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <?php if($this->session->userdata('photo_path') != '') {?>
              <img src="<?=base_url()?><?=$this->session->userdata('photo_path')?>" class="img-circle" alt="User Image">
            <?php }else{ ?>
                <img src="<?=base_url()?>/resources/img/noavatar.png" class="user-image" alt="User Image">
            <?php } ?>
          </div>
          <div class="pull-left info">
            <p><?=$this->session->userdata('user_name')?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <?php $permissions = explode(',',$this->session->userdata('permissions'));?>
        <ul class="sidebar-menu" data-widget="tree">
              <li class="header">MAIN NAVIGATION</li>
              <?php $url = $this->uri->segment(1);?>
              <?php if(in_array(DASHBOARD,$permissions) ){ ?>
                  <li>
                      <a href="<?=base_url()?>">
                      <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                      </a>
                  </li>
             <?php } ?>
             <?php if(in_array(LOCATION_MANAGEMENT,$permissions) ){ ?>
                  <li class='treeview'>
                    <a href="#">
                        <i class="fa fa-location-arrow"></i> <span>Location Management</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                  <ul class="treeview-menu">

                      <li >
                        <a href="<?php echo site_url('area/index');?>">
                           <span>Areas List</span>
                        </a>
                      
                    </li>
                  
                    <li class=''>
                        <a href="<?php echo site_url('city/index');?>">
                           <span>Cities List</span>
                        </a>
                        
                    </li>
                    <li>
                        <a href="<?php echo site_url('state/index');?>"> States List</a>
                    </li>
                  
                  </ul>
              </li>
            <?php } ?>
            
                <?php if($this->session->userdata('Role') == 1){ ?>
                <li <?php if($url=='Companies'){?> class='active' <?php } ?>>
                    <a href="<?php echo site_url('Companies/index');?>">
                    <i class="fa fa-arrows"></i> <span>Company Management</span>
                    </a>
                  
                </li>
              <?php } ?>
<?php if($this->session->userdata('Role') != 3){ ?>
                <li <?php if($url=='CompanyAdmins'){?> class='active' <?php } ?>>
                    <a href="<?php echo site_url('CompanyAdmins/index');?>">
                    <i class="fa fa-arrows"></i> <span>Company Admin</span>
                    </a>
                  
                </li>
              <?php } ?>
                <li <?php if($url=='CompanyVentures'){?> class='active' <?php } ?>>
                    <a href="<?php echo site_url('CompanyVentures/index');?>">
                    <i class="fa fa-product-hunt"></i> <span>Ventures</span>
                    </a>
                  
                </li>
                 <li <?php if($url=='CheckedInUsers'){?> class='active' <?php } ?>>
                    <a href="<?php echo site_url('CheckedInUsers/index');?>">
                    <i class="fa fa-product-hunt"></i> <span>Checked In Users</span>
                    </a>
                  
                </li>
            </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Main content -->
                <section class="content">
                    <?php                    
                    if(isset($_view) && $_view)
                        $this->load->view($_view);
                    ?>                    
                </section>
                <!-- /.content -->
            </div>
         <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
     
    </div>
    <strong>Copyright &copy; <?=date('Y')?> <a href="#">Mr.Realtor</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url()?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="<?=base_url()?>bower_components/raphael/raphael.min.js"></script>
<script src="<?=base_url()?>bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?=base_url()?>bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?=base_url()?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?=base_url()?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?=base_url()?>bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?=base_url()?>bower_components/moment/min/moment.min.js"></script>
<script src="<?=base_url()?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?=base_url()?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?=base_url()?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?=base_url()?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?=base_url()?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?=base_url()?>dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url()?>dist/js/demo.js"></script>

<!-- Bootstrap Notify Plugin Js -->
<script src="<?php echo base_url('resources/js/bootstrap-notify.js');?>" ></script>
<script src="<?php echo base_url('resources/js/notifications.js');?>"></script>


<!-- data table  -->
<script src="<?=base_url()?>resources/js/jquery.dataTables.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>

<!-- Bootstrap CKEditor -->
      <script src="<?php echo base_url('bower_components/ckeditor/ckeditor.js');?>"></script>

<script>
  $(document).ready(function(){
        
       $('#datatable').DataTable({ scrollX:        true});
        console.log('helo');
        $('.flashdata').fadeOut(3000);


      if($('#notification').attr('status') == 'success'){

          var text = $('#notification').val();
          showNotification('alert-success', text,'top', 'right','', '');


      }else if($('#notification').attr('status') == 'failure'){

              var text = $('#notification').val();
          showNotification('alert-danger', text,'top', 'right','', '');

      }

      $('.js-example-basic-multiple').select2();
  })

  
    function isNumberKey(evt){
    
        var charCode = (evt.which) ? evt.which : event.keyCode;
        
        if(charCode == 46)
            return true;
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    function isDecimal(evt){
    
        var charCode = (evt.which) ? evt.which : event.keyCode;
        
        if(charCode == 46)
            return true;
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
    
    
     function onlyAlphabets(e, t) {
                try {
                    if (window.event) {
                        var charCode = window.event.keyCode;
                    }
                    else if (e) {
                        var charCode = e.which;
                    }
                    else { return true; }

                /* console.log($.in_array(charCode, [32,46, 8, 9, 27, 13, 110, 190]));*/
                    if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) 
                        || $.inArray(charCode, [32,46, 8, 9, 27, 13, 110, 190]) >= 0)
                        return true;
                    else
                        return false;
                }
                catch (err) {
                    
                    console.log(err);
                }
            }


        function noSpaceialCahrs(e, t) {

            
                try {
                    if (window.event) {
                        var charCode = window.event.keyCode;
                    }
                    else if (e) {
                        var charCode = e.which;
                    }
                    else { return true; }

                /* console.log($.in_array(charCode, [32,46, 8, 9, 27, 13, 110, 190]));*/
                    if ((charCode >= 48 && charCode <= 57 ) || (charCode >= 65 && charCode <= 90 ) || ( charCode >= 96 && charCode <= 122) 
                    ||charCode == 109 || charCode==8)
                        return true;
                    else
                        return false;
                }
                catch (err) {
                    alert(err.Description);
                }
        }
    
    
    var url = window.location;
    // for sidebar menu but not for treeview submenu
    $('ul.sidebar-menu a').filter(function() {
        return this.href == url.href;
    }).parent().siblings().removeClass('active').end().addClass('active');
    // for treeview which is like a submenu
    $('ul.treeview-menu a').filter(function() {
        return this.href == url.href;
    }).parentsUntil(".sidebar-menu > .treeview-menu").siblings().removeClass('active menu-open').end().addClass('active menu-open');


</script>


<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    
  });

  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor2')
    //bootstrap WYSIHTML5 - text editor
    
  });

  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor3')
    //bootstrap WYSIHTML5 - text editor
    
  })
</script>
</body>
</html>
