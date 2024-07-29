<?php

namespace App\Services\Interfaces\Product;

/**
 * Interface UserCatalogueServiceInterface
 * @package App\Services\Interfaces\User
 */

 interface ProductCatalogueServiceInterface
 {
     public function create($request);
     public function paginate($request);
     public function deleteAll($request);
     public function destroy($id);
     public function update($request, $id);
 }
