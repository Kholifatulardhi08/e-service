<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Hash;
use Image;
use App\Models\BankDetail;
use App\Models\Penyedia;
use App\Models\Admin;
use App\Models\JasaDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{   
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function login(Request $request)
    {
        if ($request->isMethod('POST')) 
        {
            $data = $request->all();
            $validated = $request->validate([
                'email' => 'required|email|max:255',
                'password' => 'required',
            ]);

            if(Auth::guard('admin')->attempt(['email'=>$data['email'], 'password'=>$data['password'],
            'status'=>1])){
                return redirect('admin/dashboard');
            }else {
                return redirect()->back()->with('error_message', 'invalid email and password');
            }
             return view('admin.dashboard');
        }
        return view('admin.login');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

    public function update_admin_password(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            if(Hash::check($data['current_password'], Auth::guard('admin')->user()->password)){
                if ($data['confirm_password']==$data['new_password']) {
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_password'])]);
                    return redirect()->back()->with('succses_message', 'Your password is currently Updated!');
                }else{
                    return redirect()->back()->with('error_message', 'New password and confirm Password does not match!');
                }
            }else{
                return redirect()->back()->with('error_message', 'Your password current is Incorrect!');
            }
        }
        $admin = Admin::where('email', Auth::guard('admin')->user()->email)->first()->toArray();
        return view('admin.settings.update_admin_password')->with(compact('admin'));
    }

    public function check_current_password(Request $request)
    {
        $data = $request->all();
        if(Hash::check($data['current_password'], Auth::guard('admin')->user()->password))
        {
            return "true";
        }else{
            return "false";
        }
    }

    public function update_admin_details(Request $request)
    {
        if($request->isMethod('POST')){
            $data = $request->all();
            $rules = [
                'nama' => 'required|regex:/^[\pL\s\-]+$/u',
                'no_hp' => 'required',
            ];
            $customMessages = [
                'nama.required' => 'Name is required',
                'nama.regex' => 'Valid name is required',
                'no_hp.required' => 'No handphone is required',
                'no_hp.numeric' => 'Valid no Handphone is required',
            ];

            if($request->hasFile('image')){
                $img_tmp = $request->file('image');
                if($img_tmp->isValid()){
                    $extension = $img_tmp->getClientOriginalExtension();
                    $image_name = rand(111,9999).'.'.$extension;
                    $imagePath = 'template/images/Photo/'.$image_name;
                    Image::make($img_tmp)->save($imagePath);
                }
            }elseif (!empty($data['current_hidden_image'])) {
                $image_name = $data['current_hidden_image'];
            }else{
                $image_name = "";
            }

            $this->validate($request, $rules, $customMessages);
            Admin::where('id', Auth::guard('admin')->user()->id)->update([
                'nama'=>$data['nama'], 'no_hp'=>$data['no_hp'], 'image'=>$image_name]);
            return redirect()->back()->with('succses_message', 'Admin details updated Succsesfully!');
        }
        return view('admin.settings.update_admin_details');
    }

    public function update_penyedia_details($slug, Request $request)
    {
        if($slug=="penyedia"){
            if ($request->isMethod('POST')){
                $data = $request->all();

                $rules = [
                    'nama' => 'required|regex:/^[\pL\s\-]+$/u',
                    'no_hp' => 'required',
                ];
                $customMessages = [
                    'nama.required' => 'Name is required',
                    'nama.regex' => 'Valid name is required',
                    'no_hp.required' => 'No handphone is required',
                    'no_hp.numeric' => 'Valid no Handphone is required',
                ];
    
                if($request->hasFile('image')){
                    $img_tmp = $request->file('image');
                    if($img_tmp->isValid()){
                        $extension = $img_tmp->getClientOriginalExtension();
                        $image_name = rand(111,9999).'.'.$extension;
                        $imagePath = 'template/images/Photo/'.$image_name;
                        Image::make($img_tmp)->save($imagePath);
                    }
                }elseif (!empty($data['current_hidden_image'])) {
                    $image_name = $data['current_hidden_image'];
                }else{
                    $image_name = "";
                }
    
                $this->validate($request, $rules, $customMessages);
                Admin::where('id', Auth::guard('admin')->user()->id)->update([
                    'nama'=>$data['nama'], 'no_hp'=>$data['no_hp'], 'image'=>$image_name]);
                Penyedia::where('id', Auth::guard('admin')->user()->penyedia_id)->update([
                    'nama'=>$data['nama'], 
                    'no_hp'=>$data['no_hp'], 
                    'alamat'=>$data['alamat'],
                    'kecamatan'=>$data['kecamatan'],
                    'kota'=>$data['kota'],
                    'provinsi'=>$data['provinsi'],
                ]);
                return redirect()->back()->with('succses_message', 'Penyewa details updated Succsesfully!');
            }
            $penyediadetail = Penyedia::where('id', Auth::guard('admin')->user()->penyedia_id)->first()->toArray();
        }elseif($slug=="jasadetail"){
            if ($request->isMethod('POST')){
                $data = $request->all();

                $rules = [
                    'nama_toko' => 'required',
                ];
                $customMessages = [
                    'nama_toko.required' => 'Name is required',
                    'nama_toko.regex' => 'Valid name is required',
                ];
    
                $this->validate($request, $rules, $customMessages);
                JasaDetail::where('id', Auth::guard('admin')->user()->penyedia_id)->update([
                    'nama_toko'=>$data['nama_toko'], 
                    'alamat_toko'=>$data['alamat_toko'], 
                    'kecamatan_toko'=>$data['kecamatan_toko'],
                    'kota_toko'=>$data['kota_toko'],
                    'provinsi_toko'=>$data['provinsi_toko'],
                    'kode_pos_toko'=>$data['kode_pos_toko'],
                ]);
                return redirect()->back()->with('succses_message', 'Penyewa toko details updated Succsesfully!');
        }
            $penyediadetail = JasaDetail::where('id', Auth::guard('admin')->user()->penyedia_id)->first()->toArray();
        }elseif($slug=="bank"){
            if ($request->isMethod('POST')){
                $data = $request->all();

                $rules = [
                    'jenis_bank' => 'required',
                    'nomor_bank' => 'required',
                    'nama_pemilik_bank' => 'required',
                ];
                $customMessages = [
                    'jenis_bank.required' => 'Name is required',
                    'nomor_bank.required' => 'nomor bank is requird',
                    'nama_pemilik_bank' => 'nama pemilik bank is required'
                ];
    
                $this->validate($request, $rules, $customMessages);
                BankDetail::where('id', Auth::guard('admin')->user()->penyedia_id)->update([
                    'jenis_bank'=>$data['jenis_bank'], 
                    'nomor_bank'=>$data['nomor_bank'], 
                    'nama_pemilik_bank'=>$data['nama_pemilik_bank']
                ]);
                return redirect()->back()->with('succses_message', 'Penyewa bank details updated Succsesfully!');
            }
            $penyediadetail = BankDetail::where('id', Auth::guard('admin')->user()->penyedia_id)->first()->toArray();
        }
        return view('admin\settings\update_penyedia_details')->with(compact('slug', 'penyediadetail'));
    }

    public function admins($type=null)
    {
        $admin = Admin::query();
        if(!empty($type)){
            $admins = $admin->where('type', $type);
            $title = ucfirst($type);
        }else{
            $title = "All Admins/Subadmins/Penyedia";
        }
        $admins = $admin->get()->toArray();
        return view('admin.admins.admins')->with(compact('admins', 'title'));
    }

    public function penyediadeatils($id)
    {
        $penyediadetail = Admin::where('id', $id)->first();
        $penyediadetail = json_decode(json_decode($penyediadetail), true);
        dd($penyediadetail);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
