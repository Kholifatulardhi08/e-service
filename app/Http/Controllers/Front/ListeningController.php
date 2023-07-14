<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class ListeningController extends Controller
{
    public function listening()
    {
        $url = Route::getFacadeRoot()->current()->uri();
        $categorycount = Category::where(['url'=>$url, 'status'=>1])->count();
        if ($categorycount>0) {
            $categorydetails = Category::categorydetails($url);
            // echo "Category exist"; die;
            dd($categorydetails);
        } else {
            abort(404);
        }
        
    }
}
