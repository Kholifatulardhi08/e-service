<?php 
use App\Models\ProductFilter;
$productfilter = ProductFilter::productFilters();

if(isset($product['category_id'])){
    $category_id = $product['category_id'];
}

?>
@foreach ($productfilter as $filter)
@if(isset($category_id))
<?php 
    $filterAvailable = ProductFilter::filterAvailable($filter['id'], $category_id);
?>
@if(count($filter['product_filter_values'])>0)
<div class="form-group">
    <label for="{{ $filter['filter_column'] }}">{{ $filter['filter_column'] }}</label>
    <select class="form-control" name="{{ $filter['filter_column'] }}" id="{{ $filter['filter_column'] }}">
        @foreach($filter['product_filter_values'] as $value)
        <option value="{{ $value['filter_value'] }}" @if(!empty($filter['filter_column']) &&
            $filter['filter_column']==$value['filter_value']) selected="" @endif>{{
            ucwords($value['filter_value']) }}</option>
        @endforeach
    </select>
</div>
@endif
@endif
@endforeach