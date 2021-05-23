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
                    <form action="{{ url('trans2/update', [$data->id_pt2]) }}" method="post">
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
                            <div class="col-md-12 mb-3">
                                <label for="jb">Jumlah botol berhasil</label>
                                <input type="number" name="jb" id="jb" class="form-control" min="0" value="{{ $data->jumlah_botol }}">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="status">status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>Berhasil</option>
                                    <option value="2" {{ $data->status == 2 ? 'selected' : '' }}>Gagal</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3" >
                                <label for="ket">Keterangan</label>
                                <textarea class="form-control" name="ket" id="ket" cols="15" rows="10">{{ $data->keterangan }}</textarea>
                            </div>
                            <br><br>
                            <div class="col-md-6 mb-3" id="nkt">
                                <label for="kt">kode tanaman</label>
                                <input type="text" name="kt" id="kt" class="form-control" value="{{ $data->persilangan->calon_kode }}">
                            </div>
                            <div class="col-md-6 mb-3" id="nnt">
                                <label for="nt">nama tanaman</label>
                                <input type="text" name="nt" id="nt" class="form-control" value="{{ $data->persilangan->calon_nama }}">
                            </div>
                            <div class="col-md-6 mb-3" id="ngt">
                                <label for="gt">gen tanaman</label>
                                <select name="gt" id="gt" class="form-control">
                                    @foreach ($gen as $g)
                                        <option value="{{ $g->idGen }}" {{ $data->persilangan->calon_gen == $g->idGen ? 'selected' : '' }}>{{ $g->gen }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3" id="njk">
                                <label for="jk">seed / pollen</label>
                                <select name="jk" id="jk" class="form-control">
                                    <option value="seed" {{ $data->persilangan->calon_jk == "seed" ? 'selected' : '' }}>Seed</option>
                                    <option value="pollen" {{ $data->persilangan->calon_jk == "pollen" ? 'selected' : '' }}>pollen</option>
                                </select>
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
