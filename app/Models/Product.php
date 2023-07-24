<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Section;
use App\Models\Penyedia;
use App\Models\ProductAtribute;
use App\Models\Images;
use App\Models\Brands;
use App\Models\JasaDetail;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function attribute()
    {
        return $this->hasMany(ProductAtribute::class);
    }

    public function image()
    {
        return $this->hasMany(Images::class);
    }

    public static function getdiskonharga($product_id)
    {
        $prodetails = Product::select('harga', 'diskon', 'category_id')->where('id', $product_id)->first();
        $prodetails = json_decode($prodetails, true);
        $catdetails = Category::select('diskon')->where('id', $prodetails['category_id'])->first();
        $catdetails = json_decode($catdetails, true);
        // json_decode($view_penyedia_details,true);

        if($prodetails['diskon']>0) {
            $diskon_harga = $prodetails['harga'] - ($prodetails['harga']*$prodetails['diskon']/100);
        } elseif($catdetails['diskon']>0) {
            $diskon_harga = $prodetails['harga'] - ($prodetails['harga']*$catdetails['diskon']/100);
        } else {
            $diskon_harga = 0;
        }
        return $diskon_harga;
    }

    public static function isproductnew($product_id){
        $product_ids = Product::select('id')->where('status', 1)->orderby('id', 'DESC')->limit(3)->pluck('id');
        $product_ids = json_decode($product_ids, true);
        // dd($product_ids);
        if(in_array($product_id, $product_ids)) {
            $isproductnew = "Yes";
        }else{
            $isproductnew = "No";
        }
        return $isproductnew;
    }
}
