<?php

namespace App\Repositories\User;

use App\Repositories\Interfaces\User\UserCatalogueRepositoryInterface;
use App\Models\UserCatalogue;
use App\Repositories\BaseRepository;

class UserCatalogueRepository extends BaseRepository implements UserCatalogueRepositoryInterface
{
    protected $model;
    public function __construct
    (
        UserCatalogue $model
    )
    {
        $this->model = $model;
    }

    // public function create(array $payload): UserCatalogue
    // {
    //     return UserCatalogue::create($payload);
    // }
}
