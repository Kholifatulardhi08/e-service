<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
                $user->status = 1;
                $user->save();

                $email = $data['email'];
                $messageData = [
                    'name'=>$data['name'],
                    'no_hp' =>$data['no_hp'],
                    'email' =>$data['email'],
                ];
                Mail::send('email.confirmation_user', $messageData, function($message)use($email){
                    $message->to($email)->subject('Welcome to E-service!');
                });

                if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                    $redirectTo = url('cart');
                    return response()->json(['type' => 'success', 'url' => $redirectTo]);
                }
            } else {
                return response()->json(['type' => 'error', 'errors' => $validator->getMessageBag()->toArray()]);
            }
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
