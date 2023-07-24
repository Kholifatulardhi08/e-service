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
                            <label for="nama_toko">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                @if(isset($penyediadetail['nama_toko']))
                                value="{{ $view_penyedia_details['jasadetail']['nama_toko'] }}" @endif readonly="">
                        </div>
                        <div class="form-group">
                            <label for="alamat_toko">Alamat</label>
                            <input type="text" class="form-control" id="alamat_toko" name="alamat_toko"
                                @if(isset($penyediadetail['alamat_toko']))
                                value="{{ $view_penyedia_details['jasadetail']['alamat_toko'] }}" @endif readonly="">
                        </div>
                        <div class="form-group">
                            <label for="kode_pos_toko">No Handphone</label>
                            <input type="text" class="form-control" id="kode_pos_toko" name="kode_pos_toko"
                                @if(isset($penyediadetail['kode_pos_toko']))
                                value="{{ $view_penyedia_details['jasadetail']['kode_pos_toko'] }}" @endif readonly="">
                        </div>
                        <div class="form-group">
                            <label for="kecamatan_toko">Kecamatan</label>
                            <input type="text" class="form-control" id="kecamatan_toko" name="kecamatan_toko"
                                @if(isset($penyediadetail['kecamatan_toko']))
                                value="{{ $view_penyedia_details['jasadetail']['kecamatan_toko'] }}" @endif readonly="">
                        </div>
                        <div class="form-group">
                            <label for="kota_toko">Kota</label>
                            <input type="text" class="form-control" id="kota_toko" name="kota_toko"
                                @if(isset($penyediadetail['kota_toko']))
                                value="{{ $view_penyedia_details['jasadetail']['kota_toko'] }}" @endif readonly="">
                        </div>
                        <div class="form-group">
                            <label for="provinsi_toko">Provinsi</label>
                            <input type="text" class="form-control" id="provinsi_toko" name="provinsi_toko"
                                @if(isset($penyediadetail['kota_toko']))
                                value="{{ $view_penyedia_details['jasadetail']['provinsi_toko'] }}" @endif readonly="">
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
                            <label for="jenis_bank">Jenis Bank</label>
                            <input type="text" class="form-control" id="jenis_bank" name="jenis_bank"
                                @if(isset($penyediadetail['jenis_bank']))
                                value="{{ $view_penyedia_details['bankdetail']['jenis_bank'] }}" @endif readonly="">
                        </div>
                        <div class="form-group">
                            <label for="nomor_bank">Alamat</label>
                            <input type="text" class="form-control" id="nomor_bank" name="nomor_bank"
                                @if(isset($penyediadetail['nomor_bank']))
                                value="{{ $view_penyedia_details['bankdetail']['nomor_bank'] }}" @endif readonly="">
                        </div>
                        <div class="form-group">
                            <label for="nama_pemilik_bank">Nama Pemilik Bank</label>
                            <input type="text" class="form-control" id="nama_pemilik_bank" name="nama_pemilik_bank"
                                @if(isset($penyediadetail['nama_pemilik_bank']))
                                value="{{ $view_penyedia_details['bankdetail']['nama_pemilik_bank'] }}" @endif
                                readonly="">
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
                                @if(isset($penyediadetail['email']))
                                value="{{ $view_penyedia_details['penyedia']['email'] }}" @endif readonly="">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                @if(isset($penyediadetail['nama']))
                                value="{{ $view_penyedia_details['penyedia']['nama'] }}" @endif readonly="">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat"
                                @if(isset($penyediadetail['alamat']))
                                value="{{ $view_penyedia_details['penyedia']['alamat'] }}" @endif readonly="">
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No Handphone</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp"
                                @if(isset($penyediadetail['no_hp']))
                                value="{{ $view_penyedia_details['penyedia']['no_hp'] }}" @endif readonly="">
                        </div>
                        <div class="form-group">
                            <label for="kecamatan">Kecamatan</label>
                            <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                @if(isset($penyediadetail['no_hp']))
                                value="{{ $view_penyedia_details['penyedia']['kecamatan'] }}" @endif readonly="">
                        </div>
                        <div class="form-group">
                            <label for="kota">Kota</label>
                            <input type="text" class="form-control" id="kota" name="kota"
                                @if(isset($penyediadetail['no_hp']))
                                value="{{ $view_penyedia_details['penyedia']['kota'] }}" @endif readonly="">
                        </div>
                        <div class="form-group">
                            <label for="provinsi">Provinsi</label>
                            <input type="text" class="form-control" id="provinsi" name="provinsi"
                                @if(isset($penyediadetail['no_hp']))
                                value="{{ $view_penyedia_details['penyedia']['provinsi'] }}" @endif readonly="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    @include('admin\layouts\footer')
    <!-- partial -->
</div>
@endsection