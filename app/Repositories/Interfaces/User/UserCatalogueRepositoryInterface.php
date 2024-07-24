<?php

namespace App\Repositories\Interfaces\User;

/**
 * Interface UserCatalogueServiceInterface
 * @package App\Repositori\Interfaces\User\Interfaces\User
 */

 interface UserCatalogueRepositoryInterface
 {
    public function create(array $payload = []);
    public function pagination(int $perpage = 20, array $condition = [], array $fieldSearch = []);
    public function forceDeleteAll(array $ids = []);
    public function findById(int $modelId);
    public function deleteId(int $id);
 }
