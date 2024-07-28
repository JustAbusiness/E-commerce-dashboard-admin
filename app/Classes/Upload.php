<?php

namespace App\Classes;

use Illuminate\Support\Facades\Storage;
use Leage\Glide\ServerFactory;
use League\Glide\Responses\LaravelResponseFactory;
use Illuminate\Support\Facades\File;

class Upload
{
    public function __construct()
    {
        //
    }

    public function save($request)
    {
        $image = $request->file('image');
        $folder = strstr($request->user()->email, '@', true);
        $year = date('Y');
        $month = date('m');

        $directory = "{$folder}/{$year}/{$month}";

        Storage::makeDirectory($directory);
        $imagePath = Storage::putFile($directory, $image);

        return str_replace("public", "storage", $imagePath);
    }

    public function move($request)
    {
        $path = $request->input('path');
        $savePath = public_path('uploads/' . $path);
        $thumbPath = public_path('uploads/thumbs');
        if (!File::exists($thumbPath)) {
            File::makeDirectory($thumbPath, 0777, true, true);
        }

        $temp = [];
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $filename = $file->getClientOriginalName();
                $temp[] = $filename;
                $file->move($savePath, $filename);
            }
        }
        return $temp;
    }
}


