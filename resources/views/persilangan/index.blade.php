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
            <h1>Persilangan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Persilangan</li>
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
                        <h3 class="card-title">Tabel Data Persilangan</h3>
                        <div class="card-tools">
                            <a href="{{ url('persilangan/form') }}" class="btn btn-tool"> <i class="fas fa-plus"></i> </a>
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
                                    <th>Kode</th>
                                    <th>tanggal</th>
                                    <th>seed</th>
                                    <th>pollen</th>
                                    <th>Status</th>
                                    @if (Auth::user()->pegawai->role == 2)
                                    <th>#</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($persilangan as $per)
                                <tr>
                                    <td> {{ $per->kodePersilangan }} </td>
                                    <td> {{ $per->created_at }} </td>
                                    <td> {{ $per->tanaman->name }} </td>
                                    <td> {{ $per->tanamann->name }} </td>
                                    <td>
                                        @if ($per->status_trans3 == 3 )
                                            Tanpa Keterangan
                                        @elseif ($per->status_pk == 2 )
                                            Gagal Pada Proses Awal
                                        @elseif ($per->status_pb == 2 && $per->status_pk == 1)
                                            Gagal Pada Proses Panen
                                        @elseif ($per->status_trans == 2 && $per->status_pb == 1)
                                            Gagal Pada Proses Trans1
                                        @elseif ($per->status_trans2 == 2 && $per->status_trans == 1)
                                            Gagal Pada Proses Trans2
                                        @elseif ($per->status_trans3 == 2 && $per->status_trans2 == 1)
                                            Gagal Pada Proses Trans3
                                        @elseif ($per->status_trans3 == 1 && $per->status_trans2 == 1)
                                            Persilangan Berhasil
                                        @elseif ($per->status_trans3 == 0 && $per->status_trans2 == 1)
                                            Masih Proses Trans 3
                                        @elseif ($per->status_trans2 == 0 && $per->status_trans == 1)
                                            Masih Proses Trans 2
                                        @elseif ($per->status_trans == 0 && $per->status_pb == 1)
                                            Masih Proses Trans 1
                                        @elseif ($per->status_pb == 0 && $per->status_pk == 1)
                                            Masih Proses Panen Buah
                                        @elseif ($per->status_pk == 0 )
                                            Masih Proses Awal

                                        @endif
                                        {{-- {{ $per->status_trans }} --}}
                                    </td>
                                    <td>
                                        @if (Auth::user()->pegawai->role == 2)
                                            <a class="nav-link" data-toggle="dropdown" href="#">
                                                <i class="fas fa-bars"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                                <div class="dropdown-divider"></div>
                                                <a href="{{ url('persilangan/form-edit', [$per->kodePersilangan]) }}" class="dropdown-item">
                                                    <i class="fas fa-pen"></i> Edit
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a href="{{ url('persilangan/hapus', [$per->kodePersilangan]) }}" class="dropdown-item">
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
                                    <th>Kode</th>
                                    <th>tanggal</th>
                                    <th>seed</th>
                                    <th>pollen</th>
                                    <th>Status</th>
                                    @if (Auth::user()->pegawai->role == 2)
                                    <th>#</th>
                                    @endif
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
            {extend: 'pdf', title:'Data Persilangan PT Sari Bumi Mulya',exportOptions: {
                columns: [0, 1, 2, 3, 4],
                modifier: {
                    page: 'current'
                }
            }},
            {extend: 'excel', title: 'Data Persilangan PT Sari Bumi Mulya',exportOptions: {
                columns: [0, 1, 2, 3, 4],
                modifier: {
                    page: 'current'
                }
            }},
            {extend:'print',title: 'Data Persilangan PT Sari Bumi Mulya',exportOptions: {
                columns: [0, 1, 2, 3, 4],
                modifier: {
                    page: 'current'
                }
            }},
        ]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
@endsection
