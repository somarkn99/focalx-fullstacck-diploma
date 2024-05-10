<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use League\Flysystem\Visibility;

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

        // Save the file and get the path within the storage disk
        $storagePath = Storage::disk('public')->put('images', $file, [
            'visibility' => Visibility::PUBLIC
        ]);

        // Generate the URL to access the stored file
        $url = Storage::disk('public')->url($storagePath);

        return $url;  // You should return or use the URL as needed in your application
    }
}
