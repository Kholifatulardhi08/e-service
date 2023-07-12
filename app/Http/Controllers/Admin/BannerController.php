<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Image;

class BannerController extends Controller
{
    public function index()
    {
        Session::put('page', 'banners');
        $banners = Banner::get()->toArray();
        return view('admin.banner.index')->with(compact('banners'));
    }

    public function updatebannerstatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Banner::where('id', $data['banner_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'id'=>$data['banner_id']]);
        }
    }

    public function deletebanner($id)
    {
        $gambar = Banner::where('id', $id)->first();
        $banner_img_path = 'front/images/main-slider/';
        if(file_exists($banner_img_path.$gambar->gambar)){
            unlink($banner_img_path.$gambar->gambar);
        }
        Banner::where('id', $id)->delete();
        $message = "Banner delete successfully!";
        return redirect()->back()->with('succses_message', $message);
    }

    public function addEditBanner(Request $request, $id=null)
    {
        Session::put('page', 'banners');
        if($id==""){
            $banner = new Banner;
            $title = "Add Banner";
            $message = "Banner Added successfully!";
        }else{
            $banner = Banner::find($id);
            $title = "Edit Banner";
            $message = "Banner Updated successfully!";
        }
        if($request->isMethod('POST')){
            $data = $request->all();

            $banner->link = $data['link'];
            $banner->title = $data['title'];
            $banner->alt = $data['alt'];
            $banner->status = 1;

            if($request->hasFile('gambar')){
                $img_tmp = $request->file('gambar');
                if($img_tmp->isValid()){
                    $extension = $img_tmp->getClientOriginalExtension();
                    $image_name = rand(111,9999).'.'.$extension;
                    $imagePath = 'front/images/main-slider/'.$image_name;
                    Image::make($img_tmp)->resize(1920,720)->save($imagePath);
                    $banner->gambar = $image_name;
                }
            }else{
                $category->gambar = "";
            }
            $banner->save();
            return redirect('admin/banners')->with('succses_message', $message);
        }
        return view('admin.banner.add_edit_banner')->with(compact('banner', 'title'));
    }
}
