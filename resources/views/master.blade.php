<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Anggrek Singosari</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }} ">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.min.css') }}">

    @yield('css')

</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-teal">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i style="color: white" class="fas fa-bars"></i></a>
            </li>
             <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('home') }}" class="nav-link" style="color: white">Home</a>
            </li>
            {{--<li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contact</a>
            </li> --}}
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item">
                <a class="nav-link d-none d-sm-inline-block" id="tanggalwaktu" style="color: white"></a>
            <script>
            var tw = new Date();
            if (tw.getTimezoneOffset() == 0) (a=tw.getTime() + ( 7 *60*60*1000))
            else (a=tw.getTime());
            tw.setTime(a);
            var tahun= tw.getFullYear ();
            var hari= tw.getDay ();
            var bulan= tw.getMonth ();
            var tanggal= tw.getDate ();
            var hariarray=new Array("Minggu,","Senin,","Selasa,","Rabu,","Kamis,","Jum'at,","Sabtu,");
            var bulanarray=new Array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","Nopember","Desember");
            document.getElementById("tanggalwaktu").innerHTML = hariarray[hari]+" "+tanggal+" "+bulanarray[bulan]+" "+tahun;
            </script>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" style="color: white">
                    <i class="far fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i> Logout
                    </a>
                </div>
            </li>
        </ul>
    </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-info elevation-4" style="background: white;">
        <!-- Brand Logo -->
        <a href="{{ route('home') }}" class="brand-link" style="background-color: #98ddca">
            <img src="{{ asset('backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8" >
            <span class="brand-text font-weight-light" style="color: teal;">Anggrek Singosari</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar" style="background-color: white">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="/image/{{ Auth::user()->pegawai->foto }}" class="img-circle elevation-3" alt="User Image">
                </div>
                <div class="info">
                    <a style="color: teal" class="d-block">{{ Auth::user()->pegawai->name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p> Dashboard </p>
                        </a>
                    </li>

                    @if (Auth::user()->pegawai->role == 3)
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>  Pegawai <i class="right fas fa-angle-left"></i>  </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('jabatan') }}" class="nav-link">
                                    <i class="nav-icon far fa-circle" aria-hidden="true"></i>
                                    <p> Jabatan </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('Pegawai') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Pegawai</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('akun') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Akun</p>
                                </a>
                            </li>
                            @if (Auth::user()->pegawai->role == 2 || Auth::user()->pegawai->role == 3)
                                <li class="nav-item">
                                    <a href="{{ route('absensi') }}" class="nav-link">
                                        <i class="nav-icon far fa-circle" aria-hidden="true"></i>
                                        <p> Absensi </p>
                                    </a>
                                </li>
                            @endif

                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('penggajian') }}" class="nav-link">
                            <i class="nav-icon fas fa-money-check" aria-hidden="true"></i>
                            <p> Penggajian </p>
                        </a>
                    </li>

                    @endif
                    @if (Auth::user()->pegawai->role == 2 || Auth::user()->pegawai->role == 3)
                    <li class="nav-item">
                        <a href="{{ route('gen') }}" class="nav-link">
                            <i class="fas fa-money-check nav-icon"></i>
                            <p>Gen</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-plus-square"></i>
                            <p> Inventory <i class="fas fa-angle-left right"></i>  </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('gudang') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Gudang</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                    Eksternal
                                    <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                    <a href="{{ route('eksin') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Masuk</p>
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                    <a href="{{ route('eksout') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Keluar</p>
                                    </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    @endif

                    <li class="nav-header">Persilangan</li>
                    <li class="nav-item">
                    <a href="{{ route('persilangan') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Persilangan</p>
                    </a>
                    </li>

                    @if (Auth::user()->pegawai->role != 1)
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                            Kebun
                            <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                            <a href="{{ route('proses') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Proses Buah</p>
                            </a>
                            </li>
                            <li class="nav-item">
                            <a href="{{ route('panen') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Panen Buah</p>
                            </a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    @if (Auth::user()->pegawai->role != 0)
                    <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                        Lab
                        <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                        <a href="{{ route('trans') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Trans 1</p>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a href="{{ route('trans2') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Trans 2</p>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a href="{{ route('trans3') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Trans 3</p>
                        </a>
                        </li>
                    </ul>
                    </li>
                    @endif
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
    <!-- /.sidebar -->
    </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @yield('konten')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2021 <a href="https://adminlte.io">Anggrek Singosari</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('backend/plugins/jquery/jquery.min.js') }} "></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.js') }} "></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('backend/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('backend/dist/js/demo.js') }}"></script>

    @yield('js')

</body>
</html>
