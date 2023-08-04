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
       $product = Product::with('penyedia' ,'category', 'section', 'brand', 'attribute', 'image')->orderBy('id', 'desc')->where('status', 1)->get()->toArray();
       $bestseller = Product::where(['is_bestseller'=>'Yes', 'status'=>1])->inRandomOrder()->get()->toArray();
       $diskonproduct = Product::with('penyedia')->orderBy('id', 'desc')->where('diskon', '>', 0)->orWhere('status', 1)->limit(8)->inRandomOrder()->get()->toArray();
       $featured = Product::with('penyedia')->where(['is_featured'=>'Yes', 'status'=>1])->inRandomOrder()->limit(8)->get()->toArray();
       return view('front.index')->with(compact('banners', 'fixbanners', 'product', 'bestseller', 'diskonproduct', 'featured')); 
    }
}
