<?php

namespace App\Classes;
use Illuminate\Support\Facades\Storage;

class Upload
{
    public function save($request)
    {
         $image = $request->file('image');
         $folder = strstr($request->user()->email, '@', true);
         $year = date('Y');
         $month = date('m');

         $directory = "{$folder}/{$year}/{$month}";

         Storage::makeDirectory($directory);
         $imagePath = Storage::putFile($directory, $image);

         return $imagePath;
    }
}


