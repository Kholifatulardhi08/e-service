<?php

namespace App\Http\Controllers\Admin;

use Session;
use Auth;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Section;
use App\Models\Brand;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        Session::put('page', 'products');
        $product = Product::with(['category'=>function($query){
            $query->select('id', 'nama');
        }, 'section'=>function($query){
            $query->select('id', 'nama');
        }])->get()->toArray();
        // dd($product);
        return view('admin.product.product')->with(compact('product'));
    }

    public function updateProductStatus(Request $request)
    {
        if($request->ajax())
        {
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

    public function add_edit_product(Request $request, $id=null,)
    {
        Session::put('page', 'products');
        if($id==""){
            $title = "Add Product";
            $product = new Product;
            $message = "Product Added Sussecfully!";
        }else{
            $title = "Edit Product";
            $product = Product::find($id);
            $message = "Product Updated Sussecfully!";
        }
        if($request->isMethod('POST'))
        {
            $data = $request->all();
            $rules = [
                'nama' => 'required',
            ];
            $customMessages = [
                'nama.required' => 'Name is required',
            ];

            $this->validate($request, $rules, $customMessages);

            
            // ADD STR_randomcode
        $code = Str::upper(Str::random(7, 'alpha_num'));
        // save product detail in product 
        $categoryDetails = Category::find($data['category_id']);
        $product->section_id = $categoryDetails['section_id'];
        $product->category_id = $data['category_id'];
        $product->brand_id = $data['brand_id'];
        // input for pembuat menggunakan AUTH
        $admin_type = Auth::guard('admin')->user()->type;
        $penyedia_id = Auth::guard('admin')->user()->penyedia_id;
        $admin_id = Auth::guard('admin')->user()->id;
        if($admin_type=="penyedia") {
            $product->penyedia_id = $penyedia_id;
        } else {
            $product->penyedia_id = 0;
        }
        
        $product->type = $admin_type;
        $product->admin_id = $admin_id;
        $product->penyedia_id = $penyedia_id;
        $product->product_code = $code;
        $product->nama = $data['nama'];
        $product->deskripsi = $data['deskripsi'];
        $product->harga = $data['harga'];
        $product->diskon = $data['diskon'];
        $product->harga = $data['harga'];
        $product->meta_title = $data['meta_title'];
        $product->meta_description = $data['meta_description'];
        $product->meta_keywords = $data['meta_keywords'];

        if(!empty($data['is_featured'])){
            $product->is_featured = $data['is_featured'];
        } else {
            $product->is_featured = "No";
        }

        $product->status = 1;
        $product->save();
        
        return redirect('admin/products')->with('succses_message', $message);

        }
        // get section with category and subcategory
        $category = Section::with('category')->get()->toArray();
        // get brand
        $brand = Brand::where('status', 1)->get()->toArray();
        return view('admin.product.add_edit_product')->with(compact('title', 'product', 'category', 'brand'));
    }
    
    public function delete($id)
    {
        Product::where('id', $id)->delete();
        $message = "Section delete successfully!";
        return redirect()->back()->with('succses_message', $message);
    }
}
