<?php

namespace App\Http\Controllers\Admin;

use App\Models\OrderProduct;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use App\Models\OrderItemStatus;
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

    public function orderDetails($id)
    {
        $orderdetails = Order::with('order')->where('id', $id)->first()->toArray();
        $userdetails = User::where('id', $orderdetails['user_id'])->first()->toArray();
        $orderstatus = OrderStatus::where('status', 1)->get()->toArray();
        $orderitemstatus = OrderItemStatus::where('status', 1)->get()->toArray();
        return view('admin.order.order_details')->with(compact('orderitemstatus', 'orderdetails', 'userdetails', 'orderstatus'));
    }

    public function updateorder(Request $request)
    {
        if($request->isMethod('POST')){
            $data = $request->all();
            Order::where('id', $data['order_id'])->update(['order_status'=>$data['order_status']]);
            $message = "Success updated!";
            return redirect()->back()->with('succses_message', $message);
        }
    }

    public function itemorderupdate(Request $request)
    {
        if($request->isMethod('POST')){
            $data = $request->all();
            OrderProduct::where('id', $data['id'])->update(['item_status'=>$data['item_status']]);
            $message = "Success updated!";
            return redirect()->back()->with('succses_message', $message);
        }
    }
}
