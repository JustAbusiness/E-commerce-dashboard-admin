<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;


trait FolderManagement
{
    private $basePath = 'app/public/uploads';
    public function __construct()
    {
    }

    public function getFolderList($directory = '')
    {
        $basePath = storage_path($this->basePath. DIRECTORY_SEPARATOR . $directory);
        $folder = [];

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
}