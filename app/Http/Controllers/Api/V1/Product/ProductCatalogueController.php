<?php

namespace App\Http\Controllers\Api\V1\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Product\UpdateProductCatalogueRequest;
use Illuminate\Http\Request;
use App\Http\Requests\V1\Product\ProductCatalogueRequest;
use App\Http\Resources\ProductCatalogueResource;
use App\Services\Interfaces\Product\ProductCatalogueServiceInterface as ProductCatalogueService;
use App\Repositories\Interfaces\Product\ProductCatalogueRepositoryInterface as ProductCatalogueRepository;

class ProductCatalogueController extends Controller
{


    protected $productCatalogueService;
    protected $productCatalogueRepository;
    public function __construct
    (
        ProductCatalogueService $productCatalogueService,
        ProductCatalogueRepository $productCatalogueRepository
    ) {
        $this->productCatalogueService = $productCatalogueService;
        $this->productCatalogueRepository = $productCatalogueRepository;
    }

    public function index(Request $request)
    {
        $productCatalogues = $this->productCatalogueService->paginate($request);
        return response()->json([
            'message' => 'product Catalogue fetched successfully',
            'data' => $productCatalogues
        ], 200);
    }

    public function all()
    {
        return response()->json([
            'message' => 'product Catalogue fetched successfully',
            'data' => $this->productCatalogueRepository->all()
        ], 200);
    }

    public function read(Request $request, $id)
    {

        $productCatalogue = $this->productCatalogueRepository->findById($id);
        if ($productCatalogue) {
            return response()->json([
                'message' => 'product Catalogue fetched successfully',
                'data' => new ProductCatalogueResource($productCatalogue)
            ], 200);
        }

        return response()->json([
            'message' => 'product Catalogue not found',
        ], 404);
    }
    public function store(ProductCatalogueRequest $request)
    {
        if ($this->productCatalogueService->create($request)) {
            return response()->json([
                'message' => 'product Catalogue created successfully'
            ], 201);
        }

        return response()->json([
            'message' => 'product Catalogue creation failed'
        ], 422);
    }

    public function update(UpdateProductCatalogueRequest $request, $id)
    {
        if ($this->productCatalogueService->update($request, $id)) {
            return response()->json([
                'message' => 'Product Catalogue updated successfully'
            ], 200);
        }

        return response()->json([
            'message' => 'Product Catalogue cannot update'
        ], 500);
    }

    public function deleteAll(Request $request)
    {
        if ($this->productCatalogueService->deleteAll($request)) {
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
        $productCatalogue = $this->productCatalogueService->destroy($id);
        if ($productCatalogue) {
            return response()->json([
                'message' => 'productCatalogue deleted successfully'
            ], 200);
        }

        return response()->json([
            'message' => 'productCatalogue not found'
        ], 404);
    }



}
