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
            <h1>Inventory</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Inventory</li>
              <li class="breadcrumb-item active">Detail</li>
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
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Inventory</h3>
                        <div class="card-tools">
                            <a href="{{ url('gudang/tambah') }}" class="btn btn-tool"> <i class="fas fa-plus"></i> </a>
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
                        <table id="example" class="table table-striped">

                            <tbody>
                                <tr>
                                    <th>Kode</th>
                                    <td> {{ $data->idTanaman }} </td>
                                </tr>
                                <tr>
                                    <th>gen</th>
                                    <td> {{ $data->gen->gen }} </td>
                                </tr>
                                <tr>
                                    <th>nama</th>
                                    <td> {{ $data->name }} </td>
                                </tr>
                                <tr>
                                    <th>gender</th>
                                    <td> {{ $data->jk }} </td>
                                </tr>
                                <tr>
                                    <th>stok</th>
                                    <td> {{ $data->stok }} </td>
                                </tr>
                                <tr>
                                    <th>status</th>
                                    <td> {{ $data->status }} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            <!-- /.card -->
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Detail Inventory</h3>
                        <div class="card-tools">
                            <a href="{{ url('gudang/tambah') }}" class="btn btn-tool"> <i class="fas fa-plus"></i> </a>
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
                            @if ($data->status == "internal")
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>gen</th>
                                    <th>nama</th>
                                    <th>gender</th>
                                    <th>stok</th>
                                    <th>status</th>
                                </tr>
                            </thead>
                            <tbody>

                                    @foreach($persilangan as $d)
                                        <tr>
                                            <td> {{ $d['idTanaman'] }} </td>
                                            <td> {{ $d['gen']['gen'] }} </td>
                                            <td> {{ $d['nama'] }}</td>
                                            <td> {{ $d['jk'] }} </td>
                                            <td>{{ $d['jumlah'] }}</td>
                                            <td>{{ $d['status'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Kode</th>
                                        <th>gen</th>
                                        <th>nama</th>
                                        <th>gender</th>
                                        <th>stok</th>
                                        <th>status</th>
                                    </tr>
                                </tfoot>
                                @else
                                <thead>
                                    <tr>
                                        <th>Tanggal Masuk</th>
                                        <th>gen</th>
                                        <th>nama</th>
                                        <th>gender</th>
                                        <th>stok</th>
                                        <th>status</th>
                                    </tr>
                                </thead>
                                    {{-- @foreach($cek as $d) --}}
                                        <tr>
                                            <td> {{ $cek['tanggal_masuk'] }} </td>
                                            <td> {{ $cek->guen['gen'] }} </td>
                                            <td> {{ $cek['nama'] }}</td>
                                            <td> {{ $cek['jk'] }} </td>
                                            <td>{{ $cek['jumlah'] }}</td>
                                            <td>{{ $cek['status'] }}</td>
                                        </tr>
                                    {{-- @endforeach --}}
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Tanggal Masuk</th>
                                        <th>gen</th>
                                        <th>nama</th>
                                        <th>gender</th>
                                        <th>stok</th>
                                        <th>status</th>
                                    </tr>
                                </tfoot>
                                @endif


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
        "responsive": true, "lengthChange": false, "autoWidth": false
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
@endsection
