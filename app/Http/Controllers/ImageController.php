<?php

namespace App\Http\Controllers;
use App\ImageModal;
use Storage;
use Response;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index(){
        $file = ImageModal:: all();
        return view('avatar',['file'=>$file]);
    }
    public function addImage(Request $addImage){
        $data = $addImage->file('avatar');
        $photo =$data->getClientOriginalName();
        $path = storage_path('app/public/image/');
        $status = $data->move($path,$photo);
        ImageModal::create(['avatar'=>$photo]);
        return redirect()->back();
    }
    public function deleteAvatar($id){
        ImageModal::find($id)->delete();
        return redirect() -> back();
    }
    public function downloadAvatar($file){
        return Storage::download('public/image/'.$file);
    }

}
