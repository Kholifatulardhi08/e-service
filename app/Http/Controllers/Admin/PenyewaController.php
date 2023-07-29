<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PenyewaController extends Controller
{
    public function index()
    {
        Session::put('page', 'penyewa');
        $users = User::get()->toArray();
        // dd($users);
        return view('admin.users.users')->with(compact('users'));
    }

    public function updatePenyewaStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            User::where('id', $data['penyewa_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'id'=>$data['penyewa_id']]);
        }
    }
}
