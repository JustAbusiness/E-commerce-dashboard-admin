<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\UserCatalogue\UserCatalogueStoreRequest;
use App\Http\Resources\UserCatalogueResource;
use Illuminate\Http\Request;
use App\Services\Interfaces\User\UserCatalogueServiceInterface as UserCatalogueService;
use App\Repositories\Interfaces\User\UserCatalogueRepositoryInterface as UserCatalogueRepository;


class UserCatalogueController extends Controller
{
    protected $userCatalogueService;
    protected $userCatalogueRepository;
    public function __construct
    (
        UserCatalogueService $userCatalogueService,
        UserCatalogueRepository $userCatalogueRepository
    ) {
        $this->userCatalogueService = $userCatalogueService;
        $this->userCatalogueRepository = $userCatalogueRepository;
    }

    public function index(Request $request)
    {
        $userCatalogues = $this->userCatalogueService->paginate($request);
        return response()->json([
            'message' => 'User Catalogue fetched successfully',
            'data' => new UserCatalogueResource($userCatalogues)
        ], 200);
    }

    public function read(Request $request, $id)
    {

        $userCatalogue = $this->userCatalogueRepository->findById($id);
        if ($userCatalogue) {
            return response()->json([
                'message' => 'User Catalogue fetched successfully',
                'data' => new UserCatalogueResource($userCatalogue)
            ], 200);
        }

        return response()->json([
            'message' => 'User Catalogue not found',
        ], 404);
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

    public function update(Request $request, $id)
    {
        if ($this->userCatalogueService->update($request, $id)) {
            return response()->json([
                'message' => 'User Catalogue updated successfully'
            ], 200);
        }

        return response()->json([
            'message' => 'User Catalogue cannot update'
        ], 500);
    }

    public function deleteAll(Request $request)
    {
        if ($this->userCatalogueService->deleteAll($request)) {
            return response()->json([
                'message' => 'User Catalogue deleted successfully'
            ], 200);
        }

        return response()->json([
            'message' => 'User Catalogue deletion failed'
        ], 422);
    }

    public function delete($id)
    {
        $userCatalogue = $this->userCatalogueService->destroy($id);
        if ($userCatalogue) {
            return response()->json([
                'message' => 'User Catalogue deleted successfully'
            ], 200);
        }

        return response()->json([
            'message' => 'User Catalogue not found'
        ], 404);
    }
}
