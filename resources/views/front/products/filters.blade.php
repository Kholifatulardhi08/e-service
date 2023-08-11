<?php 
use App\Models\ProductFilter;
$productfilter = ProductFilter::productFilters();
?>
<!-- Shop-Left-Side-Bar-Wrapper -->
<div class="col-lg-3 col-md-3 col-sm-12">
    @if(!isset($_REQUEST['search']))
    <?php 
    $getBrands = ProductFilter::getBrands($url); 
    ?>
    <!-- Filter-Brand -->
    <div class="facet-filter-associates">
        <h3 class="title-name">Brand</h3>
        <form class="facet-form" action="#" method="post">
            <div class="associate-wrapper">
                @foreach($getBrands as $key => $brand )
                <div class="form-check">
                    <input type="checkbox" class="form-check-input brand" name="brand[]" value="{{ $brand['id'] }}"
                        id="brand{{ $key }}">
                    <label class="form-check-label" for="brand{{ $key }}">{{ $brand['nama'] }}</label>
                </div>
                @endforeach
            </div>
        </form>
    </div>
    <!-- Filter-Brand /- -->

    <!-- Filter-Size -->
    <?php 
    $getPaket = ProductFilter::getPaket($url); 
    ?>
    <div class="facet-filter-associates">
        <h3 class="title-name">Paket</h3>
        @foreach ($getPaket as $key => $paket )
        <form class="facet-form" action="#" method="post">
            <div class="associate-wrapper">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input paket" name="paket[]" id="paket{{ $key }}"
                        value="{{ $paket }}">
                    <label class="form-check-label" for="paket{{ $key }}">{{ $paket }}</label>
                </div>
            </div>
        </form>
        @endforeach
    </div>
    <!-- Filter-Size /- -->

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
                <div class="form-check">
                    <input type="checkbox" class="form-check-input {{ $filter['filter_column'] }}"
                        id="{{ $value['filter_value'] }}" name="{{ $filter['filter_nama'] }}[]"
                        value="{{  $value['filter_value']  }}">
                    <label class="form-check-label" for="{{ $value['filter_value'] }}">
                        {{ ucwords($value['filter_value']) }}
                    </label>
                </div>
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
                <div class="form-check">
                    <input type="checkbox" class="form-check-input price" name="price[]" value="{{ $price }}"
                        id="price{{ $key }}">
                    <label class="form-check-label" for="price{{ $key }}">
                        {{ $price }}
                    </label>
                </div>
                @endforeach
            </div>
        </form>
    </div>
    <!-- Filter-by-price /- -->
    @endif
</div>
<!-- Shop-Left-Side-Bar-Wrapper /- -->