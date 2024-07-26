<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\User\User\UserUpdateRequest;
use App\Http\Requests\V1\User\UserStoreRequest;
use App\Http\Resources\UserResource;
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
            'data' => $users
        ], 200);
    }

    public function all()
    {
        return response()->json([
            'message' => 'User Catalogue fetched successfully',
            'data' => $this->userRepository->all()
        ], 200);
    }


    public function read($id)
    {

       $user = $this->userRepository->findById($id);
       return new UserResource($user);
    }

    public function store(UserStoreRequest $request)
    {
        if ($this->userService->create($request)) {
            return response()->json([
                'message' => 'User created successfully'
            ], 200);
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
