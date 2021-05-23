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
                    <h1>Trans Form</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Trans Form</li>
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
                    <h3 class="card-title">Trans Form</h3>

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
                    <form action="{{ url('trans/update', [$data->id_pt]) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tanggal</label>
                                   <input type="date" class="form-control" name="tgl" id="tgl" value="{{ $data->tgl_pengerjaan }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Persilangan</label>
                                    <select class="form-control select2" name="persilangan" style="width: 100%;" disabled>
                                        <option value="{{ $data->idPersilangan }}"> {{ $data->idPersilangan .' | '. $data->persilangan->tanaman->name .' x '. $data->persilangan->tanamann->name }} </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="jb">Jumlah Botol</label>
                                <input type="number" name="jb" id="jb" class="form-control" min="0" value="{{ $data->jumlah_botol }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="ktm">Kontam</label>
                                <input type="number" name="ktm" id="ktm" class="form-control" min="0" value="{{ $data->kontam }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="qty">Berhasil</label>
                                <input type="number" name="qty" id="qty" class="form-control" min="0" value="{{ $data->qty }}">
                            </div>
                            <!-- /.col -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status" style="width: 100%;">
                                        <option value="1">Berhasil</option>
                                        <option value="2">Gagal</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-right ml-3">Submit</button>
                        <a href="{{ route('trans') }}" class="btn btn-danger float-right">Cancel</a>

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
<script type='text/javascript'>

    $(document).ready(function(){
        var jb = $('#jb').val();

        var input = document.getElementById("ktm");
        var input2 = document.getElementById("qty");

        input.setAttribute("max", jb);
        input2.setAttribute("max", jb);

      // Department Change
      $('#jb').change(function(){
        var jb = $(this).val();
        var input = document.getElementById("ktm");
        var input2 = document.getElementById("qty");

        input.setAttribute("max", jb);
        input2.setAttribute("max", jb);
      });
      $('#ktm').change(function(){

        // Department id
        var kontam = $(this).val();
        var jb = $('#jb').val();

        var qty = jb - kontam;
        var input2 = document.getElementById("qty");
        input2.setAttribute("max", qty);
        input2.setAttribute("min", qty);

      });
      $('#qty').change(function(){

        // Department id
        var sks = $(this).val();
        var jb = $('#jb').val();

        var qty = jb - sks;
        var ktm = document.getElementById("ktm");
        ktm.setAttribute("max", qty);
        ktm.setAttribute("min", qty);

      });

    });

</script>
@endsection
