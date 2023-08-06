<?php

namespace App\Http\Controllers\Front;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use App\Models\Penyedia;
use Illuminate\Http\Request;
use App\Models\ProductFilter;
use App\Models\ProductAtribute;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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
            if(isset($data['event']) && !empty($data['event'])){
                $categoryproduct->whereIn('products.event', $data['event']);
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

            $getProductid = array();
            if(isset($data['price']) && !empty($data['price'])){
                foreach($data['price'] as $key => $price){
                    $priceArr = explode("-", $price);
                    if(isset($priceArr[0]) && isset($priceArr[1])){
                        $getProductid[] = Product::select('id')->whereBetween('harga', [$priceArr[0], $priceArr[1]])->pluck('id')->toArray();
                    }
                }
                $getProductid = array_unique(array_flatten($getProductid));
                // $getProductid = call_user_func_array('array_merge', $getProductid);
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
            if (isset($_REQUEST['search']) && !empty($_REQUEST['search'])) {
                $search_product = $_REQUEST['search'];
                $categorydetails['breadcum'] = $_REQUEST['search'];
                $categorydetails['categorydetails']['nama'] = $search_product;
                $categorydetails['categorydetails']['deskripsi'] = "Search For Produk". $search_product ;
                $categoryproduct = Product::select('products.*')->with('brand')->join('categories', 'categories.id', 
                '=', 'products.category_id')->where(function($query)use($search_product){
                $query->where('products.nama', 'like', '%'. $search_product.'%')
                ->orWhere('products.harga', 'like', '%'. $search_product.'%')
                ->orWhere('products.deskripsi', 'like', '%'. $search_product.'%')
                ->orWhere('categories.nama', 'like', '%'. $search_product.'%');
                })->where('products.status', 1);
                $categoryproduct = $categoryproduct->get()->toArray();
                // dd($categoryproduct);
                return view('front.products.listening')->with(compact('categoryproduct', 'categorydetails'));                    
            } else {
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
    }

    public function detailproduct($id)
    {
        $product = Product::with('penyedia' ,'category', 'section', 'brand', 'attribute', 'image')->find($id)->toArray();
        $categorydetails = Category::categorydetails($product['category']['url']);
        // dd($product);

        $totalStock = ProductAtribute::where('product_id', $id)->sum('stock');

        // Get similiar product
        $similiarproduct = Product::with('brand')->where('category_id', $product['category']['id'])->where('id', '!=', $id)->limit(4)->inRandomOrder()->get()->toArray();
        // dd($similiarproduct);
        return view('front.products.product_details')->with(compact('product', 'categorydetails', 'similiarproduct', 'totalStock'));
    }

    public function getProductharga(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            $hargaattribute = Product::hargaattribute($data['product_id'], $data['paket']);
            return $hargaattribute;
        }
    }

    public function jasadetails($penyedia_id)
    {
        $jasadetails = Penyedia::jasadetails($penyedia_id);
        $penyediaproduct = Product::with('brand')->where('penyedia_id', $penyedia_id)->Where('status', 1);
        $penyediaproduct = $penyediaproduct->paginate(10);
        return view('front.products.toko')->with(compact('jasadetails', 'penyediaproduct'));
    }

    public function addTocart(Request $request)
    {
        if($request->isMethod('POST')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $session_id = Session::get('session_id');
            if(empty($session_id)){
                $session_id = Session::getId();
                Session::put('session_id', $session_id);
            }

            // get stock is available
            $isStockReady = ProductAtribute::isStockReady($data['product_id'], $data['paket']);
            if($isStockReady<$data['quantity']){
                return redirect()->back()->with('error_message', 'Required quantity is not Avaibale!');
            }
            
            // if cart ready in user cart
            if(Auth::check()){
                $user_id = Auth::guard()->user()->id;
                $countProducts = Cart::where(['product_id'=>$data['product_id'], 'paket'=>$data['paket'], 'user_id'=>$user_id])->count();
            }else{
                $user_id = 0;
                $countProducts = Cart::where(['product_id'=>$data['product_id'], 'paket'=>$data['paket'], 'session_id'=>$session_id])->count();
            }

            if($countProducts > 0){
                return redirect()->back()->with('error_message', 'Product Already exists in cart!');
            }

            $item = New Cart;
            $item->session_id = $session_id;
            $item->user_id = $user_id;
            $item->product_id = $data['product_id'];
            $item->paket = $data['paket'];
            $item->quantity = $data['quantity'];
            $item->save();
            return redirect()->back()->with('succses_message', 'Product has been added in Cart! <a href="/cart">View Cart</a>');
        }
    }

    public function cart()
    {
        $getCartItem = Cart::getCartItem();
        // dd($getCartItem);
        return view('front.products.cart.cart')->with(compact('getCartItem'));
    }

    public function updateCart(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>", print_r($data); die;
            $getcartdetail = Cart::find($data['cartid']);

            // check available stock
            $avaiablestock = ProductAtribute::select('stock')->where(['product_id'=>$getcartdetail['product_id'], 'paket'=>$getcartdetail['paket']])->first()->toArray();
            // echo "<pre>"; print_r($avaiablestock); die;
            if($data['qty']>$avaiablestock['stock']){
                $getCartItem = Cart::getCartItem();
                return response()->json([
                    'status'=>false,
                    'message' => 'Product Stock is not Available',
                    'view'=>(String)View::make('front.products.cart.cart_items')->with(compact('getCartItem')),
                    'cartmini'=>(String)View::make('front.layouts.header_cart_item')->with(compact('getCartItem'))
                ]);
            }

            // check product paket is available
            $availablepaket = ProductAtribute::where(['product_id'=>$getcartdetail['product_id'], 'paket'=>$getcartdetail['paket'], 'status'=>1])->count();
            if($availablepaket==0){
                $getCartItem = Cart::getCartItem();
                return response()->json([
                    'status'=>false,
                    'message' => 'Product Paket is not Available, chooice another paket!',
                    'view'=>(String)View::make('front.products.cart.cart_items')->with(compact('getCartItem')),
                    'cartmini'=>(String)View::make('front.layouts.header_cart_item')->with(compact('getCartItem'))
                ]);   
            }

            Cart::where('id', $data['cartid'])->update(['quantity'=>$data['qty']]);
            $getCartItem = Cart::getCartItem();
            $totalCartItem = totalCartItem();
            return response()->json([
                'status'=>true,
                'totalCartItem'=>$totalCartItem,
                'view'=>(String)View::make('front.products.cart.cart_items')->with(compact('getCartItem')),
                'cartmini'=>(String)View::make('front.layouts.header_cart_item')->with(compact('getCartItem'))
            ]);
        }
    }

    public function deletecart(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>", print_r($data); die;
            Cart::where('id', $data['cartid'])->delete();
            $getCartItem = Cart::getCartItem();
            $totalCartItem = totalCartItem();
            return response()->json([
                'totalCartItem'=>$totalCartItem,
                'view'=>(String)View::make('front.products.cart.cart_items')->with(compact('getCartItem')),
                'cartmini'=>(String)View::make('front.layouts.header_cart_item')->with(compact('getCartItem'))
            ]);
        }
    }

}
