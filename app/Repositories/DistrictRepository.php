<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\DistrictRepositoryInterface;
use App\Models\District;

class DistrictRepository extends BaseRepository implements DistrictRepositoryInterface
{
    protected $moodel;
    public function __construct(
        District $model
    )
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }
}

