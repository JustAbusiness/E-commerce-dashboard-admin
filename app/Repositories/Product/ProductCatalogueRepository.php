<?php

namespace App\Repositories\Product;

use App\Repositories\Interfaces\Product\ProductCatalogueRepositoryInterface;
use App\Models\ProductCatalogue;
use App\Repositories\BaseRepository;

class ProductCatalogueRepository extends BaseRepository implements ProductCatalogueRepositoryInterface
{
    protected $model;
    public function __construct
    (
        ProductCatalogue $model
    )
    {
        $this->model = $model;
    }
}
