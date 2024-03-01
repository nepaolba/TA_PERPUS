<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PERPUSTAKAAN | Log in</title>
  <link rel="icon" href="<?= base_url('assets/') ?>dist/img/logo.png" type="image/x-icon">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/toastr/toastr.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/AdminLTE.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,800;1,900&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Rubik', sans-serif;
    }

    .login-box-body {
      border-radius: 10px;
    }

    .form-control {
      font-size: 12px;
    }

    #eye-icon {
      cursor: pointer;
      pointer-events: all;
    }

    small.text-danger {
      font-size: 11px;
    }

    .form-control,
    .btn {
      border-radius: 5px !important;
    }
  </style>
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="#"><b>PERPUS</b>TAKAAN</a>
    </div>
    <div class="login-box-body">
      <div class="login-logo">
        <img src="<?= base_url('assets/') ?>dist/img/logo.png" width="80" alt="">
      </div>
      <div id="flash" data-flash="<?= $this->session->flashdata('msg') ?>"></div>
      <!-- <p class="login-box-msg">Sign in to start your session</p> -->
      <form action="<?= base_url('Auth') ?>" method="post">
        <div class="form-group has-feedback">
          <input type="text" class="form-control" id="username" name="username" value="<?= set_value('username') ?>" placeholder="Username">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          <?= form_error('username', '<small class="text-danger"><i class="fa fa-info-circle"></i> ', '</small>') ?>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          <span class="glyphicon glyphicon-eye-open form-control-feedback " id="eye-icon"></span>
          <?= form_error('password', '<small class="text-danger"><i class="fa fa-info-circle"></i> ', '</small>') ?>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
          </div>
        </div>
      </form>
      <br>
      <a href="#">Lupa Password</a><br>
      <a href="register.html" class="text-center">Buat Akun Baru</a><br><br>
    </div>
  </div>
  <script src="<?= base_url('assets/') ?>bower_components/jquery/dist/jquery.min.js"></script>
  <script src="<?= base_url('assets/') ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?= base_url('assets/') ?>bower_components/toastr/toastr.min.js"></script>
  <script>
    $(document).ready(function() {

      const passwordField = $('#password');
      const toggleButton = $('#eye-icon');
      const eyeIcon = $(toggleButton);
      toggleButton.click(function() {
        const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
        passwordField.attr('type', type);
        if (type === 'password') {
          eyeIcon.removeClass('glyphicon-eye-close').addClass('glyphicon-eye-open');
        } else {
          eyeIcon.removeClass('glyphicon-eye-open').addClass('glyphicon-eye-close');
        }
      });
    });
    toastr.options = {
      "positionClass": "toast-top-right"
    }
    const flash = $('#flash').data('flash')
    if (flash) {
      toastr.error(flash)
    }
  </script>


</body>

</html>