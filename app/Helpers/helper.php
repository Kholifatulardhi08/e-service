<?php
use App\Models\Cart;
    function totalCartItem()
    {
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $totalCartItem = Cart::where('user_id', $user_id)->sum('quantity');
        }else{
            $session_id = Session::get('session_id');
            $totalCartItem = Cart::where('session_id', $session_id)->sum('quantity');
        }
        return $totalCartItem;
    }

    function getCartItem(){
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
?>