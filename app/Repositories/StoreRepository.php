<?php

namespace App\Repositories;


use App\Models\Store;
use App\Repositories\BaseRepository;

class StoreRepository extends BaseRepository
{
    public function __construct(Store $entity)
    {
        $this->entity = $entity;
    }
}
