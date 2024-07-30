<?php

namespace App\Http\Controllers\Api\V1\Tax;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Tax\UpdateTaxRequest;
use Illuminate\Http\Request;
use App\Http\Requests\V1\Tax\StoreTaxRequest;
use App\Http\Resources\TaxResource;
use App\Services\Interfaces\Tax\TaxServiceInterface as TaxService;
use App\Repositories\Interfaces\Tax\TaxRepositoryInterface as TaxRepository;

class TaxController extends Controller
{


    protected $taxService;
    protected $taxRepository;
    public function __construct
    (
        TaxService $taxService,
        TaxRepository $taxRepository
    ) {
        $this->taxService = $taxService;
        $this->taxRepository = $taxRepository;
    }

    public function index(Request $request)
    {
        $taxs = $this->taxService->paginate($request);
        return response()->json([
            'message' => 'Tax fetched successfully',
            'data' => $taxs
        ], 200);
    }

    public function all()
    {
        return response()->json([
            'message' => 'Tax fetched successfully',
            'data' => $this->taxRepository->all()
        ], 200);
    }

    public function read(Request $request, $id)
    {

        $tax = $this->taxRepository->findById($id);
        if ($tax) {
            return response()->json([
                'message' => 'Tax fetched successfully',
                'data' => new TaxResource($tax)
            ], 200);
        }

        return response()->json([
            'message' => 'Tax not found',
        ], 404);
    }
    public function store(StoreTaxRequest $request)
    {
        if ($this->taxService->create($request)) {
            return response()->json([
                'message' => 'Tax created successfully'
            ], 201);
        }

        return response()->json([
            'message' => 'Tax creation failed'
        ], 422);
    }

    public function update(UpdateTaxRequest $request, $id)
    {
        if ($this->taxService->update($request, $id)) {
            return response()->json([
                'message' => 'Tax updated successfully'
            ], 200);
        }

        return response()->json([
            'message' => 'Tax cannot update'
        ], 500);
    }

    public function deleteAll(Request $request)
    {
        if ($this->taxService->deleteAll($request)) {
            return response()->json([
                'message' => 'Tax deleted successfully'
            ], 200);
        }

        return response()->json([
            'message' => 'Tax deletion failed'
        ], 422);
    }

    public function delete($id)
    {
        $tax = $this->taxService->destroy($id);
        if ($tax) {
            return response()->json([
                'message' => 'tax deleted successfully'
            ], 200);
        }

        return response()->json([
            'message' => 'tax not found'
        ], 404);
    }



}
