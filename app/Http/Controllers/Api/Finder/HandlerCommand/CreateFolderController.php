<?php

namespace App\Http\Controllers\Api\Finder\HandlerCommand;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\FolderManagement;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CreateFolderController extends Controller
{
    use FolderManagement;
    private $command = 'CreateFolder';
    private $baseDir = 'uploads';

    public function __construct()
    {
        $this->baseDir = 'public/' . $this->baseDir;
    }

    public function buildRootFolder(Request $request)
    {
        try {
            $root = $this->baseDir . '/images';
            if (!File::exists($root)) {
                File::makeDirectory($root, 0777, true, true);
            }
            $folderStructure = $this->getFolderList();
            return response()->json([
                'message' => 'Root folder created successfully',
                'data' => $folderStructure
            ]);

        } catch (\Exception $th) {
            return response()->json([
                'message' => 'Failed to create root folder',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function create(Request $request)
    {
        try {
            $parentPath = $request->input('parentPath');
            $folderName = Str::slug($request->input('folderName'));

            $path = $this->baseDir . '/images/' . $parentPath . '/' . $folderName;
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);


                $folderStructure = $this->getFolderList();
                return response()->json([
                    'message' => 'Folder created successfully',
                    'data' => $folderStructure
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Failed to create folder',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
