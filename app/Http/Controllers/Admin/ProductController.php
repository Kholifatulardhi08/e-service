<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Session;
use App\Models\Brand;
use App\Models\Images;
use App\Models\Product;
use App\Models\Section;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductFilter;
use App\Models\ProductAtribute;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index()
    {
        Session::put('page', 'products');
        $adminType  = Auth::guard('admin')->user()->type;
        $penyedia_id  = Auth::guard('admin')->user()->penyedia_id;
        if($adminType=="penyedia"){
            $penyediaStatus = Auth::guard('admin')->user()->status;
            if ($penyediaStatus==0) {
                return redirect('admin/update_admin_details')->with('error_message', 'Vendor Account ist not approved!');
            }
        }
        $product = Product::with(['category'=>function($query){
            $query->select('id', 'nama');
        }, 'section'=>function($query){
            $query->select('id', 'nama');
        }]);
        if ($adminType=="penyedia") {
            $product = $product->where('penyedia_id', $penyedia_id);
        }
        $product = $product->get()->toArray();
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

    public function addEditProduct(Request $request, $id=null)
    {
        Session::put('page', 'products');
        if($id=="") {
            $title = "Add Product";
            $product = new Product;
            $message = "Product Added Successfully!";
        } else {
            $title = "Edit Product";
            $product = Product::find($id);
            $message = "Product Updated Successfully!";    
        }

        if($request->isMethod('POST')){
            $data = $request->all();
            
            if($data['diskon']==""){
                $data['diskon'] = 0;
            }
            // save photo to database
            if ($request->hasFile('gambar')) {
                $img_tmp = $request->file('gambar');
                if($img_tmp->isValid()){
                    $extension = $img_tmp->getClientOriginalExtension();
                    $image_name = rand(111,9999).'.'.$extension;
                    $imagePathLarge = 'template/images/Photo/Product/Large/'.$image_name;
                    $imagePathMedium = 'template/images/Photo/Product/Medium/'.$image_name;
                    $imagePathSmall = 'template/images/Photo/Product/Small/'.$image_name;
                    Image::make($img_tmp)->resize(1000, 1000)->save($imagePathLarge);
                    Image::make($img_tmp)->resize(500, 500)->save($imagePathMedium);
                    Image::make($img_tmp)->resize(255, 255)->save($imagePathSmall);
    
                    $product->gambar = $image_name;
                }
            }
                $categoryDetails = Category::find($data['category_id']);
                $product->section_id = $categoryDetails['section_id'];
                $product->category_id = $data['category_id'];
                $product->brand_id = $data['brand_id'];

                $productfilter = ProductFilter::productFilters();
                foreach($productfilter as $filter){
                    $filterAvailable = ProductFilter::filterAvailable($filter['id'], $data['category_id']);
                    if(isset($filter['filter_column']) && $data[$filter['filter_column']]){
                        $product->{$filter['filter_column']} = $data[$filter['filter_column']];
                    }
                }

                $admin_type = Auth::guard('admin')->user()->type;
                $penyedia_id = Auth::guard('admin')->user()->penyedia_id;
                $admin_id = Auth::guard('admin')->user()->id;
                if($admin_type == "penyedia") {
                    $product->penyedia_id = $penyedia_id;
                } else {
                    $product->penyedia_id = 0;
                }

                $product->type = $admin_type;
                $product->admin_id = $admin_id;
                $product->nama = $data['nama'];
                $product->deskripsi = $data['deskripsi'];
                $product->harga = $data['harga'];
                $product->diskon = $data['diskon'];
                $product->meta_title = $data['meta_title'];
                $product->meta_description = $data['meta_description'];
                $product->meta_keywords = $data['meta_keywords'];

                if(!empty($data['is_featured'])){
                    $product->is_featured = $data['is_featured'];
                } else {
                    $product->is_featured = "No";
                }
                if(!empty($data['is_bestseller'])){
                    $product->is_bestseller = $data['is_bestseller'];
                } else {
                    $product->is_bestseller = "No";
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
        $message = "Product delete successfully!";
        return redirect()->back()->with('succses_message', $message);
    }

    public function deleteProductImage($id)
    {
       $gambar = Product::select('gambar')->where('id', $id)->first();
       $imagePathLarge = 'template/images/Photo/Product/Large/';
       $imagePathMedium = 'template/images/Photo/Product/Medium/';
       $imagePathSmall = 'template/images/Photo/Product/Small/';
       
       if(file_exists($imagePathLarge.$gambar->gambar)){
            unlink($imagePathLarge.$gambar->gambar);
       }
       if(file_exists($imagePathMedium.$gambar->gambar)){
        unlink($imagePathMedium.$gambar->gambar);
       }
       if(file_exists($imagePathSmall.$gambar->gambar)){
        unlink($imagePathSmall.$gambar->gambar);
       }

       Product::where('id', $id)->update(['gambar'=>'']);
       $message = "gambar is deleted succesfully";
       return redirect()->back()->with('succses_message', $message);
    }

    public function addAtributeProduct(Request $request, $id)
    {
        Session::put('page', 'products');
        $product = Product::select('id', 'nama', 'harga', 'gambar')->with('attribute')->find($id);
        // $product = json_decode($product, true);
        // dd($product);
        if ($request->isMethod('POST')) {
            $data = $request->all();

            foreach ($data['paket'] as $key => $value) {
                $paketCount = ProductAtribute::where('paket', $value)->count();
                // if($paketCount > 0){
                //     return redirect()->back()->with('error_message', 'Product Attribute has Duplicated, Please Add another Paket!');
                // }
                if (!empty($value)) {
                    $attribute = new ProductAtribute;
                    $attribute -> product_id = $id;
                    $attribute -> paket = $value;
                    $attribute -> harga = $data['harga'][$key];
                    $attribute -> stock = $data['stock'][$key];
                    $attribute -> keterangan = $data['keterangan'][$key];
                    $attribute -> status = 1;
                    $attribute -> save();
                }
            }
            return redirect()->back()->with('succses_message', 'Product Atribute has been succsesfully Added!');
        }
        return view('admin.attribute.add_edit_attribute')->with(compact('product'));
    }
    
    public function updateAtrributeStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            ProductAtribute::where('id', $data['attribute_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'id'=>$data['attribute_id']]);
        }
    }

    public function deleteattribute($id)
    {
        ProductAtribute::where('id', $id)->delete();
        $message = "Product Attribute delete successfully!";
        return redirect()->back()->with('succses_message', $message);
    }

    public function editAttribute(Request $request, $id)
    {
        Session::put('page', 'products');
        if ($request->isMethod('POST')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            foreach ($data['id'] as $key => $attribute) {
                if (!empty($attribute)) {
                    ProductAtribute::where(['id'=>$data['id'][$key]])->update(['harga'=>$data['harga'][$key], 'keterangan'=>$data['keterangan'][$key], 'stock'=>$data['stock'][$key]]);
                }
            }
            return redirect()->back()->with('succses_message', 'Product attribute has been updateted!');
        }
    }

    public function addImage($id, Request $request)
    {
        Session::put('page', 'products');
        $product = Product::select('id', 'nama', 'harga', 'gambar')->with('image')->find($id);
        
        if($request->isMethod('POST')){
            $data = $request->all();
            if($request->hasFile('image')){
                $images = $request->file('image');
                foreach ($images as $key => $image) {
                    $img_tmp = Image::make($image);
                    $img_name = $image->getClientOriginalName();
                    $extension = $image->getClientOriginalExtension();
                    $imageName = $img_name.rand(111,9999).'.'.$extension;
                    $imagePathLarge = 'template/images/Photo/Product/Large/'.$imageName;
                    $imagePathMedium = 'template/images/Photo/Product/Medium/'.$imageName;
                    $imagePathSmall = 'template/images/Photo/Product/Small/'.$imageName;
                    Image::make($img_tmp)->resize(1000, 1000)->save($imagePathLarge);
                    Image::make($img_tmp)->resize(500, 500)->save($imagePathMedium);
                    Image::make($img_tmp)->resize(255, 255)->save($imagePathSmall);
                    
                    $image = new Images;
                    $image->nama = $imageName;
                    $image->product_id = $id;
                    $image->status = 1;
                    $image->save();
                }
            }
        return redirect()->back()->with('succses_message', 'Product attribute has been added!');
        }
        return view('admin.Image.add_images')->with(compact('product'));
    }

    public function updateStatusImage(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Images::where('id', $data['image_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'id'=>$data['image_id']]);
        }        
    }

    public function deleteimages($id)
    {
       $nama = Images::select('nama')->where('id', $id)->first();
       $imagePathLarge = 'template/images/Photo/Product/Large/';
       $imagePathMedium = 'template/images/Photo/Product/Medium/';
       $imagePathSmall = 'template/images/Photo/Product/Small/';
       
       if(file_exists($imagePathLarge.$nama->nama)){
            unlink($imagePathLarge.$nama->nama);
       }
       if(file_exists($imagePathMedium.$nama->nama)){
        unlink($imagePathMedium.$nama->nama);
       }
       if(file_exists($imagePathSmall.$nama->nama)){
        unlink($imagePathSmall.$nama->nama);
       }

       Images::where('id', $id)->delete();
       $message = "Gambar is deleted succesfully";
       return redirect()->back()->with('succses_message', $message);
    }
}
