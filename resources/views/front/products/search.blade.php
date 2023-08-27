@extends('front.layouts.layout')
@section('content')
<?php
use App\Models\Product;
use App\Models\Rating;
?>
<style>
    .best-product {
        position: relative;
        background-color: #FAD02E;
        color: #fff;
        padding: 10px;
        border-radius: 5px;
        text-align: center;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        margin-top: -15px;
        margin-bottom: 10px;
    }

    .ribbon {
        position: absolute;
        top: 0;
        right: 0;
        background-color: #E54747;
        color: #fff;
        padding: 5px 10px;
        transform: translate(50%, -50%) rotate(45deg);
        font-size: 12px;
    }

    .best-product-content {
        padding-top: 30px;
    }

    .best-product-content h6 {
        font-size: 18px;
        margin-bottom: 5px;
    }

    .best-product-content p {
        font-size: 14px;
    }
</style>
<!-- Search Page Wrapper -->
<div class="search-page-wrapper">
    <div class="container">
        <div class="shop-intro">
            <ul class="bread-crumb">
                <li class="has-separator">
                    <a href="/">Home</a>
                </li>
                {{ $categorydetails['breadcum'] }}
            </ul>
        </div>
        <div class="row">
            @if (isset($_REQUEST['search']) && !empty($_REQUEST['search']))
            @if(count($sortedProducts) > 0 || !$crawledProducts->isEmpty())
            <?php
                $bestRelativeProduct = $sortedProducts->first(); // Produk dengan skor relatif tertinggi
            ?>
            <!-- Display products from your website -->
            @foreach($sortedProducts as $product)
            <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                <div class="card">
                    <a href="{{ url('product/'.$product->id) }}">
                        <img src="{{ asset('template/images/Photo/Product/Small/'. $product->gambar) }}"
                            class="card-img-top" alt="Product">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->nama }}</h5>
                        <p class="card-text">{{ $product->deskripsi }}</p>
                        <div class="item-stars">
                            <div class="star" title="4.5 out of 5 - based on 23 Reviews">
                                <span style="width: 67px"></span>
                            </div>
                            <span>(23)</span>
                        </div>
                        <div class="price-template">
                            <?php 
                                $getdiskon = Product::getdiskonharga($product->id);
                            ?>
                            <div class="item-new-price">
                                Rp {{ $getdiskon }}
                            </div>
                            <div class="item-old-price">
                                {{ $product->harga }}
                            </div>
                        </div>
                    </div>
                    <?php
                    $isRecommended = in_array($product->id, Product::getRecommendedProductIds());
                    $isproductnew = Product::isproductnew($product['id']); 
                    ?>
                    @if($isproductnew=="Yes")
                    <div class="tag new">
                        <span>NEW</span>
                    </div>
                    @endif
                    @if($isRecommended)
                    <span class="badge bg-success position-absolute top-0 start-0">RECOMMENDED</span>
                    @endif
                    @if ($product->id === $bestRelativeProduct->id)
                    <div class="best-product">
                        <div class="ribbon">
                            <span>Terbaik</span>
                        </div>
                        <div class="best-product-content">
                            <h6>Produk Unggulan</h6>
                            <p>Dengan Skor dan Harga Terbaik</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
            <!-- Display crawled products -->
            @foreach($crawledProducts as $crawledProduct)
            <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                <div class="card">
                    <!-- Display crawled product details -->
                    <a href="{{ $crawledProduct->url }}">
                        <img src="{{ $crawledProduct->gambar_url }}" class="card-img-top"
                            alt="{{ $crawledProduct->nama_produk }}">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ $crawledProduct->url }}">{{ $crawledProduct->nama_produk }}</a>
                        </h5>
                        <div class="item-stars">
                            <div class="star" title="4.5 out of 5 - based on 23 Reviews">
                                <span style="width: 67px"></span>
                            </div>
                            <span>{{ $crawledProduct->rating }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="col">
                <!-- No products found from both sources -->
                <p class="text-center">No products found.</p>
            </div>
            @endif
            @endif
        </div>
    </div>
</div>
<!-- Search Page Wrapper /- -->
@endsection