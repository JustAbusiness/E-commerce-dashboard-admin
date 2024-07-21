<?php

namespace App\Services\User;

use App\Services\Interfaces\User\UserCatalogueServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\Interfaces\User\UserCatalogueRepositoryInterface as UserCatalogueRepository;

class UserCatalogueService implements UserCatalogueServiceInterface
{
    protected $userCatalogueRepository;
    protected $payload = ['name', 'description'];
    public function __construct
    (
        UserCatalogueRepository $userCatalogueRepository
    )
    {
        $this->userCatalogueRepository = $userCatalogueRepository;
    }

    public function paginate()
    {
        dd(1);
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

}
