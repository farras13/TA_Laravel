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
                    <form action="{{ url('eksternal/out/add') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tgl">Tanggal</label>
                                <input type="date" name="tgl" id="tgl" class="form-control" value="<?= date('Y-m-d') ?>">
                                {{-- <input type="time" name="tgl" id="tgl" class="form-control"> --}}

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Time picker:</label>
                                    <input type="time" name="tm" id="tm" class="form-control datetimepicker-input" value="<?= date('H:i') ?>">
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="asal">Tujuan Barang</label>
                                <input type="text" name="asal" id="asal" class="form-control" required>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tanaman</label>
                                    <select class="form-control select2" name="idt" id="idt" style="width: 100%;">
                                        @foreach ($data as $d)
                                            <option value="{{ $d->idTanaman }}">{{ $d->name }}</option>
                                         @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-12 form-group" id="test">
                                <div class="col-md-12 mb-3">
                                    <label for="idt">Kode Tanaman</label>
                                    <input type="text" name="idta" id="idta" class="form-control" readonly>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="nama">Name Tanaman</label>
                                    <input type="text" name="nama" id="nama" class="form-control" readonly>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="gen">Gen</label>
                                    <input type="text" name="gen" id="gen" class="form-control" readonly>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="jk">JK</label>
                                    <input type="text" name="jk" id="jk" class="form-control" readonly>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="jb">Jumlah</label>
                                    <input type="number" name="jb" id="jb" class="form-control" min="0">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="ket">Keterangan</label>
                                    <textarea class="form-control" name="ket" id="ket" cols="15" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-right ml-3">Submit</button>
                        <a href="{{ route('eksout') }}" class="btn btn-danger float-right">Cancel</a>
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
<!-- Bootstrap 4 -->
<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
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
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
<script type='text/javascript'>

    $(document).ready(function(){
        $('#test').hide();
      // Department Change
      $('#idt').change(function(){

         // Department id
         var id = $(this).val();

         // Empty the dropdown
         $('#test').show();

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
               for(var i=0; i<len; i++){

                 var ida = response['data'][i].idTanaman;
                 var name = response['data'][i].name;
                 var stok = response['data'][i].stok;
                 var jk = response['data'][i].jk;
                 var gen = response['data'][i].idGen;
                 var input = document.getElementById("jb");
                 document.getElementById("idta").value = ida;
                 document.getElementById("nama").value = name;
                 document.getElementById("gen").value = gen;
                 document.getElementById("jk").value = jk;
                 input.value = stok;
                 input.setAttribute("max", stok);

                //  $("#sel_emp").append(option);
               }
             }

           }
        });
      });

    });

</script>
@endsection
