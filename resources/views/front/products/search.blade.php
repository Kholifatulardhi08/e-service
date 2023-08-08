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
            @if(count($categoryproduct) > 0)
            @foreach($categoryproduct as $product)
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="item">
                    <div class="image-container">
                        <a class="item-img-wrapper-link" href="{{ url('product/'.$product['id']) }}">
                            <?php
                                    $products_imgPath = 'template/images/Photo/Product/Small/'.$product['gambar']
                                ?>
                            @if(!empty($product['gambar']) && file_exists($products_imgPath))
                            <img class="img-fluid" src="{{ asset($products_imgPath) }}" alt="Product">
                            @else
                            <img class="img-fluid" src="{{ asset('template/images/Photo/Product/Small/no_image.jpg') }}"
                                alt="Product">
                            @endif
                        </a>
                    </div>
                    <div class="item-content">
                        <div class="what-product-is">
                            <ul class="bread-crumb">
                                <li class="has-separator">
                                    <a href="#">{{ $product['meta_title'] }}</a>
                                </li>
                                <li>
                                    <a href="">{{ $product['type'] }}</a>
                                </li>
                            </ul>
                            <h6 class="item-title">
                                <a href="{{ url('product/'.$product['id']) }}">{{ $product['nama'] }}</a>
                            </h6>
                            <div class="item-description">
                                <p>{{ $product['deskripsi'] }}</p>
                            </div>
                            <div class="item-stars">
                                <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                    <span style='width:67px'></span>
                                </div>
                                <span>(23)</span>
                            </div>
                        </div>
                        <div class="price-template">
                            <?php 
                                    $getdiskon = Product::getdiskonharga($product['id'])
                                ?>
                            <div class="item-new-price">
                                Rp {{ $getdiskon }}
                            </div>
                            <div class="item-old-price">
                                {{ $product['harga'] }}
                            </div>
                        </div>
                    </div>
                    <?php $isproductnew = Product::isproductnew($product['id']); ?>
                    @if($isproductnew=="Yes")
                    <div class="tag new">
                        <span>NEW</span>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
            @else
            <div class="col">
                <p>No products found for your search.</p>
            </div>
            @endif
        </div>
    </div>
    
</div>
<!-- Search Page Wrapper /- -->
@endsection