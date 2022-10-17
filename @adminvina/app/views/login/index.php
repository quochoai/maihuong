<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $lang['admin_title']; ?></title>
  <link rel="canonical" href="<?php echo _urladmin ?>"/>
  <meta name="description" content="<?php echo $lang['admin_description'] ?>" />
  <meta name="keywords" content="<?php echo $lang['admin_keyword'] ?>" />
  <meta property="og:locale" content="vi_VN" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo $lang['admin_title']; ?>" />
    <meta property="og:description" content="<?php echo $lang['admin_description'] ?>" />
    <meta property="og:image" content="" />
    <meta property="og:url" content="<?php echo _urladmin ?>" />
    <meta name="twitter:title" content="<?php echo $lang['admin_title']; ?>" />
    <meta name="twitter:description" content="<?php echo $lang['admin_description'] ?>" />
    <meta name="twitter:url" content="<?php echo _urladmin ?>" />
    <meta name="twitter:card" content="summary">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $def['themePlugins']; ?>fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo $def['themePlugins']; ?>icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?php echo $def['themePlugins']; ?>toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $def['themeDist']; ?>css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style type="text/css">
    /*.login-logo, .register-logo {font-size: 1.3rem;font-weight: 300;margin-bottom: .9rem;text-align: center;}*/
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo"><?php echo $lang['admin_login']; ?></div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg"><?php echo $lang['signin_to_start_session']; ?></p>
      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" id="username" placeholder="<?php echo $lang['username'] ?>" autofocus />
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="password" placeholder="<?php echo $lang['password']; ?>" />
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-eye-slash"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <div class="icheck-success">
              <input type="checkbox" id="rememerLogin" />
              <label for="rememerLogin"><?php echo $lang['remember'] ?></label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-6">
            <button type="button" id="loginBtn" class="btn btn-success btn-block"><?php echo $lang['signIn']; ?></button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<!-- jQuery -->
<script src="<?php echo $def['themePlugins']; ?>jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo $def['themePlugins']; ?>bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Toastr -->
<script src="<?php echo $def['themePlugins']; ?>toastr/toastr.min.js"></script>
<!-- login -->
<script type="text/javascript">
  $(document).ready(function(){
    function login(){
      let usernameElement = $('#username');
      let passwordElement = $('#password');
      let rememberElement = $('#rememerLogin');
      var btnLogin = $('button#loginBtn');
      let username = $.trim(usernameElement.val());
      let password = $.trim(passwordElement.val());
      let remember = 0;
      if (rememberElement.is(':checked'))
        remember = 1;
      else 
        remember = 0;
      if(username.length == 0) {
        toastr.error('<?php echo $lang['not_input_username'] ?>');
        usernameElement.addClass('is-invalid');
        usernameElement.focus();
        return false;
      } else {
        usernameElement.addClass('is-valid');
        usernameElement.removeClass('is-invalid');
      }
      if(password.length == 0) {
        toastr.error('<?php echo $lang['not_input_password'] ?>');
        passwordElement.addClass('is-invalid');
        passwordElement.focus();
        return false;
      } else {
        passwordElement.addClass('is-valid');
        passwordElement.removeClass('is-invalid');
      }
      
      btnLogin.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <?php echo $lang['processing'] ?>');
    
      $.post("<?php echo $def['loginProcess']; ?>", {username: username, password: password, remember: remember}, function(respon){
        btnLogin.html('<?php echo $lang['signIn']; ?>');
        if(respon == '2'){
          toastr.error('<?php echo $lang['invalid_username'] ?>');
          usernameElement.addClass('is-invalid');
          usernameElement.focus();
          return false;
        } else {
          usernameElement.addClass('is-valid');
          usernameElement.removeClass('is-invalid');
          if(respon == '3') {
            toastr.error('<?php echo $lang['password_wrong'] ?>');
            passwordElement.addClass('is-invalid');
            passwordElement.focus();
            return false;
          } else {
            if(respon == '1') {
              passwordElement.addClass('is-valid');
              passwordElement.removeClass('is-invalid');
                toastr.success('<?php echo $lang['login_successful'] ?>');
                location.assign("<?php echo _urladmin ?>");
            } else
              toastr.success('<?php echo $lang['system_error'] ?>');                                
          }
        }
      });
    }
    $('#loginBtn').click(function(){
      login();
    });
    $('input#username').keydown(function(e) {
      if (e.keyCode == 13) {
        login();
      }
    });
    $('input#password').keydown(function(e) {
      if (e.keyCode == 13) {
        login();
      }
    });
    $(document).on('click', '.fa-eye-slash', function(){
      $("#password").attr('type', 'text');
      $(this).addClass('fa-eye');
      $(this).removeClass('fa-eye-slash'); 
    });
    
    $(document).on('click', '.fa-eye', function(){
      $("#password").attr('type', 'password');
      $(this).addClass('fa-eye-slash');
      $(this).removeClass('fa-eye'); 
    }); 
  });
</script>
</body>
</html>