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
                    <form action="{{ url('penggajian/update', [$data->id_gaji]) }}" method="post">
                        @csrf
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Pegawai</label>
                                    <select class="form-control select2" name="idp" id="idp" style="width: 100%;" >
                                        @foreach ($user as $d)
                                            <option <?php if( $d['id'] == $data->id_pegawai) echo 'selected'; ?> value="{{ $d->id }}"> {{ $d->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="jb">Gaji Pokok</label>
                                <input type="number" name="gp" id="gp" class="form-control" min="0" value="{{ $data->gaji_pokok}}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="ta">Total Kehadiran</label>
                                <input type="number" name="ta" id="ta" class="form-control" value="{{ $data->kehadiran}}" readonly>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="status">tunjangan</label>
                                <input type="number" name="tj" id="tj" class="form-control" min="0" value="{{ $data->tj->nominal}}" readonly>
                            </div>
                            <div class="col-md-12 mb-3" >
                                <label for="ket">hutang</label>
                                <input type="number" name="ut" id="ut" class="form-control" min="0" value="{{ $data->hutang}}">
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
<script type='text/javascript'>

    $(document).ready(function(){

        var sts = $('#status').val();

            if (sts == 1) {

                $('#nkt').show();
                $('#nnt').show();
                $('#ngt').show();
                $('#njk').show();
                document.getElementById("kt").required = true;
                document.getElementById("nt").required = true;
                document.getElementById("gt").required = true;
                document.getElementById("jk").required = true;

            }else{

                $('#nkt').hide();
                $('#nnt').hide();
                $('#ngt').hide();
                $('#njk').hide();
                document.getElementById("kt").required = false;
                document.getElementById("nt").required = false;
                document.getElementById("gt").required = false;
                document.getElementById("jk").required = false;
            }

        $('#status').change(function(){
            var sts = $(this).val();

            if (sts == 1) {

                $('#nkt').show();
                $('#nnt').show();
                $('#ngt').show();
                $('#njk').show();
                document.getElementById("kt").required = true;
                document.getElementById("nt").required = true;
                document.getElementById("gt").required = true;
                document.getElementById("jk").required = true;

            }else{
                $('#nkt').hide();
                $('#nnt').hide();
                $('#ngt').hide();
                $('#njk').hide();
                document.getElementById("kt").required = false;
                document.getElementById("nt").required = false;
                document.getElementById("gt").required = false;
                document.getElementById("jk").required = false;
            }

        });

    });

</script>
@endsection
