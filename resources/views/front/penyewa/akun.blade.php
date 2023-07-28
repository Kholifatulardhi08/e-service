@extends('front.layouts.layout')
@section('content')
<!-- Page Introduction Wrapper -->
<div class="page-style-a">
    <div class="container">
        <div class="page-intro">
            <h2>Account Setting</h2>
            <ul class="bread-crumb">
                <li class="has-separator">
                    <i class="ion ion-md-home"></i>
                    <a href="{{ ('/') }}">Home</a>
                </li>
                <li class="is-marked">
                    <a href="javascript:;">Account</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Page Introduction Wrapper /- -->
<!-- Account-Page -->
<div class="page-account u-s-p-t-80">
    <div class="container">
        @if(Session::has('error_message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Error: </strong> {{ Session::get('error_message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if(Session::has('success_message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
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
        <div class="row">
            <!-- Login -->
            <div class="col-lg-6">
                <div class="login-wrapper">
                    <h2 class="account-h2 u-s-m-b-20">Account Setting</h2>
                    <h6 class="account-h6 u-s-m-b-30"></h6>
                    <p id="account-error"></p>
                    <p id="account-success"></p>
                    <form id="accountForm" action="javascript:;" method="POST">
                        @csrf
                        <div class="u-s-m-b-30">
                            <label for="email">Email
                                <span class="astk">*</span>
                            </label>
                            <input value="{{ Auth::user()->email }}" type="email" name="email" id="email"
                                class="text-field" readonly="" placeholder="Email">
                            <p id="account-email"></p>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="name">Name
                                <span class="astk">*</span>
                            </label>
                            <input value="{{ Auth::user()->name }}" type="name" name="name" id="name" class="text-field"
                                placeholder="name">
                            <p id="account-name"></p>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="alamat">Alamat
                                <span class="astk">*</span>
                            </label>
                            <input value="{{ Auth::user()->alamat }}" type="alamat" name="alamat" id="alamat"
                                class="text-field" placeholder="alamat">
                            <p id="account-alamat"></p>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="kecamatan">Kecamatan
                                <span class="astk">*</span>
                            </label>
                            <input value="{{ Auth::user()->kecamatan }}" type="kecamatan" name="kecamatan"
                                id="kecamatan" class="text-field" placeholder="kecamatan">
                            <p id="account-kecamatan"></p>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="kota">Kota
                                <span class="astk">*</span>
                            </label>
                            <input value="{{ Auth::user()->kota }}" type="kota" name="kota" id="kota" class="text-field"
                                placeholder="kota">
                            <p id="account-kota"></p>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="provinsi">Provinsi
                                <span class="astk">*</span>
                            </label>
                            <select class="form-control" name="provinsi" id="provinsi">
                                <option value="">Pilih Provinsi</option>
                                @foreach ($provinsi as $items)
                                <option value="{{ $items['name'] }}">
                                    {{ $items['name'] }}
                                </option>
                                @endforeach
                            </select>
                            <p id="account-provinsi"></p>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="kode_pos">Kode Pos
                                <span class="astk">*</span>
                            </label>
                            <input value="{{ Auth::user()->kode_pos }}" type="kode_pos" name="kode_pos" id="kode_pos"
                                class="text-field" placeholder="Kode Pos">
                            <p id="account-kode_pos"></p>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="no_hp">No Handphone
                                <span class="astk">*</span>
                            </label>
                            <input value="{{ Auth::user()->no_hp }}" type="no_hp" name="no_hp" id="no_hp"
                                class="text-field" readonly="" placeholder="no_hp">
                            <p id="account-no_hp"></p>
                        </div>
                        <div class="m-b-45">
                            <button type="submit" class="button button-outline-secondary w-100">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Login /- -->
            <!-- Register -->
        </div>
    </div>
</div>
<!-- Account-Page /- -->
@endsection