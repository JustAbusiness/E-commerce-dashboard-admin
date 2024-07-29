<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;


trait FolderManagement
{
    private $basePath = 'app/public/uploads';
    public function __construct()
    {
    }

    public function getFolderList($directory = '', $level = 1)
    {
        $basePath = storage_path($this->basePath. DIRECTORY_SEPARATOR . $directory);
        $folder = [];

        $level = ($level > 5) ? 5 : $level;
        if (File::isDirectory($basePath)) {
            $directories = File::directories($basePath);
            foreach($directories as $subDirectories) {
                $folderName = basename($subDirectories);
                $newFolderParam = $directory !== '' ? $directory . DIRECTORY_SEPARATOR . $folderName : $folderName;
                $subFolder = $this->getFolderList($newFolderParam);

                $folder[] = [
                    'name' => $folderName,
                    'subFolder' => $subFolder
                ];
            }
        }

        return $folder;
    }

    public function getFiles($folderPath = '', $request)
    {
        $files = File::files($folderPath);
        $images = [];
        if (count($files)) {
            $allowedExtension = config('upload.allowed_extension');
            foreach ($files as $file) {
                $filename = $file->getFilename();
                $fileExtension = pathinfo($filename, PATHINFO_EXTENSION);
                if (in_array($fileExtension, $allowedExtension)) {
                    $filePath = 'uploads/' . $request->input('path') . '/' . str_replace('.' . $fileExtension, '', $filename);
                    $modified = Carbon::createFromTimestamp(filemtime($file->getPathname()))->format('Y-m-d H:i:s');

                    $images[] = [
                        'name' => $filename,
                        'src' => asset($filePath),
                        'path' => asset($filePath),
                        'size' => File::size($file),
                        'modified' => $modified,
                        'ext' => $fileExtension
                    ];
                }
            }
        }
        return $images;
    }
}

