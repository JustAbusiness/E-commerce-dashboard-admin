<?php

namespace App\Http\Controllers\Api\V1\Attribute;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Attribute\StoreAttributeRequest;
use App\Http\Requests\V1\Attribute\UpdateAttributeRequest;
use App\Http\Resources\AttributeResource;
use Illuminate\Http\Request;
use App\Services\Interfaces\Attribute\AttributeCatalogueServiceInterface as AttributeCatalogueService;
use App\Repositories\Interfaces\Attribute\AttributeCatalogueRepositoryInterface as AttributeCatalogueRepository;

class AttributeController extends Controller
{


    protected $attributeService;
    protected $attributeRepository;
    public function __construct
    (
        AttributeCatalogueService $attributeService,
        AttributeCatalogueRepository $attributeRepository
    ) {
        $this->attributeService = $attributeService;
        $this->attributeRepository = $attributeRepository;
    }

    public function index(Request $request)
    {
        $attributes = $this->attributeService->paginate($request);
        return response()->json([
            'message' => 'product Catalogue fetched successfully',
            'data' => $attributes
        ], 200);
    }

    public function all()
    {
        return response()->json([
            'message' => 'attribute Catalogue fetched successfully',
            'data' => $this->attributeRepository->all()
        ], 200);
    }

    public function read(Request $request, $id)
    {

        $attribute = $this->attributeRepository->findById($id);
        if ($attribute) {
            return response()->json([
                'message' => 'product Catalogue fetched successfully',
                'data' => new AttributeResource($attribute)
            ], 200);
        }

        return response()->json([
            'message' => 'product Catalogue not found',
        ], 404);
    }
    public function store(StoreAttributeRequest $request)
    {
        if ($this->attributeService->create($request)) {
            return response()->json([
                'message' => 'attribute created successfully'
            ], 201);
        }

        return response()->json([
            'message' => 'product Catalogue creation failed'
        ], 422);
    }

    public function update(UpdateAttributeRequest $request, $id)
    {
        if ($this->attributeService->update($request, $id)) {
            return response()->json([
                'message' => 'Attribute updated successfully'
            ], 200);
        }

        return response()->json([
            'message' => 'Attribute cannot update'
        ], 500);
    }

    public function deleteAll(Request $request)
    {
        if ($this->attributeService->deleteAll($request)) {
            return response()->json([
                'message' => 'product Catalogue deleted successfully'
            ], 200);
        }

        return response()->json([
            'message' => 'product Catalogue deletion failed'
        ], 422);
    }

    public function delete($id)
    {
        $attribute = $this->attributeService->destroy($id);
        if ($attribute) {
            return response()->json([
                'message' => 'attribute deleted successfully'
            ], 200);
        }

        return response()->json([
            'message' => 'attribute not found'
        ], 404);
    }



}
