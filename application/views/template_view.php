<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Guppy</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url('assets/').'css/bootstrap.min.css'; ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="<?php echo base_url('assets/').'css/font-awesome/css/font-awesome.min.css?v=2'; ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url('assets/').'css/Ionicons/css/ionicons.min.css'; ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/').'css/select2.min.css'?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/').'css/AdminLTE.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/').'css/skins/skin-blue-light.min.css'; ?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/').'plugins/sweetalert/css/sweetalert.css'; ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/').'css/jquery-ui.css'; ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/').'css/jquery-ui-timepicker-addon.min.css'?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/').'css/general.css?220925'?>">

    <?php $this->load->view('style/general') ?>
    <?php echo isset($css)?$css:'' ?>

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>

<body class="skin-blue-light fixed sidebar-mini">
    <div class="wrapper">

        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="<?php echo base_url(); ?>" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">G</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Guppy</b></span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <!-- hidden-xs hides the email on small devices so only the image appears. -->
                                <span><?php echo $this->session_login['fullname'] ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <p>
                                        <?php echo $this->session_login['fullname'] ?>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?php echo base_url('user/change_password'); ?>"
                                            class="btn btn-default btn-flat">Ganti Password</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo base_url('login/logout'); ?>"
                                            class="btn btn-default btn-flat">Keluar</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">

            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar Menu -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MENU UTAMA</li>
                    <li class="<?php echo $this->uri->segment(1)==''?'active':''?>"><a href="<?php echo base_url() ?>"><i class="fa fa-circle-o text-aqua"></i> <span>Dashboard</span></a></li>
                    <li class="<?php echo $this->uri->segment(1)=='trans'?'active':''?>"><a href="<?php echo base_url('trans') ?>"><i class="fa fa-circle-o text-aqua"></i> <span>Keuangan</span></a></li>
                    <li class="<?php echo $this->uri->segment(1)=='item'?'active':''?>"><a href="<?php echo base_url('item') ?>"><i class="fa fa-circle-o text-aqua"></i> <span>Produk</span></a></li>
                    <li class="<?php echo $this->uri->segment(1)=='stock'?'active':''?>"><a href="<?php echo base_url('stock') ?>"><i class="fa fa-circle-o text-aqua"></i> <span>Stok</span></a></li>
                    <li class="<?php echo $this->uri->segment(1)=='buy'?'active':''?>"><a href="<?php echo base_url('buy') ?>"><i class="fa fa-circle-o text-aqua"></i> <span>Pembelian</span></a></li>
                    <li class="<?php echo $this->uri->segment(1)=='sell'?'active':''?>"><a href="<?php echo base_url('sell') ?>"><i class="fa fa-circle-o text-aqua"></i> <span>Penjualan</span></a></li>
                    <li class="<?php echo $this->uri->segment(1)=='cashier'?'active':''?>"><a href="<?php echo base_url('cashier') ?>"><i class="fa fa-circle-o text-aqua"></i> <span>Kasir</span></a></li>
                    <li class="<?php echo $this->uri->segment(1)=='report'?'active':''?>"><a href="<?php echo base_url('report') ?>"><i class="fa fa-circle-o text-aqua"></i> <span>Laporan</span></a></li>
                    <?php if(in_array('super-admin', $this->session_module)):?>
                    <li class="header">ADMIN</li>
                    <li class="<?php echo $this->uri->segment(1)=='user'?'active':''?>"><a href="<?php echo base_url('user') ?>"><i class="fa fa-circle-o text-aqua"></i> <span>User</span></a></li>
                    <li class="<?php echo $this->uri->segment(1)=='role'?'active':''?>"><a href="<?php echo base_url('role') ?>"><i class="fa fa-circle-o text-aqua"></i> <span>Role</span></a></li>
                    <li class="<?php echo $this->uri->segment(1)=='module'?'active':''?>"><a href="<?php echo base_url('module') ?>"><i class="fa fa-circle-o text-aqua"></i> <span>Module</span></a></li>
                    <li class="<?php echo $this->uri->segment(1)=='store'?'active':''?>"><a href="<?php echo base_url('store') ?>"><i class="fa fa-circle-o text-aqua"></i> <span>Store</span></a></li>
                    <?php endif ?>
                </ul>
                <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="min-height: 449px;">
            <!-- Main content -->
            <section class="content container-fluid">
                <?php echo isset($content)?$content:''; ?>
            </section>
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="pull-right hidden-xs">
                #Guppy
            </div>
            <!-- Default to the left -->
            <strong>Develop by <a target="_blank" href="https://www.linkedin.com/in/adam-prasetia-449405109/?originalSubdomain=id">Adam Prasetia</a>
                </strong>
        </footer>

        <!-- Modal -->
        <div class="modal fade" id="general-modal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 id="general-modal-title" class="modal-title">Default Modal</h4>
                    </div>
                    <div class="modal-body">
                        <iframe id="general-modal-iframe" frameBorder="0" width="100%" height="480px"></iframe>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- ./wrapper -->

    <script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
    var base_domain = "<?php echo config_item('base_domain') ?>";
    </script>
    <!-- jQuery 3 -->
    <script src="<?php echo base_url('assets/').'js/jquery.min.js';?>"></script>
    <script src="<?php echo base_url('assets/').'js/jquery.slimscroll.min.js';?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/'); ?>js/jquery-ui.min.js"></script>
    <script type="text/javascript"
        src="<?php echo base_url('assets/'); ?>js/jquery-ui-timepicker-addon.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo base_url('assets/').'js/bootstrap.min.js';?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('assets/').'js/adminlte.min.js';?>"></script>
    <!-- SweetAlert -->
    <script src="<?php echo base_url('assets/').'plugins/sweetalert/js/sweetalert.min.js';?>"></script>

    <script src="<?php echo base_url('assets/').'js/select2.min.js';?>"></script>
    <script src="<?php echo base_url('assets/').'js/price_format.js';?>"></script>

    <!-- custom js general -->
    <?php $this->load->view('script/general_script') ?>
    <?php echo isset($script)?$script:'' ?>
</body>

</html>