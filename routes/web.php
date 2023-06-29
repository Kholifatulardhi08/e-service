<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\CategoryController;

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

        // manage Category
        Route::get('category', 'CategoryController@category');
        Route::post('admin/update-category-status', 'CategoryController@updateCategoryStatus');
    });
});

