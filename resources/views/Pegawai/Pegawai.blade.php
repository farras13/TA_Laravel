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
            <h1>Data Pegawai</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pegawai</li>
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
                @elseif ($message = Session::get('errors'))
                <div class="alert alert-danger alert-dismissible">
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
                <h3 class="card-title" style="padding-top:6px;">Tabel Data Kepegawaian</h3>
                <a href="{{ route('formpegawai') }}" class="btn btn-primary float-right"> <i class="fas fa-plus"> Tambah </i> </a>
            </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Gender</th>
                    <th>Tanggal Lahir</th>
                    <th>No. Telp</th>
                    <th>Alamat</th>
                    <th>Foto</th>
                    <th>#</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $per)
                        <tr>
                            <td> {{ $per->id_pegawai }} </td>
                            <td> {{ $per->name }} </td>
                            <td> {{ $per->jk }} </td>
                            <td> {{ $per->lahir }} </td>
                            <td> {{ $per->hp }} </td>
                            <td> {{ $per->alamat }} </td>
                            <td> <img src="/image/{{ $per->foto }}" width="100px"> </td>
                            <td>
                                <a href="{{ url('pegawai/edit', [$per->id_pegawai]) }}">Edit</a>
                                <a href="{{ url('pegawai/destroy', [$per->id_pegawai]) }}">hapus</a>
                            </td>
                        </tr>
                     @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Gender</th>
                    <th>Tanggal Lahir</th>
                    <th>No. Telp</th>
                    <th>Alamat</th>
                    <th>Foto</th>
                    <th>#</th>
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
        dom: 'Bfrtip',
        "buttons": [
            {extend: 'colvis', postfixButtons: [ 'colvisRestore' ] },
            {extend: 'pdf', title:'Data Pegawai PT Sari Bumi Mulya',exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6],
                modifier: {
                    page: 'current'
                }
            }},
            {extend: 'excel', title: 'Data Pegawai PT Sari Bumi Mulya',exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6],
                modifier: {
                    page: 'current'
                }
            }},
            {extend:'print',title: 'Data Pegawai PT Sari Bumi Mulya', exportOptions: {
                stripHtml : false,
                columns: [0, 1, 2, 3, 4, 5, 6],
                modifier: {
                    page: 'current'
                }
            }},
        ]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
@endsection

