<?php

namespace App\Http\Controllers\Api\Finder\HandlerCommand;

use App\Http\Controllers\Controller;
use App\Traits\FolderManagement;
use Illuminate\Http\Request;

class ListController extends Controller
{
    use FolderManagement;
    private $baseDir;
    public function __construct()
    {
        $this->baseDir = public_path(config($this->baseDir));
    }

    public function list(Request $request)
    {
        try {
            $folderPath = $this->baseDir . '/' . $request->input('path');
            dd($folderPath);
            $file = $this->getFiles($folderPath, $request);

            return response()->json([
                'message' => 'Folder list',
                'files' => $file
            ], 200);
        } catch (\Exception $th) {
            return response()->json([
                'message' => 'Failed to get folder',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
