<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Guppy adalah aplikasi keuangan berbasis web yang dapat mempermudah mengelola keuangan ditokomu. Tersedia beberapa fitur seperti mesin kasir, laporan keuangan, pembelian, penjualan, stok barang, dan masih banyak lagi">
    <title>Guppy | Aplikasi keuangan berbasis web untuk mempermudah mengelola keuangan di tokomu</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/').'plugins/sweetalert/css/sweetalert.css'; ?>">


  </head>
  <body>
    
<main>

  <div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
      <div class="col-lg-7 text-center text-lg-start">
        <h1 class="display-4 fw-bold lh-1 text-body-emphasis mb-3">Guppy</h1>
        <p class="col-lg-10 fs-4">Guppy adalah aplikasi keuangan berbasis web yang dapat mempermudah mengelola keuangan ditokomu</p>
        <p class="col-lg-10 fs-4">Tersedia beberapa fitur seperti mesin kasir, laporan keuangan, pembelian, penjualan, stok barang, dan masih banyak lagi</p>
        <a class="w-50 btn btn-lg btn-primary" href="<?php echo base_url('register') ?>">Daftar!</a>
        <p class="col-lg-10 fs-4">Tunggu apa lagi, daftar sekarang GRATIS!</p>
      </div>
      <div class="col-md-10 mx-auto col-lg-5">
        <form id="form_data" method="post" class="p-4 p-md-5 border rounded-3 bg-body-tertiary">
          <div class="form-floating mb-3">
            <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Email address</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
          </div>
          <button class="w-100 btn btn-lg btn-primary btn_action" type="button" data-idle="Masuk" data-process="Login..." data-form="#form_data" data-action="<?php echo base_url('login'); ?>" data-redirect="<?php echo base_url('dashboard'); ?>">Masuk</button>
          <hr class="my-4">
          <small class="text-body-secondary">Belum punya akun ? silakan daftar <a href="<?php echo base_url('register') ?>">disini</a></small>
        </form>
      </div>
    </div>
  </div>

</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
<!-- jQuery 3 -->
<script src="<?php echo base_url('assets/').'js/jquery.min.js';?>"></script>
<!-- SweetAlert -->
<script src="<?php echo base_url('assets/').'plugins/sweetalert/js/sweetalert.min.js';?>"></script>

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
