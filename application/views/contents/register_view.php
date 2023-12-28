<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Guppy | Registration</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Tell the browser to be responsive to screen width -->
  <link rel="stylesheet" href="<?php echo base_url('assets/').'css/bootstrap.min.css'; ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/').'css/font-awesome/css/font-awesome.min.css?v=2'; ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/').'css/Ionicons/css/ionicons.min.css'; ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/').'css/AdminLTE.min.css'; ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/').'plugins/sweetalert/css/sweetalert.css'; ?>">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="register-box">
<div class="register-logo">
<a href="register"><b>Guppy</b></a>
</div>
<div class="register-box-body">
<p class="login-box-msg">Pendaftaran akun baru</p>
<form autocomplete="off" id="form_data" method="post">
<div class="form-group has-feedback">
<input name="fullname" type="text" class="form-control" placeholder="Nama Lengkap">
<span class="fa fa-user form-control-feedback"></span>
</div>
<div class="form-group has-feedback">
<input name="email" type="text" class="form-control" placeholder="Email" autocomplete="nope">
<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
</div>
<div class="form-group has-feedback">
<input name="phone" type="text" class="form-control" placeholder="Telepon">
<span class="fa fa-phone form-control-feedback"></span>
</div>
<div class="form-group has-feedback">
<input name="password" type="password" class="form-control" placeholder="Password">
<span class="fa fa-lock form-control-feedback"></span>
</div>
<div class="form-group has-feedback">
<input name="password2" type="password" class="form-control" placeholder="Ulangi Password">
<span class="fa fa-lock form-control-feedback"></span>
</div>
<hr>
<div class="form-group has-feedback">
<input name="store" type="text" class="form-control" placeholder="Nama Toko">
<span class="fa fa-shopping-bag form-control-feedback"></span>
</div>

<div class="row">
<div class="col-xs-8">
</div>
<div class="col-xs-4">
<button type="button" class="btn btn-primary btn-block btn-flat btn_action" data-idle="Daftar" data-process="Pendaftaran..." data-form="#form_data" data-action="<?php echo base_url('register'); ?>" data-redirect="<?php echo base_url(); ?>">Daftar</button>
</div>

</div>
</form>
<a href="login" class="text-center">Sudah punya akun</a>
</div>

</div>

<!-- jQuery 3 -->
<script src="<?php echo base_url('assets/').'js/jquery.min.js';?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('assets/').'js/bootstrap.min.js';?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/').'js/adminlte.min.js';?>"></script>
<!-- SweetAlert -->
<script src="<?php echo base_url('assets/').'plugins/sweetalert/js/sweetalert.min.js';?>"></script>
<!-- custom js general -->
<?php $this->load->view('script/general_script') ?>
<script type="text/javascript">
  $('#password').keypress(function (e) {
   var key = e.which;
   console.log(key);
   if(key == 13)
    {
      $('.btn_action').click();
      return false;
    }
  });
</script>
</body>
</html>
