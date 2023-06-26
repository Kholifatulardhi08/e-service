@extends('admin.layouts.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">
                            Settings Penyedia
                        </h3>
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
        @if($slug=="penyedia")
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Update Informasi Penyedia</h4>
                        <form class="forms-sample" action="{{ url('admin/update_penyedia_details/penyedia') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if(Session::has('error_message'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Error: </strong> {{ Session::get('error_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            @if(Session::has('succses_message'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Succses: </strong> {{ Session::get('succses_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    value="{{ $penyediadetail['email'] }}" readonly="" required>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    value="{{ $penyediadetail['nama'] }}" placeholder="Masukkan Nama anda" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat"
                                    value="{{ $penyediadetail['alamat'] }}" placeholder="Masukkan alamat anda" required>
                            </div>
                            <div class="form-group">
                                <label for="no_hp">No Handphone</label>
                                <input type="text" class="form-control" id="no_hp" name="no_hp"
                                    value="{{ $penyediadetail['no_hp'] }}" placeholder="Masukkan Nomor handpone anda"
                                    required maxlength="13" minlength="10">
                            </div>
                            <div class="form-group">
                                <label for="kecamatan">Kecamatan</label>
                                <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                    value="{{ $penyediadetail['kecamatan'] }}" placeholder="Masukkan Kecamatan anda"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="kota">Kota</label>
                                <input type="text" class="form-control" id="kota" name="kota"
                                    value="{{ $penyediadetail['kota'] }}" placeholder="Masukkan Kota anda" required>
                            </div>
                            <div class="form-group">
                                <label for="provinsi">Provinsi</label>
                                {{--  <input type="text" class="form-control" id="provinsi" name="provinsi"
                                    value="{{ $penyediadetail['provinsi'] }}" placeholder="Masukkan Provinsi anda"
                                    required>  --}}
                                    <select class="form-control" name="provinsi" id="provinsi">
                                        <option value="">Pilih Provinsi</option>
                                        @foreach ($provinsi as $items)
                                            <option value="{{ $items['name'] }}" @if ($items['name']==$penyediadetail['provinsi'])
                                                selected
                                            @endif>
                                            {{ $items['name'] }}
                                            </option>                                        
                                        @endforeach
                                    </select>
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                                @if (!empty(Auth::guard('admin')->user()->image))
                                <a target="_blank"
                                    href="{{ url('template/images/Photo/'.Auth::guard('admin')->user()->image) }}">Preview</a>
                                <input type="hidden" name="current_hidden_image"
                                    value="{{ Auth::guard('admin')->user()->image }}">
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @elseif($slug=="jasadetail")
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Update Informasi Jasa Details</h4>
                        <form class="forms-sample" action="{{ url('admin/update_penyedia_details/jasadetail') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if(Session::has('error_message'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Error: </strong> {{ Session::get('error_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            @if(Session::has('succses_message'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Succses: </strong> {{ Session::get('succses_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="nama_toko">Nama</label>
                                <input type="text" class="form-control" id="nama_toko" name="nama_toko"
                                    value="{{ $penyediadetail['nama_toko'] }}" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat_toko">Alamat</label>
                                <input type="text" class="form-control" id="alamat_toko" name="alamat_toko"
                                    value="{{ $penyediadetail['alamat_toko'] }}" placeholder="Masukkan alamat toko anda"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="kecamatan_toko">Kecamatan</label>
                                <input type="text" class="form-control" id="kecamatan_toko" name="kecamatan_toko"
                                    value="{{ $penyediadetail['kecamatan_toko'] }}"
                                    placeholder="Masukkan kecamatan anda" required>
                            </div>
                            <div class="form-group">
                                <label for="kota_toko">Kota</label>
                                <input type="text" class="form-control" id="kota_toko" name="kota_toko"
                                    value="{{ $penyediadetail['kota_toko'] }}" placeholder="Masukkan kota anda"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="provinsi_toko">Provinsi</label>
                                <select class="form-control" name="provinsi_toko" id="provinsi_toko">
                                    <option value="">Pilih Provinsi</option>
                                    @foreach ($provinsi as $items)
                                        <option value="{{ $items['name'] }}" @if ($items['name']==$penyediadetail['provinsi_toko'])
                                            selected
                                        @endif>
                                        {{ $items['name'] }}
                                        </option>                                        
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kode_pos_toko">Kode Pos</label>
                                <input type="text" class="form-control" id="kode_pos_toko" name="kode_pos_toko"
                                    value="{{ $penyediadetail['kode_pos_toko'] }}" placeholder="Masukkan Provinsi anda"
                                    required>
                            </div>
                            {{-- <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                                @if (!empty(Auth::guard('admin')->user()->image))
                                <a target="_blank"
                                    href="{{ url('template/images/Photo/'.Auth::guard('admin')->user()->image) }}">Preview</a>
                                <input type="hidden" name="current_hidden_image"
                                    value="{{ Auth::guard('admin')->user()->image }}">
                                @endif
                            </div> --}}
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @elseif($slug=="bank")
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Update Informasi Bank Details</h4>
                        <form class="forms-sample" action="{{ url('admin/update_penyedia_details/bank') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if(Session::has('error_message'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Error: </strong> {{ Session::get('error_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            @if(Session::has('succses_message'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Succses: </strong> {{ Session::get('succses_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="jenis_bank">Jenis Bank</label>
                                <select class="form-control" name="jenis_bank" id="jenis_bank">
                                    <option value="BCA" @if($penyediadetail['jenis_bank']=="BCA" ) selected @endif>BCA
                                    </option>
                                    <option value="Mandiri" @if($penyediadetail['jenis_bank']=="Mandiri" ) selected @endif>Mandiri</option>
                                    <option value="BNI" @if($penyediadetail['jenis_bank']=="BNI" ) selected @endif>BNI
                                    </option>
                                    <option value="BRI" @if($penyediadetail['jenis_bank']=="BRI" ) selected @endif>BRI
                                    </option>
                                    <option value="BSI" @if($penyediadetail['jenis_bank']=="BSI" ) selected @endif>BSI
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nomor_bank">No Rekening</label>
                                <input type="text" class="form-control" id="nomor_bank" name="nomor_bank"
                                    value="{{ $penyediadetail['nomor_bank'] }}" placeholder="Masukkan no bank anda"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="nama_pemilik_bank">Nama Pemilik Bank</label>
                                <input type="text" class="form-control" id="nama_pemilik_bank" name="nama_pemilik_bank"
                                    value="{{ $penyediadetail['nama_pemilik_bank'] }}"
                                    placeholder="Masukkan Nama sesuai Nama bank anda" required>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    @include('admin\layouts\footer')
    <!-- partial -->
</div>
@endsection