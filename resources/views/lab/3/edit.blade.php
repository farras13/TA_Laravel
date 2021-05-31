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
                    <form action="{{ url('trans3/update', [$data->id_pt3]) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tanggal</label>
                                   <input type="date" class="form-control" name="tgl" id="tgl" value="{{ $data->tanggal_pengerjaan }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Persilangan</label>
                                    <input class="form-control" id="t3" name="persilangan"  value="{{ $data->id_persilangan }}" readonly>

                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="target">Target</label>
                                <input type="number" name="target" id="target" class="form-control" min="0" value="{{ $data->target }}">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="jb">Jumlah Botol </label>
                                <input type="number" name="jb" id="jb" class="form-control" min="0" value="{{ $data->botolT2 }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="stok">Stok</label>
                                <input type="number" name="stok" id="stok" class="form-control" min="0" value="{{ $data->stok }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="kontam">kontam</label>
                                <input type="number" name="kontam" id="kontam" class="form-control" min="0" value="{{ $data->kontam }}">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="status">status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>Berhasil</option>
                                    <option value="2" {{ $data->status == 2 ? 'selected' : '' }}>Gagal</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="ket">Keterangan</label>
                                <textarea class="form-control" name="ket" id="ket" cols="15" rows="10">{{ $data->keterangan }}</textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-right ml-3">Submit</button>
                        <a href="{{ route('trans2') }}" class="btn btn-danger float-right">Cancel</a>

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

        // $('#t3').change(function(){

        // Department id
        var id = $('#t3').val();

        // AJAX request
        $.ajax({
        url: '/trans3/getData/'+id,
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
                    // input2.setAttribute("max", jml);
                    // input3.setAttribute("max", jml);

                    input.setAttribute("min", jml);
                    input2.setAttribute("min", jml);
                    input3.setAttribute("min", jml);
                } else {
                    input.value = stok;
                    input.setAttribute("max", stok);
                    // input2.setAttribute("max", stok);
                    // input3.setAttribute("max", stok);

                    input.setAttribute("min", stok);
                    input2.setAttribute("min", stok);
                    input3.setAttribute("min", stok);
                }
            }
        }
        });
        // });

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
