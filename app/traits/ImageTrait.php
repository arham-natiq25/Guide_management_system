<?php
 namespace App\traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

trait ImageTrait {

    function UploadImage(Request $request , $inputName ,$path) {

    // get input name here
    $image = $request->{$inputName};
     // take of client extension
    $ext = $image->getClientOriginalExtension();
     // assigning of new path
    $imageName = 'media'.uniqid().'.'.$ext;
    // move into public funtion
    $image->move(public_path($path),$imageName);
     // return path to store in db
    return $path.'/'.$imageName;
    }

    function updateImage(Request $request , $inputName, $path,$oldpath=null)  {
        if ($request->hasFile($inputName)) {

            if (File::exists(public_path($oldpath))) {
                File::delete(public_path($oldpath));
                # code...
            }
            $image = $request->{$inputName};
            $ext = $image->getClientOriginalExtension();
            $imageName = 'media'.uniqid().'.'.$ext;
            $image->move(public_path($path),$imageName);

            return $path.'/'.$imageName;

          }
    }


    function deleteImage(string $path) {
        if (File::exists(public_path($path))) {
            File::delete(public_path($path));
            # code...
        }
    }
 }
