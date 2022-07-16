<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Mr.Realtor | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=base_url()?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=base_url()?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?=base_url()?>plugins/iCheck/square/blue.css">
  
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
    


  <?php if($this->session->flashdata('success') != null &&  $this->session->flashdata('success') != ''){?>
         <input type='hidden' value='<?=$this->session->flashdata('success');?>' status='success' id='notification'>
        
        <?php }else if($this->session->flashdata('error') != null &&  $this->session->flashdata('error') != ''){?>


                <input type='hidden' value='<?=$this->session->flashdata('error');?>' 
                            status='failure' id='notification'>
        
        <?php } ?>	
      <body class="hold-transition login-page">

                    <?php                    
                    if(isset($_view) && $_view)
                        $this->load->view($_view);
                    ?>                    
              
  
<!-- jQuery 3 -->
<script src="<?=base_url()?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url()?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?=base_url()?>plugins/iCheck/icheck.min.js"></script>


<!-- Bootstrap Notify Plugin Js -->
<script src="<?php echo base_url('resources/js/bootstrap-notify.js');?>" ></script>
<script src="<?php echo base_url('resources/js/notifications.js');?>"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
<script>
  $(document).ready(function(){
        
        $('.flashdata').fadeOut(3000);


      if($('#notification').attr('status') == 'success'){

          var text = $('#notification').val();
          showNotification('alert-success', text,'top', 'right','', '');


      }else if($('#notification').attr('status') == 'failure'){

              var text = $('#notification').val();
          showNotification('alert-danger', text,'top', 'right','', '');

      }
  })

</script>
</body>
</html>
