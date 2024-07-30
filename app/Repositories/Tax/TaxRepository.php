<?php

namespace App\Repositories\Tax;

use App\Repositories\Interfaces\Tax\TaxRepositoryInterface;
use App\Models\Tax;
use App\Repositories\BaseRepository;

class TaxRepository extends BaseRepository implements TaxRepositoryInterface
{
    protected $model;
    public function __construct
    (
        Tax $model
    )
    {
        $this->model = $model;
    }
}
