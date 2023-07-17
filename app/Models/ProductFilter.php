<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFilter extends Model
{
    use HasFactory;

    public static function getFilterName($product_filter_id)
    {
        $getFilterName = ProductFilter::select('filter_nama')->where('id', $product_filter_id)->first();
        return $getFilterName->filter_nama;
    }
}
