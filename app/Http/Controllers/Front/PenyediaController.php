<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PenyediaController extends Controller
{
    public function loginregister(){
        return view('front.penyedia.login_register');
    }
}
