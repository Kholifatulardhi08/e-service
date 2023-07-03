<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::get()->toArray();
        return view('admin.product.product')->with(compact('product'));
    }

    public function updateProductStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Product::where('id', $data['product_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'id'=>$data['product_id']]);
    }
    }

    public function delete($id)
    {
        Product::where('id', $id)->delete();
        $message = "Section delete successfully!";
        return redirect()->back()->with('succses_message', $message);
    }
}
