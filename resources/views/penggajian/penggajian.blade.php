@extends('master')
@section('css')
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection
@section('konten')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Penggajian</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Penggajian</li>
            </ol>
          </div>
          <div class="col-sm-7"> </div>
          <div class="col-sm-5">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <p>{{ $message }}</p>
                </div>
            @elseif ($message = Session::get('error'))
            @endif
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Data Penggajian</h3>
                        <div class="card-tools">
                            @if (Auth::user()->pegawai->role == 3)
                                <a href="{{ url('penggajian/tambah') }}" class="btn btn-tool"> <i class="fas fa-plus"></i> </a>
                            @endif
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>ID Pegawai</th>
                                    <th>Nama Pegawai</th>
                                    <th>Gaji Pokok</th>
                                    <th>Tunjangan</th>
                                    <th>Bonus</th>
                                    <th>Jabatan</th>
                                    <th>Operasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $d)
                                <tr>
                                    <td> {{ $d->id_gaji }} </td>
                                    <td> {{ $d->id_pegawai }} </td>
                                    <td>{{ $d->user->name }}</td>
                                    <td>Rp.{{ number_format($d->gaji_pokok, 2, ',', '.') }}</td>
                                    <td>Rp.{{ number_format($d->tunjangan, 2, ',', '.') }}</td>
                                    <td>Rp.{{ number_format($d->bonus, 2, ',', '.') }}</td>
                                    <td>
                                        @if ( $d->user->role == 3)
                                            Owner
                                        @elseif ( $d->user->role == 2)
                                            Admin
                                        @elseif ( $d->user->role == 0)
                                            Petugas Kebun
                                        @endif

                                    </td>

                                    <td>
                                        @if (Auth::user()->role == 3)
                                            <a class="nav-link" data-toggle="dropdown" href="#">
                                                <i class="fas fa-bars"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                                <div class="dropdown-divider"></div>
                                                <a href="{{ url('penggajian/print', [$d->id_gaji]) }}" target="__BLANK" class="dropdown-item">
                                                    <i class="fas fa-print"></i> print
                                                </a>
                                                <a href="{{ url('penggajian/edit', [$d->id_gaji]) }}" class="dropdown-item">
                                                    <i class="fas fa-pen"></i> Edit
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a href="{{ url('penggajian/destroy', [$d->id_gaji]) }}" class="dropdown-item">
                                                    <i class="fas fa-eraser"></i> Hapus
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>ID Pegawai</th>
                                    <th>Nama Pegawai</th>
                                    <th>Gaji Pokok</th>
                                    <th>Tunjangan</th>
                                    <th>Bonus</th>
                                    <th>Jabatan</th>
                                    <th>Operasi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            <!-- /.card -->
            </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
@section('js')
<!-- DataTables  & Plugins -->
<script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('backend/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('backend/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "buttons": [
            {extend: 'colvis', postfixButtons: [ 'colvisRestore' ] },

            {extend: 'excel', title: 'Data Trans 2 PT Sari Bumi Mulya',exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7],
                modifier: {
                    page: 'current'
                }
            }}
        ]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
@endsection
