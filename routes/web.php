<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Front\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\Admin\FilterController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Front\PenyediaController;
use App\Http\Controllers\Front\ListeningController;
use App\Http\Controllers\Front\RatingController;
use App\Http\Controllers\Admin\OrderController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Route ADMIN
Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group( function() {
    Route::match(['get', 'post'], 'login', 'AdminController@login');
    Route::group(['middleware'=>['admin']], function(){
        // Logout Admin
        Route::get('logout', 'AdminController@logout');
        // update status admin
        Route::post('admin/update-admin-status', 'AdminController@updateAdminStatus');

        //  Admin Update pass && details
        Route::post('check_current_password', 'AdminController@check_current_password');
        Route::match(['get', 'post'], 'update_admin_password', 'AdminController@update_admin_password');
        Route::match(['get', 'post'], 'update_admin_details', 'AdminController@update_admin_details');
        Route::get('dashboard', 'AdminController@dashboard');

        // Penyedia Update details
        Route::match(['get', 'post'], 'update_penyedia_details/{slug}', 'AdminController@update_penyedia_details');

        // manage user, admin && penyedia
        Route::get('admins/{type?}', 'AdminController@admins');
        Route::get('view_penyedia_details/{id}', 'AdminController@view_penyedia_details');

        // manage Section
        Route::get('section', 'SectionController@section');
        Route::get('delete-section/{id}', 'SectionController@delete');
        Route::match(['get', 'post'], 'add-edit-section/{id?}', 'SectionController@add_edit_section');
        Route::post('admin/update-section-status', 'SectionController@updateSectionStatus');

        // manage Category
        Route::get('category', 'CategoryController@category');
        Route::post('admin/update-category-status', 'CategoryController@updateCategoryStatus');
        Route::match(['get', 'post'], 'add-edit-category/{id?}', 'CategoryController@addEditCategory');
        Route::get('admin/append-category-level', 'CategoryController@appendcategorylevel');
        Route::get('delete-categories/{id}', 'CategoryController@delete');
        Route::get('delete-category-image/{id}', 'CategoryController@deleteimage');

        // Manage Brand
        Route::get('brands', 'BrandController@index');
        Route::get('delete-brand/{id}', 'BrandController@delete');
        Route::match(['get', 'post'], 'add-edit-brand/{id?}', 'BrandController@add_edit_brand');
        Route::post('admin/update-brand-status', 'BrandController@updateBrandStatus');
    
        // Manage Product
        Route::get('products', 'ProductController@index');
        Route::get('delete-product/{id}', 'ProductController@delete');
        Route::post('admin/update-product-status', 'ProductController@updateProductStatus');
        Route::match(['get', 'post'], 'add-edit-product/{id?}', 'ProductController@addEditProduct');
        Route::get('delete-product-gambar/{id}', 'ProductController@deleteProductImage');

        // Manage Atribut product
        Route::match(['get', 'post'], 'add-edit-atribute/{id?}', 'ProductController@addAtributeProduct');
        Route::post('update-attribute-status', 'ProductController@updateAtrributeStatus');
        Route::get('delete-atrribute/{id}', 'ProductController@deleteattribute');
        Route::match(['get', 'post'], 'edit-atribute/{id}', 'ProductController@editAttribute');
        
        // Get Image in product
        Route::match(['get', 'post'], 'add-image/{id}', 'ProductController@addImage');
        Route::post('update-images-status', 'ProductController@updateStatusImage');
        Route::get('delete-images/{id}', 'ProductController@deleteimages');
        
        // Get Banner Controller
        Route::get('banners', 'BannerController@index');
        Route::post('update-banner-status', 'BannerController@updatebannerstatus');
        Route::get('delete-banner/{id}', 'BannerController@deletebanner');
        Route::match(['get', 'post'], 'add-edit-banner/{id?}', 'BannerController@addEditBanner');

        // GetFilter && filter value
        Route::get('filters', 'FilterController@filter');
        Route::post('update-filter-status', 'FilterController@updatefilterStatus');
        Route::match(['get', 'post'], 'add-edit-filter/{id?}', 'FilterController@addEditFilter');
        Route::post('category-filters', 'FilterController@filtercategory');
        Route::get('delete-filter/{id}', 'FilterController@deleteFilter');

        Route::get('filterValue', 'FilterController@filterValue');
        Route::post('update-filterValue-status', 'FilterController@updatefilterValueStatus');
        Route::match(['get', 'post'], 'add-edit-filtervalue/{id?}', 'FilterController@addEditFilterValue');
        Route::get('delete-filterValue/{id}', 'FilterController@deleteFilterValue');

        // get users
        Route::get('penyewa', 'PenyewaController@index');
        Route::post('admin/update-penyewa-status', 'PenyewaController@updatePenyewaStatus');

        // Get Order
        Route::get('orders', 'OrderController@order');
        Route::get('orders/{id}', 'OrderController@orderDetails');
        Route::post('update-order-status', 'OrderController@updateorder');
        Route::post('update-order-item-status', 'OrderController@itemorderupdate');

        // invoice
        Route::get('orders/invoice/{id}', 'OrderController@invoice');
        Route::get('orders/invoice/pdf/{id}', 'OrderController@cetakpdf');

        // Rating
        Route::get('ratings', 'OrderController@ratings');
        Route::post('update-rating-status', 'OrderController@updateRatingStatus');
        Route::get('delete-ratings/{id}', 'OrderController@deleteRating');
        
    });
});

// Route Front
Route::namespace('App\Http\Controllers\Front')->group( function(){
    Route::get('/', 'IndexController@index');

    // listenig for route url
    $caturls = Category::select('url')->where('status', 1)->get()->pluck('url')->toArray();
    foreach ($caturls as $key => $url) {
        Route::match(['get', 'post'], '/'.$url, 'ListeningController@listening');
    }
    // product detail by id
    Route::get('product/{id}', 'ListeningController@detailproduct');
    Route::get('products/{penyedia_id}', 'ListeningController@jasadetails');

    // Vendor/Login/Register
    Route::get('penyedia/login-register', 'PenyediaController@loginregister');
    Route::post('penyedia/register', 'PenyediaController@register');
    Route::get('penyedia/confirm/{code}', 'PenyediaController@confirmpenyedia'); 

    Route::post('get-product-harga', 'ListeningController@getProductharga');

    // get cart
    Route::post('cart/add', 'ListeningController@addTocart');
    Route::get('cart', 'ListeningController@cart');
    Route::post('/update-cart', 'ListeningController@updateCart');
    Route::post('/delete-cart', 'ListeningController@deleteCart');

    // get user penyewa
    Route::get('penyewa/login-register', ['as'=>'login','uses'=>'UserController@loginregister']);
    Route::post('penyewa/register', 'UserController@register');
    Route::post('penyewa/login', 'UserController@login');
    Route::get('penyewa/confirm/{code}', 'UserController@confirmpenyewa');
    Route::post('update-password', 'UserController@updatepassword');
    Route::match(['get', 'post'], 'lupa-password', 'UserController@lupapassword');
    // search function
    Route::get('search-products', 'ListeningController@search');

    // Add Rating
    Route::post('add-rating', 'RatingController@addRating');

    Route::middleware('auth')->group(function () {
        // Semua rute dalam grup ini memerlukan pengguna yang sudah login     
        Route::get('penyewa/logout', 'UserController@logout');
        // setting account
        Route::match(['get', 'post'], 'setting-account', 'UserController@account');

        // setting checkout 
        Route::match(['get', 'post'], 'checkout', 'UserController@checkout');

        // route for edit address
        Route::post('/get-delivery-address', 'UserController@editDelivery');
        Route::post('/save-delivery-address', 'UserController@saveDelivery');
        Route::post('/delete-delivery-address', 'UserController@deleteDelivery');

        // thanks page for order
        Route::get('thanks', 'UserController@thanks');

        // order by users
        Route::get('orders/{id?}', 'UserController@order');

    });
});
