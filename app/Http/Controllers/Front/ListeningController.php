<?php

namespace App\Http\Controllers\Front;

use DOMXPath;
use DOMDocument;
use Goutte\Client;
use App\Models\Cart;
use App\Models\Rating;
use App\Models\Product;
use App\Models\Category;
use App\Models\Crawling;
use App\Models\Penyedia;
use Illuminate\Http\Request;
use App\Models\ProductFilter;
use App\Models\ProductAtribute;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Symfony\Component\DomCrawler\Crawler;

class ListeningController extends Controller
{
    private $result = array();
    
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

    public function search(Request $request)
    {
        if (isset($_REQUEST['search']) && !empty($_REQUEST['search'])) {
            $search_product = $_REQUEST['search'];
            $categorydetails['breadcum'] = $_REQUEST['search'];
            $categorydetails['categorydetails']['nama'] = $search_product;
            $categorydetails['categorydetails']['deskripsi'] = "Search For Produk" . $search_product;
        
            // Tampilkan data dari Product sesuai dengan search_product menggunakan query builder
            $categoryproduct = Product::with('brand')
                ->select('products.id', 'products.nama', 'products.harga', 'products.gambar', 'products.deskripsi')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->where(function ($query) use ($search_product) {
                    $query->where('products.nama', 'like', '%' . $search_product . '%')
                        ->orWhere('products.harga', 'like', '%' . $search_product . '%')
                        ->orWhere('products.deskripsi', 'like', '%' . $search_product . '%')
                        ->orWhere('categories.nama', 'like', '%' . $search_product . '%')
                        ->orWhere('categories.url', 'like', '%' . $search_product . '%');
                })
                ->where('products.status', 1)
                ->get();
        
            // Hitung nilai maksimum dan minimum harga
            $maxHarga = $categoryproduct->max('harga');
            $minHarga = $categoryproduct->min('harga');
        
            // Normalisasi harga untuk setiap produk
            $categoryproduct->transform(function ($product) use ($maxHarga, $minHarga) {
                $product->normalized_harga = ($product->harga - $minHarga) / ($maxHarga - $minHarga);
                return $product;
            });
        
            // Hitung bobot kriteria (hanya harga)
            $weightHarga = 1; // Karena hanya ada satu kriteria
            $categoryproduct->transform(function ($product) use ($weightHarga) {
                $product->weighted_harga = $product->normalized_harga * $weightHarga;
                return $product;
            });
        
            // Hitung skor relatif
            $relativeScores = [];
            foreach ($categoryproduct as $product) {
                $relativeScores[$product->id] = $product->weighted_harga;
            }
        
            // Urutkan produk berdasarkan skor relatif (TOPSIS)
            arsort($relativeScores);
        
            // Ambil urutan ID produk berdasarkan skor relatif
            $sortedProductIds = array_keys($relativeScores);
        
            // Ambil data produk yang diurutkan sesuai dengan urutan skor relatif
            $sortedProducts = $categoryproduct->whereIn('id', $sortedProductIds)->values();
            // dd($sortedProducts);
        
            // proses crawling data
                    if ($categoryproduct->isEmpty()) {
                        $baseUrl = 'https://www.sejasa.com/mitra-kami/';
                        $search_product_encoded = str_replace(' ', '-', $search_product);
                        $search_product_encoded = urlencode($search_product_encoded);
                        $currentPage = 1;
                        $maxPage = 2; // Jumlah halaman yang ingin diambil
                        $productDataList = [];
                    
                        do {
                            $url = $baseUrl . $search_product_encoded . '?page='. $currentPage;
                            $file = @file_get_contents($url);
                            
                            if ($file === false) {
                                $error_message = "Sorry, the product you're looking for is not available.";
                                return view('front.products.not_found')->with(compact('error_message'));
                            }                    
                            
                            $dom = new DOMDocument();
                            @$dom->loadHTML($file);
                            if (@$dom->loadHTML($file) === false) {
                                $error_message = "Sorry, the product you're looking for is not available.";
                                return view('front.products.not_found')->with(compact('error_message'));
                            }
        
                            $xpath = new DOMXPath($dom);
                    
                            // Mengambil data produk dari halaman paginasi
                            $productElements = $xpath->query('//div[@class="js-result result-search__box--mitrakami content-wrap p-0 mt-4 overflow-hidden"]');
                            if ($productElements->length === 0) {
                                echo "Maaf, hasil pencarian tidak ditemukan dalam cakupan.";
                                break;
                            }                        
                            foreach ($productElements as $productElement) {
                                $productData = [];
                                
                                $productData['url_asli'] = $url;
                    
                                // Mengambil data nama website
                                $websiteElement = $xpath->query('//a[@class="navbar-new__brand"]/img')->item(0);
                                if ($websiteElement) {
                                    $websiteAlt = $websiteElement->getAttribute('alt');
                                    $websiteName = substr($websiteAlt, 0, strpos($websiteAlt, '.com') + 4);
                                    $productData['website'] = $websiteName;
                                }
                    
                                $nama_produkElement = $xpath->query('.//div[@class="profile-area__desc"]/a/h2[@class="profile-area__desc--name"]', $productElement)->item(0);
                                if ($nama_produkElement) {
                                    $nama_produk = $nama_produkElement->textContent;
                                    $productData['nama_produk'] = $nama_produk;
                                } else {
                                    echo "Nama produk tidak ditemukan.";
                                }
                                
                                $reviewElement = $xpath->query('.//div[@class="profile-area__desc--review"]', $productElement)->item(0);
                                if ($reviewElement) {
                                    $ratingValue = $reviewElement->textContent;
                                    $productData['rating'] = $ratingValue;
                                } else {
                                    echo "Data tidak ditemukan.";
                                }
        
                                // Menyimpan kategori ke dalam daftar
                                $productData['category'] = $search_product_encoded;
                                
                                // Mengambil URL gambar
                                $imgElement = $xpath->query('//div[@class="profile-area__picture"]/img')->item(0);
                                if ($imgElement) {
                                    $imgSrc = $imgElement->getAttribute('src');
                                    $productData['gambar_url'] = $imgSrc;
                                } else {
                                    echo "Data tidak ditemukan.";
                                }
        
                                // Tambahkan data ke dalam daftar
                                $productDataList[] = $productData;
                            }
                            $currentPage++;
                        } while ($currentPage <= $maxPage);
                        
                        // Pengecekan apakah data $search_product sudah pernah disimpan
                        $existingProduct = Crawling::where('nama_produk', $search_product)->first();
                        if (!$existingProduct) {
                            // Simpan data ke database menggunakan model Crawler
                            foreach ($productDataList as $productData) {
                                $crawledProduct = new Crawling;
                                $crawledProduct->url = $productData['url_asli'];
                                $crawledProduct->website = $productData['website'];
                                $crawledProduct->nama_produk = $productData['nama_produk'];
                                $crawledProduct->rating = $productData['rating'];
                                $crawledProduct->gambar_url = $productData['gambar_url'];
                                $crawledProduct->category = urldecode($productData['category']); // Decode URL-encoded category
                                $crawledProduct->save();
                            }
                        }
                    }
            
            // Tampilkan data dari Crawler sesuai dengan search_product menggunakan query builder
            $crawledProducts = Crawling::where('nama_produk', 'like', '%' . $search_product . '%')
                ->orWhere('category', 'like', '%' . $search_product . '%')
                ->get();
        
            return view('front.products.search')->with(compact('sortedProducts', 'categorydetails', 'crawledProducts'));
        }
    }

    public function detailproduct($id)
    {
            $product = Product::with('penyedia', 'category', 'section', 'brand', 'attribute', 'image')->find($id)->toArray();
            $categorydetails = Category::categorydetails($product['category']['url']);

            $totalStock = ProductAtribute::where('product_id', $id)->sum('stock');

            $rating = Rating::with('user')->where(['product_id' => $id, 'status' => 1])->get()->toArray();
            $ratingsum = Rating::where(['product_id' => $id, 'status' => 1])->sum('rating');
            $ratingcount = Rating::where(['product_id' => $id, 'status' => 1])->count();
            
            $rating1count = Rating::where(['product_id' => $id, 'status' => 1, 'rating'=>1])->count();
            $rating2count = Rating::where(['product_id' => $id, 'status' => 1, 'rating'=>2])->count();
            $rating3count = Rating::where(['product_id' => $id, 'status' => 1, 'rating'=>3])->count();
            $rating4count = Rating::where(['product_id' => $id, 'status' => 1, 'rating'=>4])->count();
            $rating5count = Rating::where(['product_id' => $id, 'status' => 1, 'rating'=>5])->count();

            $avgRating = 0;
            $avgStar = 0;
            if ($ratingcount > 0) {
                $avgRating = round($ratingsum / $ratingcount, 2);
                $avgStar = round($ratingsum / $ratingcount);
            }

            $similiarproduct = Product::with('brand')
                ->where('category_id', $product['category']['id'])
                ->where('id', '!=', $id)
                ->limit(4)
                ->inRandomOrder()
                ->get()
                ->toArray();

            return view('front.products.product_details')->with(compact('avgRating', 'avgStar', 'rating', 'product', 'categorydetails', 'similiarproduct', 'totalStock',
            'rating1count', 'rating2count', 'rating3count', 'rating4count', 'rating5count'));
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
