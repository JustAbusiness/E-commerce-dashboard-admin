<?php

namespace App\Services\Interfaces\Attribute;

/**
 * Interface UserCatalogueServiceInterface
 * @package App\Services\Interfaces\User
 */

 interface AttributeCatalogueServiceInterface
 {
     public function create($request);
     public function paginate($request);
     public function deleteAll($request);
     public function destroy($id);
     public function update($request, $id);
 }
