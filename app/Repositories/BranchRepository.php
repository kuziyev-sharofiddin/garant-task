<?php

namespace App\Repositories;

use App\Models\Branch;
use App\Repositories\BaseRepository;

class BranchRepository extends BaseRepository
{
    public function __construct(Branch $entity)
    {
        $this->entity = $entity;
    }
}
