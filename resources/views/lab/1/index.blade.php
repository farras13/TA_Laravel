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
            <h1>Trans1</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Trans1</li>
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
                        <h3 class="card-title">Data Trans 1</h3>
                        <div class="card-tools">
                            @if (Auth::user()->role == 2 || Auth::user()->role == 1)
                                <a href="{{ url('trans/tambah') }}" class="btn btn-tool"> <i class="fas fa-plus"></i> </a>
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
                                    <th>Id</th>
                                    <th>Kode</th>
                                    <th>Persilangan</th>
                                    <th>Jumlah Awal</th>
                                    <th>Kontam</th>
                                    <th>Berhasil</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th>Author</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $d)
                                <tr>
                                    <td> {{ $d->id_pt }} </td>
                                    <td> <?php $awal = substr("" . $d->idPersilangan, 0, 1); $teng = substr("" . $d->idPersilangan, 1, 2); $khir= substr("" . $d->idPersilangan, 3); ?>
                                          {{$awal.'-'.$teng.'-'.$khir }}
                                    </td>
                                    <td>{{ $d->persilangan->tanaman['name'].' x '.$d->persilangan->tanamann['name']}}</td>
                                    <td>{{ $d->jumlah_botol }} </td>
                                    <td>{{ $d->kontam }} </td>
                                    <td>{{ $d->qty }} </td>
                                    <td>    @if($d->status == 1)
                                                Berhasil
                                            @else
                                                Gagal
                                            @endif
                                    </td>
                                    <td>{{ $d->keterangan }}</td>
                                    <td>{{ $d->user['name'] }}</td>

                                    <td>
                                        @if (Auth::user()->role == 2 || Auth::user()->role == 1)
                                            <a class="nav-link" data-toggle="dropdown" href="#">
                                                <i class="fas fa-bars"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                                <div class="dropdown-divider"></div>
                                                <a href="{{ url('trans/edit', [$d->id_pt]) }}" class="dropdown-item">
                                                    <i class="fas fa-pen"></i> Edit
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a href="{{ url('trans/destroy', [$d->id_pt]) }}" class="dropdown-item">
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
                                    <th>Id</th>
                                    <th>Kode</th>
                                    <th>Persilangan</th>
                                    <th>Jumlah Awal</th>
                                    <th>Kontam</th>
                                    <th>Berhasil</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th>Author</th>
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
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": [
            {extend: 'colvis', postfixButtons: [ 'colvisRestore' ] },
            {extend: 'pdf', title:'Data Trans 1 PT Sari Bumi Mulya'},
            {extend: 'excel', title: 'Data Trans 1 PT Sari Bumi Mulya'},
            {extend:'print',title: 'Data Trans 1 PT Sari Bumi Mulya'},
        ]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
@endsection
