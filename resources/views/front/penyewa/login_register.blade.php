@extends('front.layouts.layout')
@section('content')
<!-- Page Introduction Wrapper -->
<div class="page-style-a">
    <div class="container">
        <div class="page-intro">
            <h2>Account Penyewa</h2>
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
                    <h2 class="account-h2 u-s-m-b-20">Login</h2>
                    <h6 class="account-h6 u-s-m-b-30">Welcome back! Sign in to your account.</h6>
                    <p id="login-error"></p>
                    <form id="loginForm" action="javascript:;" method="POST">
                        @csrf
                        <div class="u-s-m-b-30">
                            <label for="email">Email
                                <span class="astk">*</span>
                            </label>
                            <input type="email" name="email" id="email" class="text-field" placeholder="Email">
                            <p id="login-email"></p>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="password">Password
                                <span class="astk">*</span>
                            </label>
                            <input type="password" name="password" id="password" class="text-field"
                                placeholder="Password">
                            <p id="login-password"></p>
                        </div>
                        <div class="group-inline u-s-m-b-30">
                            {{-- forgot password  --}}
                            <div class="group-2 text-right">
                                <div class="page-anchor">
                                    <a href="{{ url('lupa-password') }}">
                                        <i class="fas fa-circle-o-notch u-s-m-r-9"></i>Lost your password?</a>
                                </div>
                            </div>
                        </div>
                        <div class="m-b-45">
                            <button class="button button-outline-secondary w-100">Login</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Login /- -->
            <!-- Register -->
            <div class="col-lg-6">
                <div class="reg-wrapper">
                    <h2 class="account-h2 u-s-m-b-20">Register</h2>
                    <h6 class="account-h6 u-s-m-b-30">Registering for this site allows you to access your order status
                        and history.</h6>
                    <form id="registerForm" action="javascript:;" method="POST">
                        @csrf
                        <div class="u-s-m-b-30">
                            <label for="name">Nama
                                <span class="astk">*</span>
                            </label>
                            <input type="text" id="name" name="name" class="text-field"
                                placeholder="Masukkan Nama anda">
                            <p id="register-name"></p>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="no_hp">No. Handphone
                                <span class="astk">*</span>
                            </label>
                            <input type="text" id="no_hp" name="no_hp" class="text-field"
                                placeholder="Masukkan No HP anda">
                            <p id="register-no_hp"></p>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="email">Email
                                <span class="astk">*</span>
                            </label>
                            <input type="email" id="email" name="email" class="text-field" placeholder="Masukkan Email">
                            <p id="register-email"></p>
                        </div>
                        <div class="u-s-m-b-30">
                            <label for="password">Password
                                <span class="astk">*</span>
                            </label>
                            <input type="password" id="password" name="password" class="text-field"
                                placeholder="Password">
                            <p id="register-password"></p>
                        </div>
                        <div class="u-s-m-b-30">
                            <input type="checkbox" class="check-box" id="accept" name="accept">
                            <label class="label-text no-color" for="accept">I’ve read and accept the
                                <a href="terms-and-conditions.html" class="u-c-brand">terms & conditions</a>
                            </label>
                            <p id="register-accept"></p>
                        </div>
                        <div class="u-s-m-b-45">
                            <button class="button button-primary w-100">Register</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Register /- -->
        </div>
    </div>
</div>
<!-- Account-Page /- -->
@endsection