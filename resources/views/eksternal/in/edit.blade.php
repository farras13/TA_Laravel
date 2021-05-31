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
                    <h1>Proses Buah Form</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Proses Buah Form</li>
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
                    <h3 class="card-title">Proses Buah Form</h3>

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
                    <form action="{{ url('eksternal/in/update', [$data->id]) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="asal">Asal Barang</label>
                                <input type="text" name="asal" id="asal" class="form-control" value="{{ $data->asju }}">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="nama">Nama Anggrek</label>
                                <input type="text" name="nama" id="nama" class="form-control" value="{{ $data->nama }}">
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Gen</label>
                                    <select class="form-control select2" name="gen" style="width: 100%;">
                                        @foreach ($gen as $g)
                                            <option value="{{ $g->idGen }}" {{ $data->gen == $g->idGen ? 'selected' : '' }}>{{ $g->gen }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Gen</label>
                                    <select class="form-control select2" name="jk" style="width: 100%;">
                                        <option value="seed" {{ $data->jk == 'seed' ? 'selected' : '' }}>Seed</option>
                                        <option value="pollen" {{ $data->jk == 'pollen' ? 'selected' : '' }}>Pollen</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="jb">Jumlah</label>
                                <input type="number" name="jb" id="jb" class="form-control" min="0" value="{{ $data->jumlah }}">
                            </div>
                             <div class="col-md-12">
                                <div class="form-group">
                                    <label for="ket">Keterangan</label>
                                    <textarea class="form-control" name="ket" id="ket" cols="6" rows="6">{{ $data->keterangan }}</textarea>
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

        //Date range picker
        $('#reservationdate').datetimepicker({
            format: 'L'
        });
    });
</script>
@endsection
