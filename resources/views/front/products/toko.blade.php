@extends('front.layouts.layout')
@section('content')
<?php
use App\Models\Product;
?>
<!-- Page Introduction Wrapper -->
<div class="page-style-a">
    <div class="container">
        <div class="page-intro">
            <h2>{{ $jasadetails }}</h2>
            <ul class="bread-crumb">
                <li class="has-separator">
                    <i class="ion ion-md-home"></i>
                    <a href="/">Home</a>
                </li>
                <li class="is-marked">
                    <a href="#">{{ $jasadetails }}</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Page Introduction Wrapper /- -->
<!-- Shop-Page -->
<div class="page-shop u-s-p-t-80">
    <div class="container">
        <!-- Shop-Intro -->
        <div class="shop-intro">
            <ul class="bread-crumb">
                <li class="has-separator">
                    <a href="/">Home</a>
                </li>
                
                <li class="has-separator">
                    {{ $jasadetails }}
                </li>
            </ul>
        </div>
        <!-- Shop-Intro /- -->
        <div class="row">
            <!-- Shop-Right-Wrapper -->
            <div class="col-lg-12 col-md-12 col-sm-12">
                <!-- Page-Bar -->
                <div class="page-bar clearfix">
                    <div class="shop-settings">
                        <a id="list-anchor">
                            <i class="fas fa-th-list"></i>
                        </a>
                        <a id="grid-anchor" class="active">
                            <i class="fas fa-th"></i>
                        </a>
                    </div>
                </div>
                <!-- Page-Bar /- -->
                <div class="">
                    @include('front.products.toko_listening')
                </div>
                @if(isset($_GET['sort']))
                    <div>{{ $penyediaproduct->appends($_GET['sort'])->links() }}</div>
                @else
                <div>{{ $penyediaproduct->links() }}</div>
                @endif
            </div>
            <!-- Shop-Right-Wrapper /- -->
        </div>
    </div>
</div>
<!-- Shop-Page /- -->
@endsection