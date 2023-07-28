<?php

namespace App\Http\Controllers\Front;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
}
