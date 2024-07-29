<?php

namespace App\Http\Controllers\Api\Finder\HandlerCommand;

use App\Http\Controllers\Controller;
use App\Traits\FolderManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class RenameFolderController extends Controller
{
    use FolderManagement;
    private $command = 'CreateFolder';
    private $baseDir;
    public function __construct()
    {
        $this->baseDir = public_path(config('upload.baseDir'));
    }

    public function rename(Request $request)
    {
        try {

            $oldeFolderPath = $this->baseDir . '/' . $request->input('parentPath');
            $newFolderPath = $this->baseDir . '/' . str_replace(basename($request->input('parentPath')), Str::slug($request->input('folder')), $request->input('parentPath'));

            if (File::exists($oldeFolderPath)) {
                File::move($oldeFolderPath, $newFolderPath);

                return response()->json([
                    'message' => 'Folder renamed successfully',
                    'data' => $this->getFolderList()
                ]);
            }

            return response()->json([
                'message' => 'Folder not found',
            ], 404);
        } catch (\Exception $th) {
            return response()->json([
                'message' => 'Failed to create folder',
                'error' => $th->getMessage()
            ], 500);
        }

    }
}
