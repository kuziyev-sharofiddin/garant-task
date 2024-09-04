<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Services\BaseService;

class CategoryService extends BaseService
{
    public function __construct(CategoryRepository $repo)
    {
        $this->repo = $repo;
    }
}
