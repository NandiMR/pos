<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <title> <?php echo $__env->yieldContent('title'); ?> </title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="<?php echo e(asset('template/fontawesome-free/css/all.min.css')); ?>">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo e(asset('template/dist/css/adminlte.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('template/overlayScrollbars/css/OverlayScrollbars.min.css')); ?>">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('template/dataTables/css/dataTables.bootstrap4.min.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('template/sweetalert/sweetalert2.min.css')); ?>">
  <script src="<?php echo e(asset('template/jquery/jquery.js')); ?>"></script>

</head>
<body class="hold-transition sidebar-mini layout-fixed <?php echo e(request()->is('penjualan') ? 'sidebar-collapse' : ''); ?>">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="/home" class="brand-link">
        <img src="<?php echo e(asset('template/dist/img/12.png')); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
        style="opacity: .8">
        <span class="brand-text font-weight-light">Toko Kebutuhan</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?php echo e(asset('uploads')); ?>/<?php echo e(Auth::user()->foto); ?>" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="<?php echo e(url('user/profil')); ?>" class="d-block"><?php echo e(Auth::user()->name); ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
           <li class="nav-item">
            <a href="<?php echo e(url('home')); ?>" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>Home</p>
            </a>
          </li>
          <li class="nav-header">MENU MASTER</li>
          <li class="nav-item">
            <a href="<?php echo e(url('pelanggan')); ?>" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>Pelanggan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo e(url('pemasok')); ?>" class="nav-link">
              <i class="nav-icon fas fa-truck"></i>
              <p>Pemasok</p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-box"></i>
              <p>Produk <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo e(url('produk')); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo e(url('unit')); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Unit</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p> Transaksi <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo e(url('penjualan')); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penjualan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo e(url('pembelian')); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pembelian</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="<?php echo e(url('penjualan/laporan')); ?>" class="nav-link">
              <i class="nav-icon fa fa-file"></i>
              <p>Laporan</p>
            </a>
          </li>
          <li class="nav-header">MENU SETTING</li>
          <li class="nav-item has-treeview">
            <a href="<?php echo e(url('user/profil')); ?>" class="nav-link">
              <i class="nav-icon fa fa-user-edit"></i>
              <p>Profil</p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="<?php echo e(url('user/password')); ?>" class="nav-link">
              <i class="nav-icon fa fa-key"></i>
              <p>Password</p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link" onclick="logout();">
              <i class="nav-icon fa fa-sign-out-alt"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <div class="content-wrapper">

    <?php echo $__env->yieldContent('content'); ?>

  </div>
</div>
</section>
</div>
<footer class="main-footer">
  <strong> &copy; <a href=""></a>.</strong>
  
  <div class="float-right d-none d-sm-inline-block">
    <b></b> 
  </div>
</footer>

<aside class="control-sidebar control-sidebar-dark">
</aside>
</div>

<script src="<?php echo e(asset('template/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('template/dist/js/adminlte.js')); ?>"></script>
<script src="<?php echo e(asset('template/dist/js/demo.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('template/sweetalert/sweetalert2.min.js')); ?>"></script>
<script src="<?php echo e(asset('template/overlayScrollbars/js/jquery.overlayScrollbars.min.js')); ?>"></script>
<script src="<?php echo e(asset('template/dataTables/js/jquery.dataTables.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('template/dataTables/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script type="text/javascript">
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
</script>

<script type="text/javascript">
  function logout(){
    swal({
      title: 'Yakin Keluar?',
      type: 'warning',
      showCancelButton: true,
      allowOutsideClick: false,
      allowEscapeKey: false,
      allowEnterKey: false,
      confirmButtonText: 'Ya',
      cancelButtonText: 'Tidak',
      buttons: true
    }).then(function(){
      $.ajax({
        url : "<?php echo e(route('logout')); ?>",
        type : "POST",
        success: function(response){
          if (response == "success") {
            swal({
              title: 'Berhasil',
              type: 'success',
              allowOutsideClick: false,
              allowEscapeKey: false,
              allowEnterKey: false,
            }).then(function(){
              window.location.href = "<?php echo e(url('login')); ?>";
            });
          }
        },
        error: function (jqXHR, textStatus, errorThrown){
          swal({
            title: 'Terjadi kesalahan',
            type: 'error',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
          });
        }
      });
    }, function (dismiss) {
      if (dismiss === 'cancel') {
        swal({
          title: 'Batal',
          type: 'error',
          allowOutsideClick: false,
          allowEscapeKey: false,
          allowEnterKey: false,
        })
      }
    });
  }
</script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\pos\resources\views////template.blade.php ENDPATH**/ ?>