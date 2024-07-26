<?php

namespace App\Services\User;

use App\Services\BaseService;
use App\Services\Interfaces\User\UserCatalogueServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\Interfaces\User\UserCatalogueRepositoryInterface as UserCatalogueRepository;

class UserCatalogueService extends BaseService implements UserCatalogueServiceInterface
{
    protected $userCatalogueRepository;
    protected $payload = ['name', 'description'];
    protected $fieldSearch = ['name'];

    public function __construct
    (
        UserCatalogueRepository $userCatalogueRepository
    )
    {
        $this->userCatalogueRepository = $userCatalogueRepository;
    }

    public function paginate($request)
    {
        $perpage = ($request->input('perpage')) ? $request->input('perpage') : 20;
        $condition = [
            'keyword' => $request->input('keyword'),
            'publish' => $request->input('publish'),
        ];
        $relation = ['users'];
        $extend = [
            'orderBy' => ['id', 'desc']
        ];

        $userCatalogue = $this->userCatalogueRepository->pagination($perpage, $condition, $this->fieldSearch, $relation, $extend);
        return $userCatalogue;
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->only($this->payload);
            $this->userCatalogueRepository->create($payload);
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
            $this->userCatalogueRepository->forceDeleteAll($ids);
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
            $this->userCatalogueRepository->update($payload, $id);

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
            $this->userCatalogueRepository->deleteId($id);
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
            return false;
        }
    }

}
