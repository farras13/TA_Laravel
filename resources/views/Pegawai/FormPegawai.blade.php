@extends('master')
@section('css')

<link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection
@section('konten')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Form Pegawai</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pegawai</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Data Pegawai</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">
                  <div class="col-sm-3">
                    <div class="form-group">
                    </div>
                  </div>
                  <div class="form-group">
                    <label>ID Pegawai</label>
                    <input type="text" class="form-control" id="IdPegawai" placeholder="" disabled>
                  </div>
                  <h4>Data Pribadi</h4>
                  <div class="form-group">
                    <label for="NamaLengkap">Nama Lengkap</label>
                    <input type="text" class="form-control" id="NamaLengkap" placeholder="Nama">
                  </div>
                  <div class="form-group">
                    <label for="Alamat">Alamat</label>
                    <input type="text" class="form-control" id="Alamat" placeholder="Alamat">
                  </div>
                  <!-- phone -->
                <div class="form-group">
                  <label>No. Telp</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="text" class="form-control"
                           data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
                  <div class="form-group">
                    <label>Foto</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-body">
                    <h4>Latar Belakang</h4>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-border" id="Agama" placeholder="Agama">
                    </div>
                    <div class="form-group">
                      <label>Pendidikan Terakhir</label>
                      <select class="custom-select form-control-border" id="Pendidikan">
                        <option>---</option>
                        <option>SD</option>
                        <option>SMP</option>
                        <option>SMA / SMK Sederajat</option>
                        <option>Diploma</option>
                        <option>Sarjana</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-border" id="Instansi" placeholder="Instansi Pendidikan Terakhir">
                    </div>
                    <div class="form-group">
                      <label>Satus Pernikahan</label>
                      <select class="custom-select form-control-border" id="Pendidikan">
                        <option>---</option>
                        <option>Menikah</option>
                        <option>Belum Menikah</option>
                      </select>
                    </div>
                    <h4></h4>
                    <div class="form-group">
                      <label>Status Kepegawaian</label>
                      <select class="custom-select form-control-border" id="StatusPegawai">
                        <option>---</option>
                        <option>Aktif</option>
                        <option>Tidak Aktif</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Jabatan</label>
                      <select class="custom-select form-control-border" id="StatusPegawai">
                        <option>---</option>
                        <option>Kebun</option>
                        <option>Lab</option>
                        <option>Admin</option>
                        <option>Owner</option>
                      </select>
                    </div>
                  </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

          </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
@section('js')
<!-- DataTables  & Plugins -->
<script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('backend/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('backend/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
@endsection
