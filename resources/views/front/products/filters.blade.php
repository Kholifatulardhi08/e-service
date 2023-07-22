<?php 
use App\Models\ProductFilter;
$productfilter = ProductFilter::productFilters();
?>
<!-- Shop-Left-Side-Bar-Wrapper -->
<div class="col-lg-3 col-md-3 col-sm-12">
    <!-- Filter-Size -->
    <?php 
    $getPaket = ProductFilter::getPaket($url); 
    ?>
    <div class="facet-filter-associates">
        <h3 class="title-name">Paket</h3>
        @foreach ($getPaket as $key => $paket )
        <form class="facet-form" action="#" method="post">
            <div class="associate-wrapper">
                <input type="checkbox" class="check-box paket" name="paket[]" id="paket{{ $key }}" value="{{ $paket }}">
                <label class="label-text" for="paket{{ $key }}">{{ $paket }}
                </label>
            </div>
        </form>
        @endforeach
    </div>
    <!-- Filter-Size -->
    <!-- Filter-category -->
    @foreach ($productfilter as $filter)
    <?php 
        $filterAvailable = ProductFilter::filterAvailable($filter['id'], $categorydetails['categorydetails']['id']);
    ?>
    @if($filterAvailable=="Yes")
    @if(count($filter['product_filter_values'])>0)
    <div class="facet-filter-associates">
        <h3 class="title-name">{{ $filter['filter_nama'] }}</h3>
        @foreach ($filter['product_filter_values'] as $value)
        <form class="facet-form" action="#" method="post">
            <div class="associate-wrapper">
                <input type="checkbox" class="check-box {{ $filter['filter_column'] }}"
                    id="{{ $value['filter_value'] }}" name="{{ $filter['filter_nama'] }}[]"
                    value="{{  $value['filter_value']  }}">
                <label class="label-text" for="{{ $value['filter_value'] }}">
                    {{ ucwords($value['filter_value']) }}
                </label>
            </div>
        </form>
        @endforeach
    </div>
    @endif
    @endif
    @endforeach
    <!-- Filter-category /- -->
    <!-- Filter-by-price -->
    <div class="facet-filter-associates">
        <h3 class="title-name">Harga</h3>
        <form class="facet-form" action="#" method="post">
            <div class="associate-wrapper">
                <?php 
                    $harga = array('1000 - 10000', '10000 - 100000', '100000 - 1000000', '1000000 - 100000000');
                ?>
                @foreach ( $harga as $key => $price )
                <input type="checkbox" class="check-box price" name="price[]" value="{{ $price }}" id="price{{ $key }}">
                <label class="label-text" for="price{{ $key }}">
                    {{ $price }}
                </label>
                @endforeach
            </div>
        </form>
    </div>
    <!-- Filter-by-price /- -->
    <?php 
    $getBrands = ProductFilter::getBrands($url); 
    ?>
    <!-- Filter-Brand -->
    <div class="facet-filter-associates">
        <h3 class="title-name">Brand</h3>
        <form class="facet-form" action="#" method="post">
            <div class="associate-wrapper">
                @foreach($getBrands as $key => $brand )
                <input type="checkbox" class="check-box brand" name="brand[]" value="{{ $brand['id'] }}" id="brand{{ $key }}">
                <label class="label-text" for="brand{{ $key }}">{{ $brand['nama'] }}
                    {{--  <span class="total-fetch-items">(0)</span>  --}}
                </label>
                @endforeach
            </div>
        </form>
    </div>
    <!-- Filter-Brand /- -->

    <?php /*
    <!-- Filter-Rating -->
    <div class="facet-filter-by-rating">
        <h3 class="title-name">Rating</h3>
        <div class="facet-form">
            <!-- 5 Stars -->
            <div class="facet-link">
                <div class="item-stars">
                    <div class='star'>
                        <span style='width:76px'></span>
                    </div>
                </div>
                <span class="total-fetch-items">(0)</span>
            </div>
            <!-- 5 Stars /- -->
            <!-- 4 & Up Stars -->
            <div class="facet-link">
                <div class="item-stars">
                    <div class='star'>
                        <span style='width:60px'></span>
                    </div>
                </div>
                <span class="total-fetch-items">& Up (5)</span>
            </div>
            <!-- 4 & Up Stars /- -->
            <!-- 3 & Up Stars -->
            <div class="facet-link">
                <div class="item-stars">
                    <div class='star'>
                        <span style='width:45px'></span>
                    </div>
                </div>
                <span class="total-fetch-items">& Up (0)</span>
            </div>
            <!-- 3 & Up Stars /- -->
            <!-- 2 & Up Stars -->
            <div class="facet-link">
                <div class="item-stars">
                    <div class='star'>
                        <span style='width:30px'></span>
                    </div>
                </div>
                <span class="total-fetch-items">& Up (0)</span>
            </div>
            <!-- 2 & Up Stars /- -->
            <!-- 1 & Up Stars -->
            <div class="facet-link">
                <div class="item-stars">
                    <div class='star'>
                        <span style='width:15px'></span>
                    </div>
                </div>
                <span class="total-fetch-items">& Up (0)</span>
            </div>
            <!-- 1 & Up Stars /- -->
        </div>
    </div>
    <!-- Filter-Rating -->
    <!-- Filters /- -->
    */ ?>
</div>
<!-- Shop-Left-Side-Bar-Wrapper /- -->