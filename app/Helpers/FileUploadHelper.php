<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class FileUploadHelper
{
    public static function saveImage(UploadedFile $image) {
         $path = 'images/' . Str::random();
        if(!Storage::exists($path)) {
            Storage::makeDirectory($path, 0755, true);
        }
        if(!Storage::putFileAS('public/' . $path, $image, $image->getClientOriginalName())) {
            throw new \Exception("Unable to save file \"{$image->getClientOriginalName()}\"");
        }

        return $path . '/' . $image->getClientOriginalName();
    }
}
