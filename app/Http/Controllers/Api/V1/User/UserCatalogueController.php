<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\UserCatalogue\UserCatalogueStoreRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\User\UserCatalogueServiceInterface as UserCatalogueService;
use App\Http\Resources\UserCatalogueResource;

class UserCatalogueController extends Controller
{
    protected $userCatalogueService;
    public function __construct
    (
        UserCatalogueService $userCatalogueService
    ) {
        $this->userCatalogueService = $userCatalogueService;
    }

    public function index(Request $request)
    {
        $userCatalogues = $this->userCatalogueService->paginate($request);
        return response()->json([
            'message' => 'User Catalogue fetched successfully',
            'data' => $userCatalogues
        ], 200);
    }

    public function store(UserCatalogueStoreRequest $request)
    {
        if ($this->userCatalogueService->create($request)) {
            return response()->json([
                'message' => 'User Catalogue created successfully'
            ], 201);
        }

        return response()->json([
            'message' => 'User Catalogue creation failed'
        ], 422);
    }
}
