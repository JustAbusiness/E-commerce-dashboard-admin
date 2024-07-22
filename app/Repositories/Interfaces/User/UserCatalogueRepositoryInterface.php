<?php

namespace App\Repositories\Interfaces\User;

/**
 * Interface UserCatalogueServiceInterface
 * @package App\Repositori\Interfaces\User\Interfaces\User
 */

 interface UserCatalogueRepositoryInterface
 {
    public function create(array $payload = []);
    public function pagination(array $param = []);
 }
