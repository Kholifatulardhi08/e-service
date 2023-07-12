<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Section;
use App\Models\penyedia;
use App\Models\ProductAtribute;
use App\Models\Images;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->select('id', 'nama');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
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
}
