@extends('front.layouts.layout')
@section('content')
<!-- Page Introduction Wrapper -->
<div class="page-style-a">
    <div class="container">
        <div class="page-intro">
            <h2>Account / Lupa password</h2>
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
                    <h2 class="account-h2 u-s-m-b-20">Lupa Password</h2>
                    <h6 class="account-h6 u-s-m-b-30">Input your email to update password.</h6>
                    <p id="forgot-error"></p>
                    <p id="forgot-success"></p>
                    <form id="forgotForm" action="javascript:;" method="POST">
                        @csrf
                        <div class="u-s-m-b-30">
                            <label for="email">Email
                                <span class="astk">*</span>
                            </label>
                            <input type="email" name="email" id="email" class="text-field" placeholder="Email">
                            <p id="forgot-email"></p>
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