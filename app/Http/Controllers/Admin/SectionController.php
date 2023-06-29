<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;

class SectionController extends Controller
{
    public function section()
    {
        Session::put('page', 'sections');
        $sections = Section::get()->toArray();
        return view('admin.sections.sections')->with(compact('sections'));
    }

    public function updateSectionStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Section::where('id', $data['section_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'id'=>$data['section_id']]);
        }
    }

    public function add_edit_section(Request $request, $id=null)
    {
        Session::put('page', 'sections');
        if ($id=="") {
            $title = "Add Section";
            $sections = new Section;
            $message = "Section add successfully!";
        }else{
            $title = "Edit Section";
            $sections = Section::find($id);
            $message = "Section Updated successfully!";
        }
        if ($request->isMethod('POST')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $rules = [
                'nama' => 'required',
            ];
            $customMessages = [
                'nama.required' => 'Name is required',
            ];

            $this->validate($request, $rules, $customMessages);

            $sections->nama = $data['nama'];
            $sections->status = 1;
            $sections->save();

            return redirect('admin/section')->with('succses_message', $message);
        }
        return view('admin.sections.add_edit_section')->with(compact('title', 'sections', 'message'));
    }

    public function delete($id)
    {
        Section::where('id', $id)->delete();
        $message = "Section delete successfully!";
        return redirect()->back()->with('succses_message', $message);
    }
}
