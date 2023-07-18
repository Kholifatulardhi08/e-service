<?php

namespace App\Http\Controllers\Admin;

use Image;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Section;

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

    public function addEditCategory(Request $request, $id=null)
    {
        Session::put('page', 'categories');
        if($id=="") {
            $title = "Add Category";
            $category = new Category;
            $getCategory = array();
            $message = "Creted category successfully!";
        } else {
            $title = "Edit Category";
            $category = Category::find($id);
            $getCategory = Category::with('subcategory')->where(['parent_id'=>0, 'section_id'=>$category['section_id']])->get();
            $message = "Updated category successfully!";
        }

        if($request->isMethod('POST')){
            $data = $request->all();

            if($data['diskon']==""){
                $data['diskon'] = 0;
            }

            // save photo to database
            if($request->hasFile('image')){
                $img_tmp = $request->file('image');
                if($img_tmp->isValid()){
                    $extension = $img_tmp->getClientOriginalExtension();
                    $image_name = rand(111,9999).'.'.$extension;
                    $imagePath = 'template/images/Photo/Category/'.$image_name;
                    Image::make($img_tmp)->save($imagePath);
                    $category->image = $image_name;
                }
            }else{
                $category->image = "";
            }
            $category->nama = $data['nama'];
            $category->parent_id = $data['parent_id'];
            $category->section_id = $data['section_id'];
            $category->diskon = $data['diskon'];
            $category->deskripsi = $data['deskripsi'];
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keyword = $data['meta_keyword'];
            $category->status = 1;
            $category->save();

            return redirect('admin/category')->with('succses_message', $message);
        }
        // get All sections
        $getSections = Section::get()->toArray();
        return view('admin.category.add_edit_category')->with(compact('title', 'category', 'getSections', 'getCategory'));
    }

    public function appendcategorylevel(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            $getCategory = Category::with('subcategory')->where(['parent_id'=>0, 'section_id'=>$data['section_id']])->get()->toArray();
            return view('admin.category.appendCategoryLevel')->with(compact('getCategory'));
        }        
    }

    public function delete($id)
    {
        Category::where('id', $id)->delete();
        $message = "category delete succsesfully!";
        return redirect()->back()->with('succses_message', $message);
    }

    public function deleteimage($id)
    {
        $category_image = Category::select('image')->where('id', $id)->first();
        $category_image_path = 'template/images/Photo/Category/';
        if(file_exists($category_image_path.$category_image->image)){
            unlink($category_image_path.$category_image->image);
        }
        Category::where('id', $id)->update(['image'=>'']);
        $message = 'Image succesfully delete from directory!';
        return redirect()->back()->with('succses_message', $message);
    }
}
