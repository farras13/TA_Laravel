@extends('master')
@section('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
@endsection
@section('konten')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Keluar Inventory Form</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Keluar Inventory Form</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Data Keluar Inventory Form</h3>

                    <div class="card-tools">
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
                    <form action="{{ url('eksternal/out/update', [$data->id]) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="asal">Tujuan Barang</label>
                                <input type="text" name="asal" id="asal" class="form-control"  value="{{ $data->asju }}">
                            </div>
                            <!-- /.col -->
                            <div class="col-md-12 form-group" id="test">
                                <div class="col-md-12 mb-3">
                                    <label for="nama">Name Tanaman</label>
                                    <input type="text" name="nama" id="nama" class="form-control" value="{{ $data->nama }}" readonly>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="gen">Gen</label>
                                    <input type="text" name="gen" id="gen" class="form-control" value="{{ $data->gen }}" readonly>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="jk">Gender</label>
                                    <input type="text" name="jk" id="jk" class="form-control" value="{{ $data->jk }}" readonly>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="jb">Jumlah</label>
                                    <input type="number" name="jb" id="jb" class="form-control" value="{{ $data->jumlah }}" min="0">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="ket">Keterangan</label>
                                    <textarea class="form-control" name="ket" id="ket" cols="15" rows="10">{{ $data->keterangan }}</textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-right ml-3">Submit</button>
                        <a href="{{ route('eksin') }}" class="btn btn-danger float-right">Cancel</a>
                    </form>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer"> </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
@section('js')
<script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    });
</script>
@endsection
