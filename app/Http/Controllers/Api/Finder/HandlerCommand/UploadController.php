<?php

namespace App\Http\Controllers\Api\Finder\HandlerCommand;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Classes\Upload;

class UploadController extends Controller
{
    private $baseDir = 'uploads';
    protected $upload;
    public function __construct(
        Upload $upload
    ) {
        $this->upload = $upload;
        $this->baseDir = public_path($this->baseDir);
    }

    public function upload(Request $request)
    {
        try {
            $a = $this->upload->move($request);

            if($this->upload->move($request) == null){
                return response()->json([
                    'message' => 'No file uploaded',
                ], 400);
            }
            return response()->json([
                'message' => 'File uploaded successfully',
                'data' => $a
            ]);


        } catch (\Exception $th) {
            return response()->json([
                'message' => 'Failed to upload file',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
