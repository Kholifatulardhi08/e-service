<?php

namespace App\Http\Controllers\Front;

use Validator;
use App\Models\Admin;
use App\Models\Penyedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class PenyediaController extends Controller
{
    public function loginregister(){
        return view('front.penyedia.login_register');
    }

    public function register(Request $request)
    {
        if($request->isMethod('POST')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $rules = [
                "nama" => "required",
                "email" => "required|email|unique:admins|unique:penyedias",
                "no_hp" => "required|min:13|numeric|unique:admins|unique:penyedias",
                "accept" => "required"
            ];
            $customMessage = [
                "nama.required" => "nama is required",
                "email.required" => "email is required",
                "email.unique" => "email already exist",
                "no_hp.unique" => "number handphone already exist, please input any number",
                "accept.required" => "please! accept Term & condition",
            ];
            $validator = Validator::make($data, $rules, $customMessage);
            if($validator->fails()){
                return Redirect::back()->withErrors($validator);
            }

            DB::beginTransaction();
            // Create Penyedia save to database
            $penyedia = New Penyedia;
            $penyedia->nama = $data['nama'];
            $penyedia->no_hp = $data['no_hp'];
            $penyedia->email = $data['email'];
            $penyedia->status = 1; 
            $penyedia->save();

            $penyedia_id = DB::getPdo()->lastInsertId();

            // insert penyedia save to admin db
            $admin = New Admin;
            $admin->type = 'penyedia';
            $admin->penyedia_id = $penyedia_id;
            $admin->nama = $data['nama'];
            $admin->no_hp = $data['no_hp'];
            $admin->email = $data['email'];
            $admin->password = bcrypt($data['password']);
            $admin->status = 1; 
            $admin->save();

            // kirim konfirmasi email
            $email = $data['email'];
            $messageData = [
                'email' => $data['email'],
                'nama' => $data['nama'],
                'code' => base64_encode($data['email'])
            ];
            
            Mail::send('email.confirmation', $messageData, function($message)use($email) {
                $message->to($email)->subject('confirm your penyedia account');
            });

            DB::commit();

            // redirect back 
            $message = "Terima Kasih telah registrasi, konfirmasi melalui email anda ketika anda disetujui!";
            return redirect()->back()->with('success_message', $message);
        }

    }

    public function confirmpenyedia($email)
    {
        $email = base64_decode($email);
        $penyediacount =  Penyedia::where('email', $email)->count();
        if ($penyediacount>0) {
            $penyediaDetails = Penyedia::where('email', $email)->first();
            if($penyediaDetails->confirm=="Yes"){
                $message = "Your penyedia akun is actived! anda bisa login!";
                return redirect('penyedia/login-register')->with('error_message', $message);
            }else{
                Admin::where('email', $email)->update(['confirm'=>'Yes']);
                Penyedia::where('email', $email)->update(['confirm'=>'Yes']);

                // kirim konfirmasi email
                    $messageData = [
                        'email' => $email,
                        'nama' => $penyediaDetails->nama,
                        'no_hp' => $penyediaDetails->no_hp
                    ];
            
            Mail::send('email.confirmed', $messageData, function($message)use($email) {
                $message->to($email)->subject('Your penyedia account confirmed');
            });

                $message = "Your penyedia email, you can add personal detail, jasa detail, bank detail and add product!";
                return redirect('admin/login')->with('success_message', $message);
            }
        }else{
            abort(404);
        }
        
    }
}
