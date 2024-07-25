<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\User\User\UserUpdateRequest;
use App\Http\Resources\UserCatalogueResource;
use App\Http\Requests\V1\User\UserStoreRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\User\UserServiceInterface as UserService;
use App\Repositories\Interfaces\User\UserRepositoryInterface as UserRepository;


class UserController extends Controller
{
    protected $userService;
    protected $userRepository;
    public function __construct
    (
        UserService $userService,
        UserRepository $userRepository
    ) {
        $this->userService = $userService;
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $users = $this->userService->paginate($request);
        return response()->json([
            'message' => 'User fetched successfully',
            'data' => new UserCatalogueResource($users)
        ], 200);
    }

    public function all()
    {
        return response()->json([
            'message' => 'User Catalogue fetched successfully',
            'data' => $this->userRepository->all()
        ], 200);
    }


    // public function read(Request $request, $id)
    // {

    //     $userCatalogue = $this->userCatalogueRepository->findById($id);
    //     if ($userCatalogue) {
    //         return response()->json([
    //             'message' => 'User Catalogue fetched successfully',
    //             'data' => new UserCatalogueResource($userCatalogue)
    //         ], 200);
    //     }

    //     return response()->json([
    //         'message' => 'User Catalogue not found',
    //     ], 404);
    // }

    public function store(UserStoreRequest $request)
    {
        if ($this->userService->create($request)) {
            return response()->json([
                'message' => 'User created successfully'
            ], 201);
        }

        return response()->json([
            'message' => 'User creation failed'
        ], 422);
    }

    public function update(UserUpdateRequest $request, $id)
    {
        if ($this->userService->update($request, $id)) {
            return response()->json([
                'message' => 'User Catalogue updated successfully'
            ], 200);
        }

        return response()->json([
            'message' => 'User Catalogue cannot update'
        ], 500);
    }

    public function delete($id)
    {
        $userCatalogue = $this->userService->destroy($id);
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
