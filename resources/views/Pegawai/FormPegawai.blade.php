@extends('master')
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
                        <form action="{{ url('pegawai/add') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="col-sm-3"><div class="form-group"></div></div>

                                <h4>Data Pribadi</h4>
                                <div class="form-group">
                                    <label for="NamaLengkap">Nama Lengkap</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="NamaLengkap" placeholder="Nama" name="name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for=""><strong>Tanggal Lahir</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <input type="date" name="lahir" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="jk"><strong>Gender</strong></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                                        </div>
                                        <select class="form-control" name="jk" id="jk" required>
                                            <option value="Pria">Pria</option>
                                            <option value="Wanita">Wanita</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- phone -->
                                <div class="form-group">
                                    <label>No. Telp</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" ><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="text" class="form-control"
                                                data-inputmask="'mask': ['9999-9999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask id="hp" name="hp" required>
                                    </div>
                                </div>
                                {{-- alamat --}}
                                <div class="form-group">
                                    <label for="Alamat">Alamat</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-home"></i></span>
                                        </div>
                                        <textarea type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Jabatan</label>
                                    <select class="custom-select form-control-border" id="role" name="role" required>
                                        <option>---</option>
                                        <option value="0">Kebun</option>
                                        <option value="1">Lab</option>
                                        <option value="2">Admin</option>
                                        <option value="3">Owner</option>
                                    </select>
                                </div>
                                <!-- /.form group -->
                                <div class="form-group">
                                    <label>Foto</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile" name="foto" required>
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            {{-- <div class="card-body">
                                <h4>Data Pegawai</h4>
                                <div class="form-group">
                                    <label for=""><strong>Username</strong></label>
                                    <input type="text" name="username" class="form-control" placeholder="username" required>
                                </div>
                                <div class="form-group">
                                    <label for=""><strong>Password</strong></label>
                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <label>Status Kepegawaian</label>
                                    <select class="custom-select form-control-border" id="StatusPegawai" name="aktif" required>
                                        <option>---</option>
                                        <option value="0">Aktif</option>
                                        <option value="1">Tidak Aktif</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Jabatan</label>
                                    <select class="custom-select form-control-border" id="role" name="role" required>
                                        <option>---</option>
                                        <option value="0">Kebun</option>
                                        <option value="1">Lab</option>
                                        <option value="2">Admin</option>
                                        <option value="3">Owner</option>
                                    </select>
                                </div>
                            </div> --}}
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
<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- bs-custom-file-input -->
<script src="{{ asset('backend/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('backend/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('backend/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<script>
    $(function () {
        bsCustomFileInput.init();
        $('[data-mask]').inputmask()
    });
</script>
@endsection
