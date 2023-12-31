<?php

namespace App\Http\Controllers\Front;

use App\Models\Cart;
use App\Models\OrderProduct;
use App\Models\ProductAtribute;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Delivery;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function loginregister(){
        return view('front.penyewa.login_register');
    }

    public function register(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:100',
                'email' => 'required|email|max:150|unique:users',
                'password' => 'required|min:6',
                'accept' => 'required'
            ],
            [
                'accept.required' => 'Please accept Terms & Conditions!'
            ]);

            if ($validator->passes()) {
                // Register User
                $user = new User;
                $user->name = $data['name'];
                $user->no_hp = $data['no_hp'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->status = 0;
                $user->save();

                $email = $data['email'];
                $messageData = [
                    'name'=>$data['name'],
                    'no_hp' =>$data['no_hp'],
                    'email' =>$data['email'],
                    'code' => base64_encode($data['email'])
                ];
                Mail::send('email.confirmation_user', $messageData, function($message)use($email){
                    $message->to($email)->subject('Confirmation to login E-service!');
                });

                if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                    if(!empty(Session::get('session_id'))){
                        $user_id = Auth::user()->id;
                        $session_id = Session::get('session_id');
                        Cart::where('session_id', $session_id)->update(['user_id'=>$user_id]);
                    }
                    $redirectTo = url('penyewa/login-register');
                    return response()->json(['type' => 'success', 'url' => $redirectTo, 'message'=>'Please Confirm Your email to active your Account!']);
                }
            } else {
                return response()->json(['type' => 'error', 'errors' => $validator->getMessageBag()->toArray()]);
            }
        }
    }

    public function confirmpenyewa($code)
    {
        $email = base64_decode($code);
        $userCount = User::where('email', $email)->count();
        if($userCount>0){
            $userDetails = User::where('email', $email)->first();
            if($userDetails->status==1){
                return redirect('penyewa/login-register')->with('error_message', 'Your account already actived! you can login.');
            }else{
                User::where('email', $email)->update(['status'=>1]);
                $messageData = [
                    'name'=>$userDetails['name'],
                    'no_hp' =>$userDetails['no_hp'],
                    'email' =>$email,
                ];
                Mail::send('email.confirmed_user', $messageData, function($message)use($email){
                    $message->to($email)->subject('Congratulation to login E-service right now!');
                });
                return redirect('penyewa/login-register')->with('success_message', 'Your account already actived! you can login.');
            }
        }else{
            abort(404);
        }
    }

    public function login(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $validator = Validator::make($request->all(), [  
                'email' => 'required|email|max:150|exists:users',
                'password' => 'required|min:6',
            ]);

            if ($validator->passes()) {
                if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                    if(Auth::user()->status==0){
                        Auth::logout();
                        return response()->json(['type'=>'inactive', 'message'=>'Please Contact Admin, Your account is inactive']);
                    }
                    if(!empty(Session::get('session_id'))){
                        $user_id = Auth::user()->id;
                        $session_id = Session::get('session_id');
                        Cart::where('session_id', $session_id)->update(['user_id'=>$user_id]);
                    }
                    $redirectTo = url('cart');
                    return response()->json(['type' => 'success', 'url' => $redirectTo]);
                } else {
                    return response()->json(['type' => 'incorrect', 'message'=>'Incorect Email or Password!']);
                }
            } else {
                return response()->json(['type' => 'error', 'errors' => $validator->getMessageBag()->toArray()]);
            }
        }
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/');
    }

    public function lupapassword(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|max:150|exists:users',
            ],
            [
                'email.required' => 'your email not found!'
            ]);

            if ($validator->passes()) {
                $new_password = Str::random(16);
                User::where('email', $data['email'])->update(['password'=>bcrypt($new_password)]);
                
                // get user
                $userDetails = User::where('email', $data['email'])->first()->toArray();

                // send email to Penyewa
                $email = $data['email'];
                $messageData = [
                    'name'=>$userDetails['name'],
                    'email' =>$email,
                    'password' =>$new_password
                ];
                Mail::send('email.forgot_password', $messageData, function($message)use($email){
                    $message->to($email)->subject('New Password for Penyewa - login E-service!');
                });
                return response()->json(['type' => 'success', 'message'=>'Your new password send to your email registered!']);
            } else {
                return response()->json(['type' => 'error', 'errors' => $validator->getMessageBag()->toArray()]);
            }
        } else {
            return view('front.penyewa.lupa_password');
        }
    }

    public function account(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:100',
                'alamat' => 'required|string|max:100',
                'kecamatan' => 'required|string|max:100',
                'kota' => 'required|string|max:100',
                'provinsi' => 'required|string|max:100',
                'kode_pos' => 'required|string|max:100',
            ]);

            if ($validator->passes()) {
                User::where('id', Auth::user()->id)->update([
                    'name' => $data['name'],
                    'alamat' => $data['alamat'],
                    'kecamatan' => $data['kecamatan'],
                    'kota' => $data['kota'],
                    'provinsi' => $data['provinsi'],
                    'kode_pos' => $data['kode_pos']
                ]);
                $redirectTo = url('setting-account');
                return response()->json(['type'=> 'success', 'message'=>'Your account detail is succesfully updated!']);
            } else {
                return response()->json(['type' => 'error', 'errors' => $validator->getMessageBag()->toArray()]);
            }

        }else{
            $provinsi = \Indonesia::allProvinces()->toArray();
            return view('front.penyewa.akun')->with(compact('provinsi'));
        }
    }

    public function updatepassword(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $validator = Validator::make($request->all(), [
                'current_password' => 'required',
                'new_password' => 'required|min:6',
                'confirm_password' => 'required|min:6|same:new_password'
            ]);

            if ($validator->passes()) {
                $current_password = $data['current_password'];
                $checkPassword = User::where('id', Auth::user()->id)->first();
                if(Hash::check($current_password, $checkPassword->password)){
                    // update password in database
                    $user = User::find(Auth::user()->id);
                    $user->password = bcrypt($data['new_password']);
                    $user->save();

                    return response()->json(['type'=> 'success', 'message'=>'Your update is succesfully updated!']);
                }else{
                    return response()->json(['type' => 'incorrect', 'message'=>'Incorect Password not same!']);
                }
            } else {
                return response()->json(['type' => 'error', 'errors' => $validator->getMessageBag()->toArray()]);
            }
        }else{
            return view('front.penyewa.akun')->with(compact('provinsi'));
        }
    }

    public function checkout(Request $request)
    {
        $getCartItem = Cart::getCartItem();
        // dd($getCartItem);
        $deliveryAddresses = Delivery::DeliveryAddreses();
        // dd($deliveryAddress);
        $provinsi = \Indonesia::allProvinces()->toArray();

        if(count($getCartItem)==0){
            $message = "Shooping cart is empty! Please Add product to checkout!";
            return redirect('cart')->with('error_message', $message);
        }

        if($request->isMethod('POST')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;   
            
            foreach($getCartItem as $item)
            {
                $product_status = Product::getStatusProduct($item['product_id']);
                if($product_status==0){
                    Product::deleteCartProduct($item['product_id']);
                    $message = "One of Product of disable, please choice another Product!";
                    return redirect('/cart')->with('error_message', $message);
                }

                $isStockReady = ProductAtribute::isStockReady($item['product_id'], $item['paket']);
                if ($isStockReady==0) {
                    Product::deleteCartProduct($item['product_id']);
                    $message = "One of Product is sold out, please choice another Product!";
                    return redirect('/cart')->with('error_message', $message);
                }

                $getAtributeStatus = ProductAtribute::getAtributeStatus($item['product_id']);
                if ($getAtributeStatus==0) {
                    Product::deleteCartProduct($item['product_id']);
                    $message = "One of Product is nonaktive out, please choice another Product!";
                    return redirect('/cart')->with('error_message', $message);
                }
            }

            // if delivery id null
            if(empty($data['address_id'])){
                $message = "Please Select delivery address!";
                return redirect()->back()->with('error_message', $message);
            }
            // if payment id null
            if(empty($data['payment_gateway'])){
                $message = "Please Select Payment!";
                return redirect()->back()->with('error_message', $message);
            }
            // if payment id null
            if(empty($data['accept'])){
                $message = "Please Select accept T&C!";
                return redirect()->back()->with('error_message', $message);
            }
            $delivery = Delivery::where('id', $data['address_id'])->first()->toArray();
            // dd($deliveryAddress);
            if($data['payment_gateway']=="COD"){
                $payment_method = "COD";
                $order_status = "New";
            }else{
                $payment_method = "Prepaid";
                $order_status = "Pending";
            }

            DB::beginTransaction();

            $total_harga = 0;
            foreach($getCartItem as $item){
                $hargaattribute = Product::hargaattribute($item['product_id'], $item['paket']);
                $total_harga = $total_harga + ($hargaattribute['final_harga'] * $item['quantity']);
            }
            $grand_total = $total_harga;
            Session::put('grand_total', $grand_total);

            $order = New Order;
            $order->user_id = Auth::user()->id;
            $order->email = Auth::user()->email;
            $order->nama = Auth::user()->name;
            $order->no_hp = $delivery['no_hp'];
            $order->alamat = $delivery['alamat'];
            $order->kecamatan = $delivery['kecamatan'];
            $order->kota = $delivery['kota'];
            $order->provinsi = $delivery['provinsi'];
            $order->kode_pos = $delivery['kode_pos'];
            $order->order_status = $order_status;
            $order->order_status = $payment_method;
            $order->payment_gateway = $data['payment_gateway'];
            $order->grand_total = $grand_total;
            $order->save();
            $order_id = DB::getPdo()->lastInsertId();

            foreach($getCartItem as $item){
                $cartItem = New OrderProduct;
                $cartItem -> order_id = $order_id;
                $cartItem -> user_id = Auth::user()->id;
                $getProductDetails = Product::select('id', 'nama', 'admin_id', 'penyedia_id')->where('id', $item['product_id'])->first()->toArray();
                $cartItem->admin_id = $getProductDetails['admin_id'];
                $cartItem->penyedia_id = $getProductDetails['penyedia_id'];
                $cartItem->product_id = $getProductDetails['id'];
                $cartItem->nama = $getProductDetails['nama'];
                $hargaattribute = Product::hargaattribute($item['product_id'], $item['paket']);
                $cartItem->harga = $hargaattribute['final_harga'];
                $cartItem->quantity = $item['quantity'];
                $cartItem->save();

                // Reduce stock script start
                $isStockReady = ProductAtribute::isStockReady($item['product_id'], $item['paket']);
                $newStock = $isStockReady - $item['quantity'];
                ProductAtribute::where(['product_id'=>$item['product_id'], 'paket'=>$item['paket']])->update(['stock'=>$newStock]);
            }
            session(['order_id' => $order_id, 'grand_total' => $grand_total]);
            // Session::put('order_id', $order_id);
            DB::commit();
            if($data['payment_gateway']=="COD"){
                // send order email
                $email = Auth::user()->email;
                $order_details = Order::with('order')->where('id', $order_id)->first()->toArray();
                $messageData = [
                    'email' => $email,
                    'name' => Auth::user()->name,
                    'order_id' => $order_id,
                    'order_details' => $order_details
                ];
                Mail::send('email.order', $messageData, function($message)use($email){
                    $message->to($email)->subject('Order Placed / E-service');
                });
            }else{
                echo "Perpaid is comingsoon!";
            }
            return redirect('thanks');
        }
        return view('front.products.cart.checkout')->with(compact('deliveryAddresses', 'provinsi', 'getCartItem'));
    }

    public function editDelivery(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            $delivery = Delivery::where('id', $data['addressid'])->first()->toArray();
            // $delivery = Delivery::DeliveryAddreses();
            return response()->json(['delivery'=>$delivery]);
        };
    }

    public function saveDelivery(Request $request){
        if($request->ajax()){

            $validator = Validator::make($request->all(),[
                'delivery_nama' => 'required', 
                'delivery_no_hp' => 'required', 
                'delivery_alamat' => 'required', 
                'delivery_kecamatan' => 'required', 
                'delivery_provinsi' => 'required',
                'delivery_kode_pos' => 'required'
            ]);

            if($validator->passes()) {
                $data = $request->all();
                // echo "<pre>"; print_r($data); die;
                    $delivery = array();
                    $delivery['user_id']=Auth::user()->id;
                    $delivery['nama']=$data['delivery_nama'];
                    $delivery['no_hp']=$data['delivery_no_hp'];
                    $delivery['alamat']=$data['delivery_alamat'];
                    $delivery['kecamatan']=$data['delivery_kecamatan'];
                    $delivery['kota']=$data['delivery_kota'];
                    $delivery['provinsi']=$data['delivery_provinsi'];
                    $delivery['kode_pos']=$data['delivery_kode_pos'];
    
                if (!empty($data['delivery_id'])) {
                    Delivery::where('id', $data['delivery_id'])->update($delivery);
                } else {
                    // $delivery['status'] = 1;
                    Delivery::create($delivery);
                }
                $deliveryAddresses = Delivery::DeliveryAddreses();
                $provinsi = \Indonesia::allProvinces()->toArray();
                return response()->json([
                    'view'=>(String)View::make('front.products.cart.deliveries')->with(compact('deliveryAddresses', 'provinsi'))
                ]);   
            } else {
                return response()->json(['type' => 'error', 'errors' => $validator->getMessageBag()->toArray()]);
            }     
        };
    }

    public function deleteDelivery(Request $request){
        if($request->ajax()){
            $data = $request->all();
            Delivery::where('id', $data['addressid'])->delete();
            $deliveryAddresses = Delivery::DeliveryAddreses();
            $provinsi = \Indonesia::allProvinces()->toArray();
            return response()->json([
                'view'=>(String)View::make('front.products.cart.deliveries')->with(compact('deliveryAddresses', 'provinsi'))
            ]);    
        };
    }

    public function thanks()
    {
        if (Session::has('order_id')) {
            Cart::where('user_id', Auth::user()->id)->delete();
            return view('front.products.thanks', [
                'order_id' => session('order_id'),
                'grand_total' => session('grand_total')
            ]);
        } else {
            return redirect('cart');
        }
    }

    public function order($id=null)
    {
        if(empty($id)){
            $orders = Order::with('order')->where('user_id', Auth::user()->id)->orderBy('id', 'Desc')->get()->toArray();
            // dd($orders);
            return view('front.products.orders.index')->with(compact('orders'));
        }else{
            // echo "orderdetails"; die;
            $orderdetails = Order::with('order')->where('id', $id)->first()->toArray();
            // dd($orderdetails);
            return view('front.products.orders.order_details')->with(compact('orderdetails'));
        }
    }
}
