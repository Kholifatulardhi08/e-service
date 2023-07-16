<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ListeningController extends Controller
{
    public function listening()
    {
        $url = Route::getFacadeRoot()->current()->uri();
        $categorycount = Category::where(['url'=>$url, 'status'=>1])->count();
        if ($categorycount>0) {
            $categorydetails = Category::categorydetails($url);
            $categoryproduct = Product::with('brand')->whereIn('category_id', $categorydetails['catid'])->where('status', 1)->paginate(3);
            // dd($categorydetails);
            return view('front.products.listening')->with(compact('categoryproduct', 'categorydetails'));
        } else {
            abort(404);
        }
    }
}
