<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    public static function getCartItem(){
        if(Auth::check()){
            // pick auth user_id
            $getCartItem = Cart::with(['product'=>function($query){
                $query->select('id', 'category_id', 'nama', 'gambar');
            }])->orderBy('id', 'Desc')->where('user_id', Auth::user()->id)->get()->toArray();
        }else{
            // pick session_id
            $getCartItem = Cart::with(['product'=>function($query){
                $query->select('id', 'category_id', 'nama', 'gambar');
            }])->orderBy('id', 'Desc')->where('session_id', Session::get('session_id'))->get()->toArray();
        }
        return $getCartItem;
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
