<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductFilter;
use App\Models\ProductFilterValue;
use Illuminate\Http\Request;
use Session;

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
}
