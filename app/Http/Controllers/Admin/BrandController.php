<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Models\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        Session::put('page', 'brands');
        $brands = Brand::get()->toArray();
        return view('admin.brand.brand')->with(compact('brands'));
    }

    public function updateBrandStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Brand::where('id', $data['brand_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'id'=>$data['brand_id']]);
        }
    }

    public function add_edit_brand(Request $request, $id=null)
    {
        Session::put('page', 'brands');
        if ($id=="") {
            $title = "Add Brand";
            $brands = new Brand;
            $message = "Brand add successfully!";
        }else{
            $title = "Edit Brand";
            $brands = Brand::find($id);
            $message = "Brand Updated successfully!";
        }
        if ($request->isMethod('POST')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $rules = [
                'nama' => 'required',
            ];
            $customMessages = [
                'nama.required' => 'Name is required',
            ];

            $this->validate($request, $rules, $customMessages);

            $brands->nama = $data['nama'];
            $brands->status = 1;
            $brands->save();

            return redirect('admin/brands')->with('succses_message', $message);
        }
        return view('admin.brand.add_edit_brand')->with(compact('title', 'brands', 'message'));
    }

    public function delete($id)
    {
        Brand::where('id', $id)->delete();
        $message = "Brand delete successfully!";
        return redirect()->back()->with('succses_message', $message);
    }
}
