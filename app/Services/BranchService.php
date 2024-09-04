<?php

namespace App\Services;

use App\Repositories\BranchRepository;
use App\Services\BaseService;

class BranchService extends BaseService
{
    public function __construct(BranchRepository $repo)
    {
        $this->repo = $repo;
    }
}
