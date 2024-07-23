<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\ResponseEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct
    (

    ) {

    }
    /**
     * Display a listing of the resource.
     */
    public function getModule()
    {
        $sidebar = trans('sidebar');
        return response()->json(
            $sidebar,
            ResponseEnum::OK
        );
    }

    /**
     *  Update status
     */
    public function updateStatus(Request $request)
    {
        $model = $request->input('model');
        $subFolder = str_replace('Catalogue', '', $model);
        $folder = 'Services' . '\\' . $subFolder;
        $interface = 'Service';
        $class = loadClass($model, $folder, $interface);
        if($class->updateStatus($request, $subFolder)){ {
            return response()->json([
                'message' => 'Status updated successfully'
            ], ResponseEnum::OK);
        }
    }

}
}
