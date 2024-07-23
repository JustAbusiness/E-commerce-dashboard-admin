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

    public function pagination(int $perpage = 20, array $condition = [], array $fieldSearch = [])
    {
        return $this->model
            ->keyword(($condition['keyword']) ?? null)    // => from Query Scope
            ->publish(($condition['publish']) ?? null)    // => from Query Scope
            ->RelationCount(['users'])
            ->paginate($perpage);
    }

    public function create(array $payload = [])
    {
        $model = $this->model->create($payload);
        return $model;
    }

}
