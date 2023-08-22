@extends('front.layouts.layout')
@section('content')
<?php
use App\Models\Product;
?>

<!-- Search Page Wrapper -->
<div class="search-page-wrapper">
    <div class="container">
        <div class="shop-intro">
            <ul class="bread-crumb">
                <li class="has-separator">
                    <a href="/">Home</a>
                </li>
                <?php echo $categorydetails['breadcum'] ?>
            </ul>
        </div>
        <div class="row">
            @if (isset($_REQUEST['search']) && !empty($_REQUEST['search']))
            @if(count($categoryproduct) > 0 || !$crawledProducts->isEmpty())
            <!-- Display products from your website -->
            @foreach($categoryproduct as $product)
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
                        <?php $isproductnew = Product::isproductnew($product->id); ?>
                        @if($isproductnew=="Yes")
                        <div class="tag new">
                            <span>NEW</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Display crawled products -->
            @foreach($crawledProducts as $crawledProduct)
            <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                <div class="card">
                    <!-- Display crawled product details -->
                    <a href="{{ $crawledProduct->url }}">
                        <img src="{{ $crawledProduct->gambar_url }}" class="card-img-top" alt="{{ $crawledProduct->nama_produk }}">
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