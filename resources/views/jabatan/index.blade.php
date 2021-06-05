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
            <h1>Data Jabatan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Jabatan</li>
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
                        <h3 class="card-title">Tabel data Jabatan</h3>
                        <div class="card-tools">
                            <a href="{{ url('jabatan/tambah') }}" class="btn btn-success"> <i class="fas fa-plus"></i> Tambah </a>
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
                                    <th>No</th>
                                    <th>Nama Jabatan</th>
                                    <th>Gaji Pokok</th>
                                    @if (Auth::user()->pegawai->role == 3)
                                    <th>Operasi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <?php $n = 1; ?>
                                @foreach($data as $per)
                                <tr>
                                    <td> {{ $n }} </td>
                                    <td> {{ $per->jabatan }} </td>
                                    <td> {{ $per->gaji_pokok }} </td>
                                    @if (Auth::user()->pegawai->role == 3)
                                    <td>
                                        <div class="btn-group">
                                                <a style="color: #333" href="{{ url('jabatan/edit', [$per->id_jabatan]) }}" class="btn btn-warning">
                                                    <i style="color: #333" class="fas fa-upload"></i>
                                                    <span>Edit</span>
                                                </a>
                                                <a style="color: #333" href="{{ url('jabatan/destroy', [$per->id_jabatan]) }}" class="btn btn-danger">
                                                    <i style="color: #333" class="fas fa-times-circle"></i>
                                                    <span>Delete</span>
                                                </a>
                                          </div>
                                    </td>
                                    @endif
                                </tr>
                                <?php $n++; ?>
                            @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Jabatan</th>
                                    <th>Gaji Pokok</th>
                                    @if (Auth::user()->pegawai->role == 3)
                                    <th>Operasi</th>
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
            {extend:'print',title: 'Data Gen PT Sari Bumi Mulya', exportOptions: {
                columns: [0, 1, 2, 3],
                modifier: {
                    page: 'current'
                }
            }},
        ]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
@endsection
