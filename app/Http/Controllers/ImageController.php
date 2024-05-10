<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|file|image|mimes:png,jpg|max:10000|mimetypes:image/jpeg,image/png,image/jpg'
        ]);

        $file = $request->image;
        $originalName = $file->getClientOriginalName();

         // Check for double extensions in the file name
         if (preg_match('/\.[^.]+\./', $originalName)) {
            throw new Exception(trans('general.notAllowedAction'), 403);
        }

        $fileName = Str::random(32);
        $mime_type = $file->getClientMimeType();
        $type = explode('/', $mime_type);

        $path = Storage::disk('public')->put('images',$file,$fileName.'.'.$type[1]);
        $path = Storage::disk('public')->url($path);
    }
}
