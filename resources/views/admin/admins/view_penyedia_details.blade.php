@extends('admin.layouts.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">
                            Penyedia dan Personal details
                        </h3>
                        <h6 class="font-weight-normal mb-0">
                            <a href="{{ url('admin/admins') }}">
                                back
                            </a>
                        </h6>
                    </div>
                    <div class="col-12 col-xl-4 mb-0">
                        <div class="justify-content-end d-flex">
                            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button"
                                    id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="true">
                                    <i class="mdi mdi-calendar"></i>
                                    Today (10 Jan 2021)
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                    <a class="dropdown-item" href="#">January - March</a>
                                    <a class="dropdown-item" href="#">March - June</a>
                                    <a class="dropdown-item" href="#">June - August</a>
                                    <a class="dropdown-item" href="#">August - November</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Informasi Data Toko</h4>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="{{ $view_penyedia_details['jasadetail']['nama_toko'] }}" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat"
                                value="{{ $view_penyedia_details['jasadetail']['alamat_toko'] }}" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No Handphone</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp"
                                value="{{ $view_penyedia_details['jasadetail']['kode_pos_toko'] }}" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="kecamatan">Kecamatan</label>
                            <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                value="{{ $view_penyedia_details['jasadetail']['kecamatan_toko'] }}" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="kota">Kota</label>
                            <input type="text" class="form-control" id="kota" name="kota"
                                value="{{ $view_penyedia_details['jasadetail']['kota_toko'] }}" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="provinsi">Provinsi</label>
                            <input type="text" class="form-control" id="provinsi" name="provinsi"
                                value="{{ $view_penyedia_details['jasadetail']['provinsi_toko'] }}" readonly="">
                        </div>
                        @if (!empty(Auth::guard('admin')->user()->image))
                        <div class="form-group">
                            <label for="image">Image</label>
                            <br>
                            <center>
                                <img style="width: 200px;"
                                    src="{{ url('template/images/Photo/'.Auth::guard('admin')->user()->image) }}"
                                    alt="Photo">
                            </center>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Informasi Data Bank</h4>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="{{ $view_penyedia_details['bankdetail']['jenis_bank'] }}" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat"
                                value="{{ $view_penyedia_details['bankdetail']['nomor_bank'] }}" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No Handphone</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp"
                                value="{{ $view_penyedia_details['bankdetail']['nama_pemilik_bank'] }}" readonly="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Informasi Data Personal</h4>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email"
                                value="{{ $view_penyedia_details['penyedia']['email'] }}" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="{{ $view_penyedia_details['penyedia']['nama'] }}" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat"
                                value="{{ $view_penyedia_details['penyedia']['alamat'] }}" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No Handphone</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp"
                                value="{{ $view_penyedia_details['penyedia']['no_hp'] }}"
                                placeholder="Masukkan Nomor handpone anda" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="kecamatan">Kecamatan</label>
                            <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                value="{{ $view_penyedia_details['penyedia']['kecamatan'] }}" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="kota">Kota</label>
                            <input type="text" class="form-control" id="kota" name="kota"
                                value="{{ $view_penyedia_details['penyedia']['kota'] }}" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="provinsi">Provinsi</label>
                            <input type="text" class="form-control" id="provinsi" name="provinsi"
                                value="{{ $view_penyedia_details['penyedia']['provinsi'] }}" readonly="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    @include('admin\layouts\footer')
    <!-- partial -->
</div>
@endsection