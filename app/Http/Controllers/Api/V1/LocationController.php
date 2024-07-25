<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;
use App\Repositories\Interfaces\DistrictRepositoryInterface as DistrictRepository;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    protected $provinceRepository;
    protected $districtRepository;
    public function __construct(
        ProvinceRepository $provinceRepository,
        DistrictRepository $districtRepository
    )
    {
        $this->provinceRepository  = $provinceRepository;
        $this->districtRepository = $districtRepository;
    }

    public function provinces()
    {
        $provinces = $this->provinceRepository->all();
        return response()->json([
            'message' => 'Provinces fetched successfully',
            'data' => $provinces
        ], 200);
    }

    public function location(Request $request)
    {
        $location = [];
        $repository = ($request->input('relation') == 'districts') ?  'provinceRepository' : 'districtRepository';
        $model = $this->{$repository}->findById($request->input('id'), ['code', 'name'], [$request->input('relation')]);

        return response()->json([
            'message' => 'Location fetched successfully',
            'data' => $model->{$request->input('relation')}
        ], 200);
    }
}
