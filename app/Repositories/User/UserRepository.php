<?php

namespace App\Repositories\User;

use App\Repositories\Interfaces\User\UserRepositoryInterface;
use App\Models\UserCatalogue;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected $model;
    public function __construct
    (
        UserCatalogue $model
    )
    {
        $this->model = $model;
    }
}
