<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use App\Model\Base;

/**
 * Class BaseRepository
 * @package App\Repositories
 */

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct
    (
        Model $model
    ) {
        $this->model = $model;
    }

    public function pagination(array $param = [])
    {
     return $this->model->RelationCount(['users'])

     ->paginate($param['perpage']);
    }

    public function create(array $payload = [])
    {
        $model = $this->model->create($payload);
        return $model;
    }

}
