<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductFilter;
use App\Models\ProductFilterValue;
use App\Models\Section;
use App\Models\Category;
use Illuminate\Http\Request;
use Session;
use DB;

class FilterController extends Controller
{
    public function filter()
    {
        Session::put('page', 'filter');
        $filters = ProductFilter::get()->toArray();
        // dd($filters);
        return view('admin.filter.filter')->with(compact('filters'));
    }

    public function filterValue()
    {
        Session::put('page', 'valueFilter');
        $filterValue = ProductFilterValue::get()->toArray();
        return view('admin.filter.filter_value')->with(compact('filterValue'));
    }
    public function updatefilterValueStatus(Request $request)
    {
        Session::put('page', 'filter');
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            ProductFilterValue::where('id', $data['filterValue_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'id'=>$data['filterValue_id']]);
        }
    }

    public function updatefilterStatus(Request $request)
    {
        Session::put('page', 'filter');
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            ProductFilter::where('id', $data['filter_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'id'=>$data['filter_id']]);
        }
    }

    public function addEditFilter(Request $request, $id=null)
    {
        if ($id=="") {
            $title = "Add Filter";
            $filter = New ProductFilter;
            $message = "Filter Added Succsessfully!";
        } else {
            $title = "Edit Filter";
            $filter = ProductFilter::find($id);
            $message = "Filter Updated Succsessfully!";
        }

        if($request->isMethod('POST')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $cat_ids = implode(',', $data['cat_id']);
            $filter->cat_id = $cat_ids;
            $filter->filter_nama = $data['filter_nama'];
            $filter->filter_column = $data['filter_column'];
            $filter->status = 1;
            $filter->save();

            // Add DB statement
            DB::statement('ALTER TABLE products ADD ' . $data['filter_column'] . ' varchar(255) AFTER deskripsi');

            return redirect('admin/filters')->with('succses_message', $message);
        }
        // get section with category and subcategory
        $category = Section::with('category')->get()->toArray();
        return view('admin.filter.add-edit-filter')->with(compact('title', 'filter', 'category'));
    }

    public function addEditFilterValue(Request $request, $id=null)
    {
        if ($id=="") {
            $title = "Add Category Value";
            $filterValue = New ProductFilterValue;
            $message = "Filter Value Added Succsessfully!";
        } else {
            $title = "Edit Category Value";
            $filterValue = ProductFilterValue::find($id);
            $message = "Filter Value Updated Succsessfully!";
        }

        if($request->isMethod('POST')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $filterValue->product_filter_id = $data['product_filter_id'];
            $filterValue->filter_value = $data['filter_value'];
            $filterValue->status = 1;
            $filterValue->save();

            return redirect('admin/filterValue')->with('succses_message', $message);
        }
        // get product filter
        $filter = ProductFilter::where('status', 1)->get()->toArray(); 
        return view('admin.filter.add-edit-filter-value')->with(compact('title', 'filterValue', 'filter'));
    }
}
