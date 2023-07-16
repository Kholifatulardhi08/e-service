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
                    <form name="sortProducts" id="sortProducts">
                        <input type="hidden" name="url" id="url" value="{{ $url }}">
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
                <div class="filter-product">
                    @include('front.products.sort')
                </div>
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