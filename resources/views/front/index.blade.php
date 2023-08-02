<?php
use App\Models\Product;
?>
@extends('front.layouts.layout')
@section('content')
<!-- Main-Slider -->
<div class="default-height ph-item">
    <div class="slider-main owl-carousel">
        @foreach ($banners as $banner)
        <div class="bg-image">
            <div class="slide-content">
                <h1><a @if(!empty($banner['link'])) href="{{ url($banner['link']) }}" @else href="javascript:;"
                        @endif></a><img title="{{ $banner['title'] }}" alt="{{ $banner['title'] }}"
                        src="{{ asset('front/images/main-slider/'.$banner['gambar']) }}"></h1>
                <h2>{{ $banner['title'] }}</h2>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- Main-Slider /- -->
@if (isset($fixbanners[0]['gambar']))
<!-- Banner-Layer -->
<div class="banner-layer">
    <div class="container">
        <div class="image-banner">
            <a target="_blank" rel="nofollow" href="{{ url($fixbanners[0]['link']) }}"
                class="mx-auto banner-hover effect-dark-opacity">
                <img class="img-fluid" src="{{ asset('front/images/main-slider/'.$fixbanners[0]['gambar']) }}"
                    alt="{{ url($fixbanners[0]['alt']) }}" title="{{ url($fixbanners[0]['title']) }}">
            </a>
        </div>
    </div>
</div>
<!-- Banner-Layer /--->
@endif
<!-- Top Collection -->
<section class="section-maker">
    <div class="container">
        <div class="text-center sec-maker-header">
            <h3 class="sec-maker-h3">Product jasa</h3>
            <ul class="nav tab-nav-style-1-a justify-content-center">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#men-latest-products">All
                        Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#men-best-selling-products">Best
                        Sellers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#discounted-products">Discounted
                        Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#men-featured-products">Featured
                        Products</a>
                </li>
            </ul>
        </div>
        <div class="wrapper-content">
            <div class="outer-area-tab">
                <div class="tab-content">
                    <div class="tab-pane active show fade" id="men-latest-products">
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="5">
                                @foreach ($product as $products)
                                <?php
                                    $products_imgPath = 'template/images/Photo/Product/Small/'.$products['gambar']
                                ?>
                                <div class="item">
                                    <div class="image-container">
                                        <a class="item-img-wrapper-link" href="{{ url('product/'.$products['id']) }}">
                                            @if(!empty($products['gambar']) && file_exists($products_imgPath) )
                                            <img class="img-fluid" src="{{ asset($products_imgPath) }}" alt="Product">
                                            @else
                                            <img class="img-fluid" <img style="width: 120px; height: 120px;"
                                                src="{{ asset('template/images/Photo/Product/Small/no_image.jpg') }}"
                                                alt="No Image">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="item-content">
                                        <div class="what-product-is">
                                            <ul class="bread-crumb">
                                                <li>
                                                    <a href="{{ url('products/'.$products['id']) }}">{{
                                                        $products['nama'] }}</a>
                                                </li>
                                            </ul>
                                            <h6 class="item-title">
                                                <a href="{{ url('products/'.$products['id']) }}">{{ $products['nama']
                                                    }}</a>
                                            </h6>
                                            <div class="item-stars">
                                                <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                    <span style='width:0'></span>
                                                </div>
                                                <span>(0)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane show fade" id="men-best-selling-products">
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="5">
                                @foreach ($bestseller as $products)
                                <?php
                                    $products_imgPath = 'template/images/Photo/Product/Small/'.$products['gambar']
                                ?>
                                <div class="item">
                                    <div class="image-container">
                                        <a class="item-img-wrapper-link" href="{{ url('products/'.$products['id']) }}">
                                            @if(!empty($products['gambar']) && file_exists($products_imgPath) )
                                            <img class="img-fluid" src="{{ asset($products_imgPath) }}" alt="Product">
                                            @else
                                            <img class="img-fluid" <img style="width: 120px; height: 120px;"
                                                src="{{ asset('template/images/Photo/Product/Small/no_image.jpg') }}"
                                                alt="No Image">
                                            @endif
                                        </a>

                                    </div>
                                    <div class="item-content">
                                        <div class="what-product-is">
                                            <ul class="bread-crumb">
                                                <li>
                                                    <a href="{{ url('products/'.$products['id']) }}">{{
                                                        $products['nama'] }}</a>
                                                </li>
                                            </ul>
                                            <h6 class="item-title">
                                                <a href="{{ url('products/'.$products['id']) }}">{{ $products['nama']
                                                    }}</a>
                                            </h6>
                                            <div class="item-stars">
                                                <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                    <span style='width:0'></span>
                                                </div>
                                                <span>(0)</span>
                                            </div>
                                        </div>
                                        <?php 
                                         $getdiskon = Product::getdiskonharga($products['id'])
                                        ?>
                                        @if($getdiskon>0)
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                {{ $getdiskon }}
                                            </div>
                                            <div class="item-old-price">
                                                {{ $products['harga'] }}
                                            </div>
                                        </div>
                                        @endif

                                    </div>
                                    {{-- <div class="tag new">
                                        <span>{{ $products['meta_title'] }}</span>
                                    </div> --}}
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade" id="discounted-products">
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="5">
                                @foreach ($diskonproduct as $products)
                                <?php
                                    $products_imgPath = 'template/images/Photo/Product/Small/'.$products['gambar']
                                ?>
                                <div class="item">
                                    <div class="image-container">
                                        <a class="item-img-wrapper-link" href="{{ url('products/'.$products['id']) }}">
                                            @if(!empty($products['gambar']) && file_exists($products_imgPath) )
                                            <img class="img-fluid" src="{{ asset($products_imgPath) }}" alt="Product">
                                            @else
                                            <img class="img-fluid" <img style="width: 120px; height: 120px;"
                                                src="{{ asset('template/images/Photo/Product/Small/no_image.jpg') }}"
                                                alt="No Image">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="item-content">
                                        <div class="what-product-is">
                                            <ul class="bread-crumb">
                                                <li>
                                                    <a href="{{ url('products/'.$products['id']) }}">{{
                                                        $products['nama'] }}</a>
                                                </li>
                                            </ul>
                                            <h6 class="item-title">
                                                <a href="{{ url('products/'.$products['id']) }}">{{ $products['nama']
                                                    }}</a>
                                            </h6>
                                            <div class="item-stars">
                                                <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                    <span style='width:0'></span>
                                                </div>
                                                <span>(0)</span>
                                            </div>
                                        </div>
                                        <?php 
                                         $getdiskon = Product::getdiskonharga($products['id'])
                                        ?>
                                        @if($getdiskon>0)
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                {{ $getdiskon }}
                                            </div>
                                            <div class="item-old-price">
                                                {{ $products['harga'] }}
                                            </div>
                                        </div>
                                        @endif

                                    </div>
                                    {{-- <div class="tag new">
                                        <span>{{ $products['meta_title'] }}</span>
                                    </div> --}}
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade" id="men-featured-products">
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="5">
                                @foreach ($featured as $products)
                                <?php
                                    $products_imgPath = 'template/images/Photo/Product/Small/'.$products['gambar']
                                ?>
                                <div class="item">
                                    <div class="image-container">
                                        <a class="item-img-wrapper-link" href="{{ url('products/'.$products['id']) }}">
                                            @if(!empty($products['gambar']) && file_exists($products_imgPath) )
                                            <img class="img-fluid" src="{{ asset($products_imgPath) }}" alt="Product">
                                            @else
                                            <img class="img-fluid" <img style="width: 120px; height: 120px;"
                                                src="{{ asset('template/images/Photo/Product/Small/no_image.jpg') }}"
                                                alt="No Image">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="item-content">
                                        <div class="what-product-is">
                                            <ul class="bread-crumb">
                                                <li>
                                                    <a href="{{ url('products/'.$products['id']) }}">{{
                                                        $products['nama'] }}</a>
                                                </li>
                                            </ul>
                                            <h6 class="item-title">
                                                <a href="{{ url('products/'.$products['id']) }}">{{ $products['nama']
                                                    }}</a>
                                            </h6>
                                            <div class="item-stars">
                                                <div class='star' title="0 out of 5 - based on 0 Reviews">
                                                    <span style='width:0'></span>
                                                </div>
                                                <span>(0)</span>
                                            </div>
                                        </div>
                                        <?php 
                                         $getdiskon = Product::getdiskonharga($products['id'])
                                        ?>
                                        @if($getdiskon>0)
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                {{ $getdiskon }}
                                            </div>
                                            <div class="item-old-price">
                                                {{ $products['harga'] }}
                                            </div>
                                        </div>
                                        @endif

                                    </div>
                                    {{-- <div class="tag new">
                                        <span>{{ $products['meta_title'] }}</span>
                                    </div> --}}
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Top Collection /- -->
@if (isset($fixbanners[0]['gambar']))
<!-- Banner-Layer -->
<div class="banner-layer">
    <div class="container">
        <div class="image-banner">
            <a target="_blank" rel="nofollow" href="{{ url($fixbanners[1]['link']) }}"
                class="mx-auto banner-hover effect-dark-opacity">
                <img class="img-fluid" src="{{ asset('front/images/main-slider/'.$fixbanners[1]['gambar']) }}"
                    alt="{{ url($fixbanners[1]['alt']) }}" title="{{ url($fixbanners[1]['title']) }}">
            </a>
        </div>
    </div>
</div>
<!-- Banner-Layer /--->
@endif
<!-- Site-Priorities -->
<section class="app-priority">
    <div class="container">
        <div class="priority-wrapper u-s-p-b-80">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="single-item-wrapper">
                        <div class="single-item-icon">
                            <i class="ion ion-md-star"></i>
                        </div>
                        <h2>
                            Great Value
                        </h2>
                        <p>We offer competitive prices on our 100 million plus product range</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="single-item-wrapper">
                        <div class="single-item-icon">
                            <i class="ion ion-md-cash"></i>
                        </div>
                        <h2>
                            Shop with Confidence
                        </h2>
                        <p>Our Protection covers your purchase from click to delivery</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="single-item-wrapper">
                        <div class="single-item-icon">
                            <i class="ion ion-ios-card"></i>
                        </div>
                        <h2>
                            Safe Payment
                        </h2>
                        <p>Pay with the world’s most popular and secure payment methods</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="single-item-wrapper">
                        <div class="single-item-icon">
                            <i class="ion ion-md-contacts"></i>
                        </div>
                        <h2>
                            24/7 Help Center
                        </h2>
                        <p>Round-the-clock assistance for a smooth shopping experience</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Site-Priorities /- -->
@endsection