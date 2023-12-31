<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductAtribute;
use App\Models\ProductFilterValue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public static function getPaket($url)
    {
        $categorydetails = Category::categorydetails($url);
        $getProductid = Product::whereIn('category_id', $categorydetails['catid'])->pluck('id')->toArray();
        $getpakets = ProductAtribute::select('paket')->whereIn('product_id', $getProductid)->groupBy('paket')->pluck('paket')->toArray();
        // echo "<pre>"; print_r($getpakets); die;
        return $getpakets;
    }

    public static function getBrands($url)
    {
        $categorydetails = Category::categorydetails($url);
        $getProductid = Product::whereIn('category_id', $categorydetails['catid'])->pluck('id')->toArray();
        $getbrandids = Product::select('brand_id')->whereIn('id', $getProductid)->groupBy('brand_id')->pluck('brand_id')->toArray();
        $getBrands = Brand::select('id', 'nama')->whereIn('id', $getbrandids)->get()->toArray();
        // echo "<pre>"; print_r($getbrandDetails); die;
        return $getBrands;
    }

}
