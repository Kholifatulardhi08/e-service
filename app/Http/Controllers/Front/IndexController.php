<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Banner;

class IndexController extends Controller
{
    public function index()
    {
       $banners = Banner::where('status', 1)->get()->toArray();
       $fixbanners = Banner::where('type', 'Fix')->orWhere('status', 1)->get()->toArray();
       $product = Product::orderBy('id', 'desc')->where('status', 1)->limit(8)->get()->toArray();
       $bestseller = Product::where(['is_bestseller'=>'Yes', 'status'=>1])->inRandomOrder()->get()->toArray();
       return view('front.index')->with(compact('banners', 'fixbanners', 'product', 'bestseller')); 
    }
}
