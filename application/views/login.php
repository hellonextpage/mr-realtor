

<div class="login-box">
  <div class="login-logo">
    <b>Mr. </b> REALTOR
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in </p>

    <form action="<?=site_url()?>Login/checkCompanyLogin" method="post" onsubmit = "return validate()">
      <div class="form-group has-feedback">
        <input type="email" name='email' id ='email' class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <span class="text-danger" id='err_email'></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" id='password' name='password' class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <span class="text-danger" id='err_password'></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!-- /.social-auth-links -->

  <!--   <a href="#">I forgot my password</a><br> -->
    

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<script>
    function validate(){

      let email    = $('#email').val();
      let password = $('#password').val();
      let error = 0;
      if(email == ''){

        $('#err_email').html('Please enter email');
        error = 1;
      }else{

        $('#err_email').html('');
        
      }

      if(password == ''){

          $('#err_password').html('Please enter password');
          error = 1;
      }else{

        $('#err_password').html('');

      }

      if(error == 0){

        return true;
      }else{

        return false;
      }
    }
</script>
