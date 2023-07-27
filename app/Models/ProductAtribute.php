<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAtribute extends Model
{
    use HasFactory;

    public static function isStockReady($product_id, $paket)
    {
        $isStockReady = ProductAtribute::select('stock')->where(['product_id'=>$product_id, 'paket'=>$paket])->first();
        return $isStockReady->stock;
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
