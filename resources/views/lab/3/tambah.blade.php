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
                    <h1>Trans 2 Form</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Trans 2 Form</li>
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
                    <h3 class="card-title">Trans 2 Form</h3>

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
                    <form action="{{ url('trans2/add') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tanggal</label>
                                   <input type="date" class="form-control" name="tgl" id="tgl" value="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Persilangan</label>
                                    <select class="form-control select2" name="persilangan" id="t3" style="width: 100%;">
                                        <option value=""><!- Select Persilangan -!> </option>
                                        @foreach ($silang as $d)
                                            @if ($d->status_pk == 1 && $d->status_pb == 1 && $d->status_trans == 1 && $d->status_trans2 == 1 && $d->status_trans3 == 0 )
                                                <option value="{{ $d->kodePersilangan }}">{{  $d->kodePersilangan .' | '. $d->tanaman['name'] .' x '. $d->tanamann['name'] }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="target">Target</label>
                                <input type="number" name="target" id="target" class="form-control" min="0">
                            </div>
                            <div class="col-md-12 mb-3" id="test">
                                <label for="jb">Jumlah Botol </label>
                                <input type="number" name="jb" id="jb" class="form-control" min="0">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="stok">Stok</label>
                                <input type="number" name="stok" id="stok" class="form-control" min="0">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="kontam">kontam</label>
                                <input type="number" name="kontam" id="kontam" class="form-control" min="0">
                            </div>
                            <!-- /.col -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status" id="status" style="width: 100%;" required>
                                        <option value=""></option>
                                        <option value="1">Berhasil</option>
                                        <option value="2">Gagal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="ket">Keterangan</label>
                                <textarea class="form-control" name="ket" id="ket" cols="15" rows="10"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-right ml-3">Submit</button>
                        <a href="{{ route('trans3') }}" class="btn btn-danger float-right">Cancel</a>

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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

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
<script type='text/javascript'>

$(document).ready(function(){

        $('#t3').change(function(){

         // Department id
         var id = $(this).val();

         // AJAX request
         $.ajax({
           url: 'getData/'+id,
           type: 'get',
           dataType: 'json',
           success: function(response){

             var len = 0;
             if(response['data'] != null){
               len = response['data'].length;
             }

             if(len > 0){
               // Read data and create <option >
                 var stok = response['data'][0].jumlah_botol;
                 var qty = response['data'][0].qty;
                 var jml = stok - qty;
                 var input = document.getElementById("jb");
                 var input2 = document.getElementById("kontam");
                 var input3 = document.getElementById("stok");

                 if (qty > 0) {
                    input.value = jml;
                    input.setAttribute("max", jml);
                    input2.setAttribute("max", jml);
                    input3.setAttribute("max", jml);

                    input.setAttribute("min", jml);
                    input2.setAttribute("min", jml);
                    input3.setAttribute("min", jml);
                 } else {
                    input.value = stok;
                    input.setAttribute("max", stok);
                    input2.setAttribute("max", stok);
                    input3.setAttribute("max", stok);

                    input.setAttribute("min", stok);
                    input2.setAttribute("min", stok);
                    input3.setAttribute("min", stok);
                 }
             }
           }
        });
      });

    $('#kontam').change(function(){

        // Department id
        var kontam = $(this).val();
        var jb = $('#jb').val();
        if (jb > 0) {
            var qty = jb - kontam;
        }else{
            var qty = 0;
        }
        var input2 = document.getElementById("stok");
        input2.setAttribute("max", qty);
        input2.setAttribute("min", qty);

    });
    $('#stok').change(function(){

        // Department id
        var sks = $(this).val();
        var jb = $('#jb').val();

        var qty = jb - sks;
        var ktm = document.getElementById("kontam");
        ktm.setAttribute("max", qty);
        ktm.setAttribute("min", qty);

    });

    });

</script>
@endsection
