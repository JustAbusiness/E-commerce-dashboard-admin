<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\ResponseEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\BaseService;
class DashboardController extends Controller
{
    protected $baseService;
    public function __construct
    (
        BaseService $baseService
    ) {
        $this->baseService = $baseService;
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
        if ($class->updateStatus($request, $subFolder)) { {
                return response()->json([
                    'message' => 'Status updated successfully'
                ], ResponseEnum::OK);
            }
        }
    }

    /**
     *  Update status all
     */
    public function updateStatusAll(Request $request)
    {
        $model = $request->input('model');
        $subFolder = str_replace('Catalogue', '', $model);
        $folder = 'Services' . '\\' . $subFolder;
        $interface = 'Service';
        $class = loadClass($model, $folder, $interface);

        if ($class->updateStatusAll($request, $subFolder)) {
            return response()->json([
                'message' => 'Status updated successfully'
            ], ResponseEnum::OK);
        }

        return response()->json([
            'message' => 'Status update failed'
        ], 500);
    }
}
