<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function order()
    {
        Session::put('page', 'order');
        $adminType  = Auth::guard('admin')->user()->type;
        $penyedia_id  = Auth::guard('admin')->user()->penyedia_id;
        if($adminType=="penyedia"){
            $penyediaStatus = Auth::guard('admin')->user()->status;
            if ($penyediaStatus==0) {
                return redirect('admin/update_admin_details')->with('error_message', 'Vendor Account ist not approved!');
            }
        }
        if ($adminType="penyedia") {
            $orders = Order::with(['order'=>function($query)use($penyedia_id){
                $query->where('penyedia_id', $penyedia_id);
            }])->orderBy('id', 'desc')->get()->toArray();
        } else {
            $orders = Order::with('order')->orderBy('id', 'desc')->get()->toArray();
        }
        return view('admin.order.order')->with(compact('orders'));
    }
}
