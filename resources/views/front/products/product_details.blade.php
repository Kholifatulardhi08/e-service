@extends('front.layouts.layout')
@section('content')
<?php
use App\Models\Product;
?>
<style>
    * {
        margin: 0;
        padding: 0;
    }

    .rate {
        float: left;
        height: 46px;
        padding: 0 10px;
    }

    .rate:not(:checked)>input {
        position: inherit;
        top: -9999px;
    }

    .rate:not(:checked)>label {
        float: right;
        width: 1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #ccc;
    }

    .rate:not(:checked)>label:before {
        content: '★ ';
    }

    .rate>input:checked~label {
        color: #ffc700;
    }

    .rate:not(:checked)>label:hover,
    .rate:not(:checked)>label:hover~label {
        color: #deb217;
    }

    .rate>input:checked+label:hover,
    .rate>input:checked+label:hover~label,
    .rate>input:checked~label:hover,
    .rate>input:checked~label:hover~label,
    .rate>label:hover~input:checked~label {
        color: #c59b08;
    }
</style>
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
                            <span>
                                @if ($avgStar > 0)
                                <?php $count = 0; ?>
                                @while ($count < $avgStar) <span style="color: gold;">&#9733;
                            </span>
                            <?php $count++; ?>
                            @endwhile
                            {{ count($rating) }}
                            @else
                            Belum Ada Rating
                            @endif
                            </span>
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
    <div class="row">
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
                                {{ count($rating) }}
                            </a>
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
                                            <h1>{{ $avgRating }}</h1>
                                        </div>
                                        <h6 class="review-h6">Based on {{ count($rating) }} Reviews</h6>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="total-star-meter">
                                        <div class="star-wrapper">
                                            <span>5 Stars</span>
                                            <div class="star">
                                                <span style='width:0px'></span>
                                            </div>
                                            <span>{{ $rating5count }}</span>
                                        </div>
                                        <div class="star-wrapper">
                                            <span>4 Stars</span>
                                            <div class="star">
                                                <span style='width:0px'></span>
                                            </div>
                                            <span>{{ $rating4count }}</span>
                                        </div>
                                        <div class="star-wrapper">
                                            <span>3 Stars</span>
                                            <div class="star">
                                                <span style='width:0px'></span>
                                            </div>
                                            <span>{{ $rating3count }}</span>
                                        </div>
                                        <div class="star-wrapper">
                                            <span>2 Stars</span>
                                            <div class="star">
                                                <span style='width:0px'></span>
                                            </div>
                                            <span>{{ $rating2count }}</span>
                                        </div>
                                        <div class="star-wrapper">
                                            <span>1 Stars</span>
                                            <div class="star">
                                                <span style='width:0px'></span>
                                            </div>
                                            <span>{{ $rating1count }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row r-2 u-s-m-b-26 u-s-p-b-22">
                                <div class="col-lg-12">
                                    <div class="your-rating-wrapper">
                                        <h6 class="review-h6">Your Review is matter.</h6>
                                        <h6 class="review-h6">Have you used this product before?</h6>
                                        <form action="{{ url('add-rating') }}" method="POST" name="formRating"
                                            id="formRating">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                                            <div class="star-wrapper u-s-m-b-8">
                                                <div class="rate">
                                                    <input style="display: none;" type="radio" id="star5" name="rating"
                                                        value="5" />
                                                    <label for="star5" title="text">5 stars</label>
                                                    <input style="display: none;" type="radio" id="star4" name="rating"
                                                        value="4" />
                                                    <label for="star4" title="text">4 stars</label>
                                                    <input style="display: none;" type="radio" id="star3" name="rating"
                                                        value="3" />
                                                    <label for="star3" title="text">3 stars</label>
                                                    <input style="display: none;" type="radio" id="star2" name="rating"
                                                        value="2" />
                                                    <label for="star2" title="text">2 stars</label>
                                                    <input style="display: none;" style="display: none;" type="radio"
                                                        id="star1" name="rating" value="1" />
                                                    <label for="star1" title="text">1 star</label>
                                                </div>
                                            </div>
                                            <textarea class="text-area u-s-m-b-8" name="review" id="review-text-area"
                                                placeholder="Review" required></textarea>
                                            <button type="submit" class="button button-outline-secondary">Submit
                                                Review</button>
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
                                            <span>{{ count($rating) }}</span>
                                        </h6>
                                    </div>
                                </div>
                                <!-- Review-Options /- -->
                                <!-- All-Reviews -->
                                <div class="reviewers">
                                    @if(count($rating) > 0)
                                    @foreach ($rating as $item)
                                    <div class="review-data">
                                        <div class="reviewer-name-and-date">
                                            <h6 class="reviewer-name">{{ $item['user']['name'] }}</h6>
                                            <h6 class="review-posted-date">{{ $item['user']['email'] }} / {{ date("d-m-Y
                                                H:i:s", strtotime($item['created_at'])) }}</h6>
                                        </div>
                                        <div class="reviewer-stars-title-body">
                                            <div class="reviewer-stars">
                                                <?php $count = 0; ?>
                                                @while($count < $item['rating']) <span style="color: gold;">
                                                    &#9733;</span>
                                                    <?php $count++; ?>
                                                    @endwhile
                                            </div>
                                            <p class="review-body">
                                                {{ $item['review'] }}
                                            </p>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                    <p>Product ini belum di-review.</p>
                                    @endif
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
    </div>
    <!-- Different-Product-Section /- -->
</div>
<!-- Single-Product-Full-Width-Page /- -->
@endsection