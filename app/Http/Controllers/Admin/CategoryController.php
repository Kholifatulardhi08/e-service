<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function category()
    {
        Session::put('page', 'categories');
        $category = Category::with(['section', 'parentCategory'])->get()->toArray();
        // dd($category);
        return view('admin.category.category')->with(compact('category'));
    }

    public function updateCategoryStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Category::where('id', $data['categories_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'id'=>$data['categories_id']]);
        }
    }
}
