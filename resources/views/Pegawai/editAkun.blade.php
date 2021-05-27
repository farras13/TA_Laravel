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
                        <form action="{{  url('akun/update', [$data->id]) }}" method="post">
                            @csrf
                            <div class="card-body">
                                <h4>Data Pegawai</h4>
                                <div class="form-group">
                                    <label for=""><strong>Username</strong></label>
                                    <input type="text" name="username" class="form-control" value="{{ $data->username }}" required>
                                </div>
                                <div class="form-group">
                                    <label for=""><strong>Password</strong></label>
                                    <input type="password" name="password" class="form-control" value="{{ $data->password }}" required>
                                </div>
                                {{-- <div class="form-group">
                                    <label>Status Kepegawaian</label>
                                    <select class="custom-select form-control-border" id="StatusPegawai" name="aktif" required>
                                        <option>---</option>
                                        <option value="0" {{ $data->role == 0 ? 'selected' : '' }}>Aktif</option>
                                        <option value="1" {{ $data->role == 1 ? 'selected' : '' }}>Tidak Aktif</option>
                                    </select>
                                </div> --}}
                                <div class="form-group">
                                    <label>Jabatan</label>
                                    <select class="custom-select form-control-border" id="role" name="role" required>
                                        <option>---</option>
                                        <option value="0" {{ $data->role == 0 ? 'selected' : '' }}>Kebun</option>
                                        <option value="1" {{ $data->role == 1 ? 'selected' : '' }}>Lab</option>
                                        <option value="2" {{ $data->role == 2 ? 'selected' : '' }}>Admin</option>
                                        <option value="3" {{ $data->role == 3 ? 'selected' : '' }}>Owner</option>
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
