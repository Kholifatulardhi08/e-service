<?php

namespace App\Http\Controllers\Admin;

use Dompdf\Dompdf;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderLog;
use App\Models\OrderStatus;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Models\OrderItemStatus;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
        $orderlog = OrderLog::where('order_id', $id)->get()->toArray();
        return view('admin.order.order_details')->with(compact('orderlog', 'orderitemstatus', 'orderdetails', 'userdetails', 'orderstatus'));
    }

    public function updateorder(Request $request)
    {
        if($request->isMethod('POST')){
            $data = $request->all();
            Order::where('id', $data['order_id'])->update(['order_status'=>$data['order_status']]);
            
            $log = New OrderLog;
            $log->order_id = $data['order_id'];
            $log->order_status = $data['order_status'];
            $log->save();

            $deliveryDetails = Order::select('nama', 'email')->where('id', $data['order_id'])->first()->toArray();
            $email = $deliveryDetails['email'];
            $order_details = Order::with('order')->where('id', $data['order_id'])->first()->toArray();
            $messageData = [
                'email' => $email,
                'nama' => $deliveryDetails['nama'],
                'order_id' => $data['order_id'],
                'order_details' => $order_details,
                'order_status' => $data['order_status']
            ];
            Mail::send('email.order_status', $messageData, function($message)use($email){
                $message->to($email)->subject('Order Status update / E-service');
            });
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

    public function invoice($order_id)
    {
        $orderdetails = Order::with('order')->where('id', $order_id)->first()->toArray();
        $userdetails = User::where('id', $orderdetails['user_id'])->first()->toArray();
        return view('admin.order.invoice')->with(compact('orderdetails', 'userdetails'));
    }

        public function cetakpdf($order_id)
        {
            // Ambil data order dan user berdasarkan order_id
            $orderdetails = Order::with('order')->where('id', $order_id)->first()->toArray();
            $userdetails = User::where('id', $orderdetails['user_id'])->first()->toArray();

            // Render view dan ambil HTML-nya
            $view = view('admin.order.cetak_pdf')->with(compact('orderdetails', 'userdetails'));

            // echo $view;
            // exit;

            $html = $view->render();

            // instantiate and use the dompdf class
            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);

            // (Optional) Setup the paper size and orientation
            $dompdf->setPaper('A4', 'landscape');

            // Render the HTML as PDF
            $dompdf->render();

            // Set the PDF content-type
            header('Content-Type: application/pdf');

            // Output the generated PDF to Browser
            echo $dompdf->output();
            exit;
        }


}
