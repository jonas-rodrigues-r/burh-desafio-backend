<?php

namespace App\Services;

use App\Repositories\PlanRepository;

class PlanService
{
    public function __construct(
        protected PlanRepository $repository
    ) {
    }
    
    public function index()
    {
        return $this->repository->index();
    }
}