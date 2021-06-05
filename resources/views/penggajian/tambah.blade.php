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
                    <h1>Penggajian</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Form Penggajian</li>
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
                    <h3 class="card-title">Form Penggajian</h3>

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
                    <form action="{{ url('penggajian/add') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Pegawai</label>
                                    <select class="form-control select2" name="idp" id="pgw" style="width: 100%;">
                                        @foreach ($data as $d)
                                            <option value="{{ $d->id_pegawai }}"> {{ $d->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="gp">Gaji Pokok</label>
                                <input type="number" name="gp" id="gp" class="form-control" readonly required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="ta">Total Kehadiran</label>
                                <input type="number" name="ta" id="ta" class="form-control" readonly required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="status">Tunjangan</label>
                                <select class="form-control select2" name="tj" id="tj" style="width: 100%;">
                                    <option value=""></option>
                                    @foreach ($tunjangan as $d)
                                        <option value="{{ $d->idTunjangan }}"> {{ $d->tunjangan .' | '. $d->nominal}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="ta">Total Hutang</label>
                                <input type="number" name="ut" id="ut" class="form-control" min="0">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-right ml-3">Submit</button>
                        <a href="{{ route('penggajian') }}" class="btn btn-danger float-right">Cancel</a>

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
<script>
        $('#pgw').change(function(){
           // Department id
           var id = $(this).val();

           // AJAX request
           $.ajax({
           url: 'getData/'+ id,
           type: 'get',
           dataType: 'json',
               success: function(response){
                var len = 0;
                    if(response['data'] != null){
                        len = response['data'].length;
                    }
                    if(len > 0){
                    // Read data and create <option >
                        for(var i=0; i<len; i++){
                            var stok = response['data'][i].gaji_pokok;
                            var input = document.getElementById("gp");
                            input.value = stok;
                            // input.setAttribute("min", stok);
                        }
                    }
               }
           });
           $.ajax({
           url: 'getDataT/'+ id,
           type: 'get',
           dataType: 'json',
               success: function(response){
                var len = 0;
                    if(response['data'] != null){
                        len = response['data'].length;
                    }
                    if(len > 0){
                    // Read data and create <option >
                        for(var i=0; i<len; i++){
                            var stok = len;
                            var input = document.getElementById("ta");
                            input.value = stok;
                            // input.setAttribute("min", stok);
                        }
                    }
               }
           });
       });
</script>
@endsection
