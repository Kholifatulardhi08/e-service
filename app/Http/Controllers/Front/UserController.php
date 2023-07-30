<?php

namespace App\Http\Controllers\Front;

use App\Models\Cart;
use App\Models\User;
use App\Models\Delivery;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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

    public function checkout()
    {
        $deliveryAddress = Delivery::DeliveryAddreses();
        // dd($deliveryAddress);
        $provinsi = \Indonesia::allProvinces()->toArray();
        return view('front.products.cart.checkout')->with(compact('deliveryAddress', 'provinsi'));
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
                $deliveryAddress = Delivery::DeliveryAddreses();
                $provinsi = \Indonesia::allProvinces()->toArray();
                return response()->json([
                    'view'=>(String)View::make('front.products.cart.deliveries')->with(compact('deliveryAddress', 'provinsi'))
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
            $deliveryAddress = Delivery::DeliveryAddreses();
            $provinsi = \Indonesia::allProvinces()->toArray();
            return response()->json([
                'view'=>(String)View::make('front.products.cart.deliveries')->with(compact('deliveryAddress', 'provinsi'))
            ]);    
        };
    }
}
