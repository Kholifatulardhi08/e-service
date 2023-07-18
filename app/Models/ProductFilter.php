<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductFilterValue;

class ProductFilter extends Model
{
    use HasFactory;

    public static function getFilterName($product_filter_id)
    {
        $getFilterName = ProductFilter::select('filter_nama')->where('id', $product_filter_id)->first();
        return $getFilterName->filter_nama;
    }

    public function product_filter_values()
    {
        return $this->hasMany(ProductFilterValue::class, 'product_filter_id');
    }

    public static function productFilters()
    {
        $productFilters = ProductFilter::with('product_filter_values')->where('status', 1)->get()->toArray();
        // dd($productFilters);
        return $productFilters;
    }

    public static function filterAvailable($product_filter_id, $category_id)
    {
        $filterAvailable= ProductFilter::select('cat_id')->where(['id'=>$product_filter_id, 'status'=>1])->first()->toArray();
        $catidArr = explode(",", $filterAvailable['cat_id']);
        if(in_array($category_id, $catidArr)){
            $available = "Yes";
        }else{
            $available = "No";
        }
        return $available;
    }
}
