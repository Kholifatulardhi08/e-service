<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function loginregister(){
        return view('front.penyewa.login_register');
    }

    public function register(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            // Register User
            $user = New User;
            $user->name = $data['name'];
            $user->no_hp = $data['no_hp'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->status = 1;
            $user->save();

            if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])){
                $redirectTo = url('cart');
                return response()->json(['url'=>$redirectTo]);
            }
        }
    }
}
