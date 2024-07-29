<?php

namespace App\Http\Controllers\Api\Finder\HandlerCommand;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Classes\Upload;
use App\Traits\FolderManagement;
use App\Http\Requests\UploadImageRequest;

class UploadController extends Controller
{
    use FolderManagement;
    private $baseDir;
    protected $upload;
    public function __construct(
        Upload $upload
    ) {
        $this->upload = $upload;
        $this->baseDir = public_path(config('upload.baseDir'));
    }

    public function upload(UploadImageRequest $request)
    {
        try {
            if ($this->upload->move($request)) {
                $imageFolder = $this->baseDir . $request->input('path');
                $file = $this->getFiles($imageFolder, $request);

                return response()->json([
                    'message' => 'File uploaded successfully',
                    'files' => $file
                ], 200);
            }

            return response()->json([
                'message' => 'Failed to upload file',
            ], 500);

        } catch (\Exception $th) {
            return response()->json([
                'message' => 'Failed to upload file',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
