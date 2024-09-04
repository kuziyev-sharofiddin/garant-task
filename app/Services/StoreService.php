<?php

namespace App\Services;


use App\Repositories\StoreRepository;
use App\Services\BaseService;


class StoreService extends BaseService
{
    public function __construct(StoreRepository $repo)
    {
        $this->repo = $repo;
    }
}
