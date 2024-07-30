<?php

namespace App\Services\Interfaces\Tax;

/**
 * Interface UserCatalogueServiceInterface
 * @package App\Services\Interfaces\User
 */

 interface TaxServiceInterface
 {
     public function create($request);
     public function paginate($request);
     public function deleteAll($request);
     public function destroy($id);
     public function update($request, $id);
 }
