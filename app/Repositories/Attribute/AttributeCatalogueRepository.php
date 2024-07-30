<?php

namespace App\Repositories\Attribute;

use App\Repositories\Interfaces\Attribute\AttributeCatalogueRepositoryInterface;
use App\Models\AttributeCatalogue;
use App\Repositories\BaseRepository;

class AttributeCatalogueRepository extends BaseRepository implements AttributeCatalogueRepositoryInterface
{
    protected $model;
    public function __construct
    (
       AttributeCatalogue $model
    )
    {
        $this->model = $model;
    }
}

