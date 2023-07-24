<?php

namespace App\Http\Controllers\Front;

use App\Models\ProductFilter;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductAtribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

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

            $productfilter = ProductFilter::productFilters();
            foreach ($productfilter as $key => $filter) {
                if(isset($filter['filter_column']) && isset($data[$filter['filter_column']]) 
                    && !empty($filter['filter_column']) && !empty($data[$filter['filter_column']])){
                    $categoryproduct->whereIn($filter['filter_column'], $data[$filter['filter_column']]);  
                }
            }
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

            
            if(isset($data['paket']) && !empty($data['paket'])){
                $getProductid = ProductAtribute::select('product_id')->whereIn('paket', $data['paket'])->pluck('product_id')->toArray();
                $categoryproduct->whereIn('products.id', $getProductid);
            }

            if(isset($data['price']) && !empty($data['price'])){
                foreach($data['price'] as $key => $price){
                    $priceArr = explode("-", $price);
                    $getProductid[] = Product::select('id')->whereBetween('harga', [$priceArr[0], $priceArr[1]])->pluck('id')->toArray();
                }
                $getProductid = call_user_func_array('array_merge', $getProductid);
                // echo "<pre>"; print_r($getProductid); die;
                $categoryproduct->whereIn('products.id', $getProductid);
            }

            if(isset($data['brand']) && !empty($data['brand'])){
                $getProductid = Product::select('id')->whereIn('brand_id', $data['brand'])->pluck('id')->toArray();
                $categoryproduct->whereIn('products.id', $getProductid);
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

            $categoryproduct = $categoryproduct->paginate(5);
            return view('front.products.listening')->with(compact('categoryproduct', 'categorydetails', 'url'));
        } else {
            abort(404);
        }
        }
    }

    public function detailproduct($id)
    {
        $product = Product::with('category', 'section', 'brand', 'attribute', 'image')->find($id)->toArray();
        $categorydetails = Category::categorydetails($product['category']['url']);
        // dd($product);
        return view('front.products.product_details')->with(compact('product', 'categorydetails'));
    }

}
