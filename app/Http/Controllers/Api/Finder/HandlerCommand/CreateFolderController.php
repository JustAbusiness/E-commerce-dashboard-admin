<?php

namespace App\Http\Controllers\Api\Finder\HandlerCommand;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\FolderManagement;

class CreateFolderController extends Controller
{
    use FolderManagement;
    private $command = 'CreateFolder';
    public function __construct()
    {}

    public function buildRootFolder(Request $request)
    {
       $root = 'public'.$request->input('root');
       if (Storage::exists($root)) {
           Storage::makeDirectory($root);
       }

        $folderStructure = $this->getFolderList();
        return response()->json($folderStructure);

    }
}
