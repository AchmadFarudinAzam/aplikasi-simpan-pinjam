<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Admin | Koperasi')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset ('template/adminlte3/plugins/fontawesome-free/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset ('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset ('template/adminlte3/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <!-- Google Font: Source Sans Pro -->
    <link href="{{ asset ('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700')}}" rel="stylesheet">

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset ('template/vendors/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset ('template/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</head>

<body class="hold-transition sidebar-mini sidebar-collapse layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light fixed-top">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    Administrator
                </div>
            </form>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="{{ route('admin.pengajuan') }}" class="dropdown-item" title="Log Entri"><i class="fa fa-tasks"></i> Log Pengajuan</a>
                        <a href="{{ route('admin.nasabah.index') }}" class="dropdown-item" title="Log Login"><i class="fa fa-users"></i> Log Nasabah</a>
                        <a href="{{ route('admin.pengajuan.verifikasi') }}" class="dropdown-item" title="Belum Lunas"><i class="fa fa-hourglass-end"></i> Log Bayar</a>
                    </div>
                </li>

                <form action="{{ route('admin.logout') }}" method="POST" onsubmit="return confirm('Yakin ingin logout?')">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link">
                <span class="brand-text font-weight-light">ADMIN</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    BERANDA
                                </p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    SETTING
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/adm/s/pass.php" class="nav-link">&nbsp;&nbsp;
	                                    <i class="fa fa-arrow-circle-right nav-icon"></i>
	                                    <p>Ganti Password</p>
	                                </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-tasks"></i>
                                <p>
                                    HISTORY
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/adm/h/login.php" class="nav-link">&nbsp;&nbsp;
	                                    <i class="fa fa-arrow-circle-right nav-icon"></i>
	                                    <p>Login</p>
	                                </a>
                                </li>
                            </ul>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/adm/h/entri.php" class="nav-link">&nbsp;&nbsp;
	                                    <i class="fa fa-arrow-circle-right nav-icon"></i>
	                                    <p>Entri</p>
	                                </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-briefcase"></i>
                                <p>
                                    MASTER
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{ route('admin.pengajuan') }}" class="nav-link">&nbsp;&nbsp;
	                                    <i class="fa fa-arrow-circle-right nav-icon"></i>
	                                    <p>Daftar Pengajuan Baru</p>
	                                </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('admin.nasabah.index') }}" class="nav-link">&nbsp;&nbsp;
	                                    <i class="fa fa-arrow-circle-right nav-icon"></i>
	                                    <p>Data Anggota</p>
	                                </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-money"></i>
                                <p>
                                    PEMINJAMAN
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="#" class="nav-link">&nbsp;&nbsp;
	                                    <i class="fa fa-arrow-circle-right nav-icon"></i>
	                                    <p>Pinjaman Aktif</p>
	                                </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('admin.pengajuan.verifikasi') }}" class="nav-link">&nbsp;&nbsp;
	                                    <i class="fa fa-arrow-circle-right nav-icon"></i>
	                                    <p>Verifikasi Pembayaran</p>
	                                </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('admin.laporan.pinjaman') }}" class="nav-link">&nbsp;&nbsp;
	                                    <i class="fa fa-arrow-circle-right nav-icon"></i>
	                                    <p>Lap. Pinjaman</p>
	                                </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#" class="nav-link">&nbsp;&nbsp;
	                                    <i class="fa fa-arrow-circle-right nav-icon"></i>
	                                    <p>Lap. Belum Lunas</p>
	                                </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#" class="nav-link">&nbsp;&nbsp;
	                                    <i class="fa fa-arrow-circle-right nav-icon"></i>
	                                    <p>Lap. Lunas</p>
	                                </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-archive"></i>
                                <p>
                                    SIMPANAN
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{ route('admin.simpanan.verifikasi') }}" class="nav-link">&nbsp;&nbsp;
	                                    <i class="fa fa-arrow-circle-right nav-icon"></i>
	                                    <p>Verifikasi Simpanan Baru</p>
	                                </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('admin.laporan.simpanan') }}" class="nav-link">&nbsp;&nbsp;
	                                    <i class="fa fa-arrow-circle-right nav-icon"></i>
	                                    <p>Lap. Simpanan</p>
	                                </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#" class="nav-link">&nbsp;&nbsp;
	                                    <i class="fa fa-arrow-circle-right nav-icon"></i>
	                                    <p>Simpanan Pokok</p>
	                                </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#" class="nav-link">&nbsp;&nbsp;
	                                    <i class="fa fa-arrow-circle-right nav-icon"></i>
	                                    <p>Simpanan Wajib</p>
	                                </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#" class="nav-link">&nbsp;&nbsp;
	                                    <i class="fa fa-arrow-circle-right nav-icon"></i>
	                                    <p>Simpanan Sukarela</p>
	                                </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h1>@yield('title', 'Admin | Koperasi')</h1>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <!-- Default box -->
                            <div class="card">
                                <div class="card-body">

                                    <!-- Bootstrap core JavaScript -->
                                    <script src="{{ asset ('template/vendors/jquery/jquery.min.js') }}"></script>
                                    <script src="{{ asset ('template/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

                                    @yield('content')

                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset ('template/adminlte3/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset ('template/adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset ('template/adminlte3/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset ('template/adminlte3/dist/js/demo.js') }}"></script>
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>