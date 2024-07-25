<?php

namespace App\Services\User;

use App\Services\BaseService;
use App\Services\Interfaces\User\UserServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\Interfaces\User\UserRepositoryInterface as UserRepository;
use App\Classes\Upload;

class UserService extends BaseService implements UserServiceInterface
{
    protected $userRepository;
    protected $payload = ['name', 'description', 'districtId', 'email', 'image', 'password', 'provinceId', 'userCatalogueId'];
    protected $fieldSearch = ['name'];

    protected $upload;

    public function __construct
    (
        UserRepository $userRepository,
        Upload $upload
    )
    {
        $this->userRepository = $userRepository;
        $this->upload = $upload;
    }

    public function paginate($request)
    {
        $perpage = ($request->input('perpage')) ? $request->input('perpage') : 20;
        $condition = [
            'keyword' => $request->input('keyword'),
            'publish' => $request->input('publish'),
        ];

        $user = $this->userRepository->pagination($perpage, $condition, $this->fieldSearch);
        return $user;
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->only($this->payload);
            $payload['image'] = $this->upload->save($request);

            $this->userRepository->create($payload);
            DB::commit();
            return true;
        } catch (\Exception $th) {
            DB::rollBack();
            Log::error($th->getMessage());
            return false;
        }
    }

    public function deleteAll($request)
    {
        DB::beginTransaction();
        try {
            $ids = explode(',', $request->input('ids'));
            $this->userRepository->forceDeleteAll($ids);
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
            return false;
        }
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $payload = $request->only('name', 'description');
            $this->userRepository->update($payload, $id);

            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
            return false;
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $this->userRepository->deleteId($id);
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
            return false;
        }
    }

}
