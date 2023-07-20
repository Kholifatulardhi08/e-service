<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ListeningController extends Controller
{
    public function listening(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            $url = $data['url'];
            $_GET['sort'] = $data['sort'];
        $categorycount = Category::where(['url'=>$url, 'status'=>1])->count();
        if ($categorycount>0) {
            $categorydetails = Category::categorydetails($url);
            $categoryproduct = Product::with('brand')->whereIn('category_id', $categorydetails['catid'])->where('status', 1);

            if(isset($data['EO']) && !empty($data['EO'])){
                $categoryproduct->whereIn('products.EO', $data['EO']);
            }

            if(isset($_GET['sort']) && !empty($_GET['sort'])){
                if($_GET['sort']=="terakhir"){
                    $categoryproduct->orderBy('products.id', "DESC");
                }elseif($_GET['sort']=="murah"){
                    $categoryproduct->orderBy('products.harga', "ASC");
                }elseif($_GET['sort']=="mahal"){
                    $categoryproduct->orderBy('products.harga', "DESC");
                }elseif($_GET['sort']=="a-z"){
                    $categoryproduct->orderBy('products.nama', "ASC");
                }elseif($_GET['sort']=="z-a"){
                    $categoryproduct->orderBy('products.nama', "DESC");
                }
            }
            $categoryproduct = $categoryproduct->paginate(3);
            // dd($categorydetails);
            return view('front.products.sort')->with(compact('categoryproduct', 'categorydetails', 'url'));
        } else {
            abort(404);
        }
        }else{
            $url = Route::getFacadeRoot()->current()->uri();
        $categorycount = Category::where(['url'=>$url, 'status'=>1])->count();
        if ($categorycount>0) {
            $categorydetails = Category::categorydetails($url);
            $categoryproduct = Product::with('brand')->whereIn('category_id', $categorydetails['catid'])->where('status', 1);
            if(isset($_GET['sort']) && !empty($_GET['sort'])){
                if($_GET['sort']=="terakhir"){
                    $categoryproduct->orderBy('products.id', "DESC");
                }elseif($_GET['sort']=="murah"){
                    $categoryproduct->orderBy('products.harga', "ASC");
                }elseif($_GET['sort']=="mahal"){
                    $categoryproduct->orderBy('products.harga', "DESC");
                }elseif($_GET['sort']=="a-z"){
                    $categoryproduct->orderBy('products.nama', "ASC");
                }elseif($_GET['sort']=="z-a"){
                    $categoryproduct->orderBy('products.nama', "DESC");
                }
            }
            $categoryproduct = $categoryproduct->paginate(3);
            return view('front.products.listening')->with(compact('categoryproduct', 'categorydetails', 'url'));
        } else {
            abort(404);
        }
        }
    }
}
