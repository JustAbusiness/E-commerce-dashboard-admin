<?php

namespace App\Services\Interfaces\User;

/**
 * Interface UserCatalogueServiceInterface
 * @package App\Services\Interfaces\User
 */

 interface UserCatalogueServiceInterface
 {
     public function create($request);
     public function paginate($request);
     public function deleteAll($request);
 }
