<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

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
}
