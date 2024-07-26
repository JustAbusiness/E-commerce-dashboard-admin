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

    public function all()
    {
        return $this->model->all();
    }

    public function pagination(int $perpage = 20, array $condition = [], array $fieldSearch = [], array $relation = [], array $extend = [])
    {
        return $this->model
            ->keyword(($condition['keyword']) ?? null)    // => from Query Scope
            ->publish(($condition['publish']) ?? null)    // => from Query Scope
            // ->orderBy($extend['orderBy'] ?? ['id', 'desc'])    // => from Query Scope
            ->relationCount(['users'])
            ->paginate($perpage);
    }

    public function create(array $payload = [])
    {
        $model = $this->model->create($payload);
        return $model;
    }

    public function update(array $payload = [], int $id = 0)
    {
        $model= $this->findById($id);
        $model->fill($payload);  // Điền dữ liệu mới vào mô hình từ mảng $payload
        $model->save();
        return $model;
    }

    public function forceDeleteAll(array $ids = [])
    {
        return $this->model->whereIn('id', $ids)->forceDelete();
    }

    public function updateByIds(array $ids = [], $payload = [])
    {
        return $this->model->whereIn('id', $ids)->update($payload);
    }

    public function deleteId(int $id)
    {
        return $this->model->where('id', $id)->forceDelete();
    }

    public function findById
    (
        int $modelId,
        array $column = ['*'],
        array $relation = [],
    )
    {
        return $this->model->select($column)->with($relation)->findOrFail($modelId);

    }
}
