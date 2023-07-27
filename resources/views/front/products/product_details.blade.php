@extends('front.layouts.layout')
@section('content')
<?php
use App\Models\Product;
?>
<!-- Page Introduction Wrapper -->
<div class="page-style-a">
    <div class="container">
        <div class="page-intro">
            <h2>Detail</h2>
            <ul class="bread-crumb">
                <li class="has-separator">
                    <i class="ion ion-md-home"></i>
                    <a href="{{ ('/') }}">Home</a>
                </li>
                <li class="is-marked">
                    <a href="javascript:;">Detail</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Page Introduction Wrapper /- -->
<!-- Single-Product-Full-Width-Page -->
<div class="page-detail u-s-p-t-80 pt-3">
    <div class="container">
        <!-- Product-Detail -->
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <!-- Product-zoom-area -->
                <div class="zoom-area">
                    <?php
                        $products_imgPath = 'template/images/Photo/Product/Large/'.$product['gambar']
                    ?>
                    <img id="zoom-pro" class="img-fluid" src="{{ asset($products_imgPath) }}"
                        data-zoom-image="{{ asset($products_imgPath) }}" alt="Zoom Image">
                    <div id="gallery" class="u-s-m-t-10">
                        <a class="active" data-image="{{ asset($products_imgPath) }}"
                            data-zoom-image="{{ asset($products_imgPath) }}">
                            <img src="{{ asset($products_imgPath) }}" alt="Product">
                        </a>
                        @foreach($product['image'] as $img )
                        <a data-image="{{ asset('template/images/Photo/Product/Large/'.$img['nama']) }}"
                            data-zoom-image="{{ asset('template/images/Photo/Product/Large/'.$img['nama']) }}">
                            <img src="{{ asset('template/images/Photo/Product/Large/'.$img['nama']) }}" alt="Product">
                        </a>
                        @endforeach
                    </div>
                </div>
                <!-- Product-zoom-area /- -->
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <!-- Product-details -->
                <div class="all-information-wrapper">
                    @if(Session::has('error_message'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Error: </strong>
                        <?php
                         echo Session::get('error_message');
                        ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    @if(Session::has('succses_message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success: </strong>
                        <?php
                         echo Session::get('succses_message');
                        ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
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
                    <div class="section-1-title-breadcrumb-rating">
                        <div class="product-title">
                            <h1>
                                <a href="javascript:;">{{ $product['nama'] }}</a>
                            </h1>
                        </div>
                        <ul class="bread-crumb">
                            <li class="has-separator">
                                <a href="{{ ('/') }}">Home</a>
                            </li>
                            <li class="has-separator">
                                <a href="javascript:;">{{ $product['section']['nama'] }}</a>
                            </li>
                            <?php echo $categorydetails['breadcum'] ?>
                        </ul>
                        <div class="product-rating">
                            <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                <span style='width:67px'></span>
                            </div>
                            <span>(23)</span>
                        </div>
                    </div>
                    <div class="section-2-short-description u-s-p-y-14">
                        <h6 class="information-heading u-s-m-b-8">Description:</h6>
                        <p>
                            {{ $product['deskripsi'] }}
                        </p>
                    </div>
                    <div class="section-3-price-original-discount u-s-p-y-14">
                        <?php 
                            $getdiskon = Product::getdiskonharga($product['id'])
                        ?>
                        <span class="getAttributeharga">
                            @if ($getdiskon>0)
                            <div class="price">
                                <h4>Rp.{{ $getdiskon}}</h4>
                            </div>
                            <div class="original-price">
                                <span>Original Price:</span>
                                <span>Rp.{{ $product['harga'] }}</span>
                            </div>
                            @else
                            <div class="price">
                                <h4>Rp.{{ $getdiskon}}</h4>
                            </div>
                            @endif
                        </span>
                    </div>
                    <div class="section-4-sku-information u-s-p-y-14">
                        <h6 class="information-heading u-s-m-b-8">Sku Information:</h6>
                        <div class="availability">
                            <span>Availability :</span>
                            @if($totalStock>0)
                            <span>Tersedia Jam/Hari</span>
                            @else
                            <span>Tidak Tersedia Stock Jam/Hari</span>
                            @endif
                        </div>
                        <div class="left">
                            <span>Only:</span>
                            <span>{{ $totalStock }} jam/Hari</span>
                        </div>
                    </div>
                    <div class="section-5-penyedia u-s-p-y-14 pt-2">
                        @if(isset($product['penyedia']))
                        <span> Penyedia Jasa :
                            <a href="{{  url('products/'.$product['penyedia']['id']) }}">
                                {{ $product['penyedia']['jasadetail']['nama_toko'] }}
                            </a>
                        </span>
                        @endif
                    </div>
                    <form action="{{ url('cart/add') }}" class="post-form" method="POST">
                        @csrf
                        <div class="quantity-wrapper u-s-m-b-22">
                            <span>Quantity:</span>
                            <div class="quantity">
                                <input type="number" name="quantity" class="quantity-text-field" value="1">
                                <a class="plus-a" data-max="1000">&#43;</a>
                                <a class="minus-a" data-min="1">&#45;</a>
                            </div>
                        </div>
                        <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                        <div class="section-5-product-variants u-s-p-y-14">
                            <h6 class="information-heading u-s-m-b-8">Product Variants:</h6>
                            <div class="sizes u-s-m-b-11">
                                <span>Varian Paket :</span>
                                <div class="size-variant select-box-wrapper">
                                    @if (count($product['attribute']) > 0)
                                    <select name="paket" id="getPaket" product-id="{{ $product['id'] }}"
                                        class="select-box product-size" required="">
                                        <option value="">Select</option>
                                        @foreach ($product['attribute'] as $attribute)
                                        <option value="{{ $attribute['paket'] }}">{{ $attribute['paket'] }}</option>
                                        @endforeach
                                    </select>
                                    @else
                                    <p>Tidak ada paket attribute yang tersedia untuk produk ini.</p>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <button class="button button-outline-secondary" type="submit">Add to cart</button>
                                <button class="button button-outline-secondary far fa-heart u-s-m-l-6"></button>
                                <button class="button button-outline-secondary far fa-envelope u-s-m-l-6"></button>
                            </div>
                        </div>
                    </form>
                    <div class="section-6-social-media-quantity-actions u-s-p-y-14">
                        <div class="quick-social-media-wrapper u-s-m-b-22">
                            <span>Share:</span>
                            <ul class="social-media-list">
                                <li>
                                    <a href="#">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fab fa-google-plus-g"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fas fa-rss"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fab fa-pinterest"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product-details /- -->
        </div>
    </div>
    <!-- Product-Detail /- -->
    <!-- Detail-Tabs -->
    <div class="row pt-1">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="detail-tabs-wrapper u-s-p-t-80">
                <div class="detail-nav-wrapper u-s-m-b-30">
                    <ul class="nav single-product-nav justify-content-center">
                        {{-- <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#description">Video</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#specification">Specifications</a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#review">Reviews
                                (15)</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <!-- Reviews-Tab -->
                    <div class="tab-pane fade active show" id="review">
                        <div class="review-whole-container">
                            <div class="row r-1 u-s-m-b-26 u-s-p-b-22">
                                <div class="col-lg-6 col-md-6">
                                    <div class="total-score-wrapper">
                                        <h6 class="review-h6">Average Rating</h6>
                                        <div class="circle-wrapper">
                                            <h1>4.5</h1>
                                        </div>
                                        <h6 class="review-h6">Based on 23 Reviews</h6>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="total-star-meter">
                                        <div class="star-wrapper">
                                            <span>5 Stars</span>
                                            <div class="star">
                                                <span style='width:0'></span>
                                            </div>
                                            <span>(0)</span>
                                        </div>
                                        <div class="star-wrapper">
                                            <span>4 Stars</span>
                                            <div class="star">
                                                <span style='width:67px'></span>
                                            </div>
                                            <span>(23)</span>
                                        </div>
                                        <div class="star-wrapper">
                                            <span>3 Stars</span>
                                            <div class="star">
                                                <span style='width:0'></span>
                                            </div>
                                            <span>(0)</span>
                                        </div>
                                        <div class="star-wrapper">
                                            <span>2 Stars</span>
                                            <div class="star">
                                                <span style='width:0'></span>
                                            </div>
                                            <span>(0)</span>
                                        </div>
                                        <div class="star-wrapper">
                                            <span>1 Star</span>
                                            <div class="star">
                                                <span style='width:0'></span>
                                            </div>
                                            <span>(0)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row r-2 u-s-m-b-26 u-s-p-b-22">
                                <div class="col-lg-12">
                                    <div class="your-rating-wrapper">
                                        <h6 class="review-h6">Your Review is matter.</h6>
                                        <h6 class="review-h6">Have you used this product before?</h6>
                                        <div class="star-wrapper u-s-m-b-8">
                                            <div class="star">
                                                <span id="your-stars" style='width:0'></span>
                                            </div>
                                            <label for="your-rating-value"></label>
                                            <input id="your-rating-value" type="text" class="text-field"
                                                placeholder="0.0">
                                            <span id="star-comment"></span>
                                        </div>
                                        <form>
                                            <label for="your-name">Name
                                                <span class="astk"> *</span>
                                            </label>
                                            <input id="your-name" type="text" class="text-field"
                                                placeholder="Your Name">
                                            <label for="your-email">Email
                                                <span class="astk"> *</span>
                                            </label>
                                            <input id="your-email" type="text" class="text-field"
                                                placeholder="Your Email">
                                            <label for="review-title">Review Title
                                                <span class="astk"> *</span>
                                            </label>
                                            <input id="review-title" type="text" class="text-field"
                                                placeholder="Review Title">
                                            <label for="review-text-area">Review
                                                <span class="astk"> *</span>
                                            </label>
                                            <textarea class="text-area u-s-m-b-8" id="review-text-area"
                                                placeholder="Review"></textarea>
                                            <button class="button button-outline-secondary">Submit Review</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Get-Reviews -->
                            <div class="get-reviews u-s-p-b-22">
                                <!-- Review-Options -->
                                <div class="review-options u-s-m-b-16">
                                    <div class="review-option-heading">
                                        <h6>Reviews
                                            <span> (15) </span>
                                        </h6>
                                    </div>
                                    <div class="review-option-box">
                                        <div class="select-box-wrapper">
                                            <label class="sr-only" for="review-sort">Review Sorter</label>
                                            <select class="select-box" id="review-sort">
                                                <option value="">Sort by: Best Rating</option>
                                                <option value="">Sort by: Worst Rating</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- Review-Options /- -->
                                <!-- All-Reviews -->
                                <div class="reviewers">
                                    <div class="review-data">
                                        <div class="reviewer-name-and-date">
                                            <h6 class="reviewer-name">John</h6>
                                            <h6 class="review-posted-date">10 May 2018</h6>
                                        </div>
                                        <div class="reviewer-stars-title-body">
                                            <div class="reviewer-stars">
                                                <div class="star">
                                                    <span style='width:67px'></span>
                                                </div>
                                                <span class="review-title">Good!</span>
                                            </div>
                                            <p class="review-body">
                                                Good Quality...!
                                            </p>
                                        </div>
                                    </div>
                                    <div class="review-data">
                                        <div class="reviewer-name-and-date">
                                            <h6 class="reviewer-name">Doe</h6>
                                            <h6 class="review-posted-date">10 June 2018</h6>
                                        </div>
                                        <div class="reviewer-stars-title-body">
                                            <div class="reviewer-stars">
                                                <div class="star">
                                                    <span style='width:67px'></span>
                                                </div>
                                                <span class="review-title">Well done!</span>
                                            </div>
                                            <p class="review-body">
                                                Cotton is good.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="review-data">
                                        <div class="reviewer-name-and-date">
                                            <h6 class="reviewer-name">Tim</h6>
                                            <h6 class="review-posted-date">10 July 2018</h6>
                                        </div>
                                        <div class="reviewer-stars-title-body">
                                            <div class="reviewer-stars">
                                                <div class="star">
                                                    <span style='width:67px'></span>
                                                </div>
                                                <span class="review-title">Well done!</span>
                                            </div>
                                            <p class="review-body">
                                                Excellent condition
                                            </p>
                                        </div>
                                    </div>
                                    <div class="review-data">
                                        <div class="reviewer-name-and-date">
                                            <h6 class="reviewer-name">Johnny</h6>
                                            <h6 class="review-posted-date">10 March 2018</h6>
                                        </div>
                                        <div class="reviewer-stars-title-body">
                                            <div class="reviewer-stars">
                                                <div class="star">
                                                    <span style='width:67px'></span>
                                                </div>
                                                <span class="review-title">Bright!</span>
                                            </div>
                                            <p class="review-body">
                                                Cotton
                                            </p>
                                        </div>
                                    </div>
                                    <div class="review-data">
                                        <div class="reviewer-name-and-date">
                                            <h6 class="reviewer-name">Alexia C. Marshall</h6>
                                            <h6 class="review-posted-date">12 May 2018</h6>
                                        </div>
                                        <div class="reviewer-stars-title-body">
                                            <div class="reviewer-stars">
                                                <div class="star">
                                                    <span style='width:67px'></span>
                                                </div>
                                                <span class="review-title">Well done!</span>
                                            </div>
                                            <p class="review-body">
                                                Good polyester Cotton
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- All-Reviews /- -->
                                <!-- Pagination-Review -->
                                <div class="pagination-review-area">
                                    <div class="pagination-review-number">
                                        <ul>
                                            <li style="display: none">
                                                <a href="single-product.html" title="Previous">
                                                    <i class="fas fa-angle-left"></i>
                                                </a>
                                            </li>
                                            <li class="active">
                                                <a href="single-product.html">1</a>
                                            </li>
                                            <li>
                                                <a href="single-product.html">2</a>
                                            </li>
                                            <li>
                                                <a href="single-product.html">3</a>
                                            </li>
                                            <li>
                                                <a href="single-product.html">...</a>
                                            </li>
                                            <li>
                                                <a href="single-product.html">10</a>
                                            </li>
                                            <li>
                                                <a href="single-product.html" title="Next">
                                                    <i class="fas fa-angle-right"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- Pagination-Review /- -->
                            </div>
                            <!-- Get-Reviews /- -->
                        </div>
                    </div>
                    <!-- Reviews-Tab /- -->
                </div>
            </div>
        </div>
    </div>
    <!-- Detail-Tabs /- -->
    <!-- Different-Product-Section -->
    <div class="detail-different-product-section u-s-p-t-80">
        <!-- Similar-Products -->
        <section class="section-maker">
            <div class="container">
                <div class="sec-maker-header text-center">
                    <h3 class="sec-maker-h3">Similar Products</h3>
                </div>
                <div class="slider-fouc">
                    <div class="products-slider owl-carousel" data-item="4">
                        @foreach ($similiarproduct as $similiar)
                        <div class="item">
                            <div class="image-container">
                                <a class="item-img-wrapper-link" href="single-product.html">
                                    <?php
                                        $products_imgPath = 'template/images/Photo/Product/Small/'.$similiar['gambar']
                                    ?>
                                    @if(!empty($similiar['gambar']) && file_exists($products_imgPath))
                                    <img class="img-fluid" src="{{ asset($products_imgPath) }}" alt="Product">
                                    @else
                                    <img class="img-fluid"
                                        src="{{ asset('template/images/Photo/Product/Small/no_image.jpg') }}"
                                        alt="Product">
                                    @endif
                                </a>
                                <div class="item-action-behaviors">
                                    <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look</a>
                                    <a class="item-mail" href="javascript:void(0)">Mail</a>
                                    <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                    <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                </div>
                            </div>
                            <div class="item-content">
                                <div class="what-product-is">
                                    <ul class="bread-crumb">
                                        <li class="has-separator">
                                            <a href="shop-v1-root-category.html">{{ $similiar['meta_title'] }}</a>
                                        </li>
                                        <li>
                                            <a href="shop-v3-sub-sub-category.html">{{ $similiar['type'] }}</a>
                                        </li>
                                    </ul>
                                    <h6 class="item-title">
                                        <a href="{{ url('product/'.$similiar['id']) }}">{{ $similiar['nama'] }}</a>
                                    </h6>
                                    <div class="item-description">
                                        <p>{{ $similiar['deskripsi'] }}</p>
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
                                            $getdiskon = Product::getdiskonharga($similiar['id'])
                                        ?>
                                    <div class="item-new-price">
                                        Rp {{ $getdiskon }}
                                    </div>
                                    <div class="item-old-price">
                                        {{ $similiar['harga'] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- Similar-Products /- -->
        <!-- Recently-View-Products  -->
        {{-- <section class="section-maker">
            <div class="container">
                <div class="sec-maker-header text-center">
                    <h3 class="sec-maker-h3">Recently View</h3>
                </div>
                <div class="slider-fouc">
                    <div class="products-slider owl-carousel" data-item="4">
                        <div class="item">
                            <div class="image-container">
                                <a class="item-img-wrapper-link" href="single-product.html">
                                    <img class="img-fluid" src="images/product/product@3x.jpg" alt="Product">
                                </a>
                                <div class="item-action-behaviors">
                                    <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look</a>
                                    <a class="item-mail" href="javascript:void(0)">Mail</a>
                                    <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                    <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                </div>
                            </div>
                            <div class="item-content">
                                <div class="what-product-is">
                                    <ul class="bread-crumb">
                                        <li class="has-separator">
                                            <a href="shop-v1-root-category.html">{{ $catpro['meta_title'] }}</a>
                                        </li>
                                        <li>
                                            <a href="shop-v3-sub-sub-category.html">{{ $catpro['type'] }}</a>
                                        </li>
                                    </ul>
                                    <h6 class="item-title">
                                        <a href="{{ url('product/'.$catpro['id']) }}">{{ $catpro['nama'] }}</a>
                                    </h6>
                                    <div class="item-description">
                                        <p>{{ $catpro['deskripsi'] }}</p>
                                    </div>
                                    <div class="item-stars">
                                        <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                            <span style='width:67px'></span>
                                        </div>
                                        <span>(23)</span>
                                    </div>
                                </div>
                                <div class="price-template">
                                    <div class="item-new-price">
                                        $100.00
                                    </div>
                                    <div class="item-old-price">
                                        $120.00
                                    </div>
                                </div>
                            </div>
                            <div class="tag hot">
                                <span>HOT</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
        <!-- Recently-View-Products /- -->
    </div>
    <!-- Different-Product-Section /- -->
</div>
<!-- Single-Product-Full-Width-Page /- -->
@endsection