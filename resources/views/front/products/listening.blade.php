@extends('front.layouts.layout')
@section('content')
<?php
use App\Models\Product;
?>
<!-- Page Introduction Wrapper -->
<div class="page-style-a">
    <div class="container">
        <div class="page-intro">
            <h2>Shop</h2>
            <ul class="bread-crumb">
                <li class="has-separator">
                    <i class="ion ion-md-home"></i>
                    <a href="index.html">Home</a>
                </li>
                <li class="is-marked">
                    <a href="listing.html">Shop</a>
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
                <?php echo $categorydetails['breadcum'] ?>
            </ul>
        </div>
        <!-- Shop-Intro /- -->
        <div class="row">
            @include('front.products.filters')
            <!-- Shop-Right-Wrapper -->
            <div class="col-lg-9 col-md-9 col-sm-12">
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
                    <!-- Toolbar Sorter 1  -->
                    <form name="sortProducts" id="sortProucts">
                        <div class="toolbar-sorter">
                            <div class="select-box-wrapper">
                                <label class="sr-only" for="sort-by">Sort By</label>
                                <select name="sort" id="sort" class="select-box">
                                    <option value="">selected</option>
                                    <option value="a-z" @if(isset($_GET['sort']) && $_GET['sort']=="a-z" ) selected=""
                                        @endif>Sort By: Name A-Z</option>
                                    <option value="z-a" @if(isset($_GET['sort']) && $_GET['sort']=="z-a" ) selected=""
                                        @endif>Sort By: Name Z-A</option>
                                    <option value="terakhir" @if(isset($_GET['sort']) && $_GET['sort']=="terakhir" )
                                        selected="" @endif>Sort By: Latest</option>
                                    <option value="murah" @if(isset($_GET['sort']) && $_GET['sort']=="murah" )
                                        selected="" @endif>Sort By: Lowest Price</option>
                                    <option value="mahal" @if(isset($_GET['sort']) && $_GET['sort']=="mahal" )
                                        selected="" @endif>Sort By: Highest Price</option>
                                    {{-- <option value="">Sort By: Best Rating</option> --}}
                                </select>
                            </div>
                        </div>
                    </form>
                    <!-- //end Toolbar Sorter 1  -->
                    <!-- Toolbar Sorter 2  -->
                    <div class="toolbar-sorter-2">
                        <div class="select-box-wrapper">
                            <label class="sr-only" for="show-records">Show Records Per Page</label>
                            <select class="select-box" id="show-records">
                                <option selected="selected" value="">Show: {{ count($categoryproduct) }}</option>
                                <option value="">Show: All</option>
                            </select>
                        </div>
                    </div>
                    <!-- //end Toolbar Sorter 2  -->
                </div>
                <!-- Page-Bar /- -->
                <!-- Row-of-Product-Container -->
                <div class="row product-container list-style">
                    @foreach($categoryproduct as $catpro)
                    <div class="product-item col-lg-4 col-md-6 col-sm-6">
                        <div class="item">
                            <div class="image-container">
                                <a class="item-img-wrapper-link" href="single-product.html">
                                    <?php
                                    $products_imgPath = 'template/images/Photo/Product/Small/'.$catpro['gambar']
                                    ?>
                                    @if(!empty($catpro['gambar']) && file_exists($products_imgPath))
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
                                            <a href="shop-v1-root-category.html">{{ $catpro['meta_title'] }}</a>
                                        </li>
                                        <li>
                                            <a href="shop-v3-sub-sub-category.html">{{ $catpro['type'] }}</a>
                                        </li>
                                    </ul>
                                    <h6 class="item-title">
                                        <a href="single-product.html">{{ $catpro['nama'] }}</a>
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
                                    <?php 
                                         $getdiskon = Product::getdiskonharga($catpro['id'])
                                    ?>
                                    <div class="item-new-price">
                                        Rp {{ $getdiskon }}
                                    </div>
                                    <div class="item-old-price">
                                        {{ $catpro['harga'] }}
                                    </div>
                                </div>
                            </div>
                            <?php $isproductnew = Product::isproductnew($catpro['id']); ?>
                            @if($isproductnew="Yes")
                            <div class="tag new">
                                <span>NEW</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- Row-of-Product-Container /- -->
                @if(isset($_GET['sort']))
                    <div>{{ $categoryproduct->appends($_GET['sort'])->links() }}</div>
                @else
                <div>{{ $categoryproduct->links() }}</div>
                @endif
            </div>
            <!-- Shop-Right-Wrapper /- -->
        </div>
    </div>
</div>
<!-- Shop-Page /- -->
@endsection