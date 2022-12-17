<?php

namespace App\Services;

use App\Repositories\CompanyRepository;

class CompanyService
{
    public function __construct(
        protected CompanyRepository $repository
    ) {
    }
    
    public function index()
    {
        return $this->repository->index();
    }
}