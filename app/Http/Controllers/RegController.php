<?php

namespace App\Http\Controllers;
use App\Registration;
use Illuminate\Http\Request;

class RegController extends Controller
{
    public function index(Request $request){
        Registration::updateOrCreate(['id'=>$request->editId],
            [
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>$request->password,
                'mobile'=>$request->mobile,
                'village'=>$request->village,
            ]);
        return redirect()->back();
    }
    public function view(){
        $data = Registration::get();
        return view('registration',['data'=>$data]);
    }
    public function deleteUser(Request $delete){
        Registration::where('id',$delete->id)->delete();
    }
    public function editUser(Request $edit){
        return Registration::where('id',$edit->id)->first();
    }
}
