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
                            <div class="col-md-6 mb-3">
                                <label for="">Kode Tanaman</label>
                                <input type="text" class="form-control" name="kode" value="{{ $data->idTanaman }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control" value="{{ $data->name }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="gen">Gen</label>
                                <select name="gen" id="gen" class="form-control">
                                    @foreach ($gen as $g)
                                    <option value="{{ $g->idGen }}" {{ $data->idGen == $g->idGen ? 'selected' : '' }}>{{ $g->gen }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="jk">Gender</label>
                                <select class="form-control" name="jk" id="jk">
                                    <option value="seed" {{ $data->jk == "seed" ? 'selected' : '' }}>Seed</option>
                                    <option value="pollen" {{ $data->jk == "pollen" ? 'selected' : '' }}>Pollen</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="stok">Stok</label>
                                <input type="number" name="stok" id="stok" class="form-control" value="{{ $data->stok }}">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="internal" {{ $data->status == 'internal' ? 'selected' : '' }}>Internal</option>
                                    <option value="eksternal" {{ $data->status == 'eksternal' ? 'selected' : '' }}>Eksternal</option>
                                </select>
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
