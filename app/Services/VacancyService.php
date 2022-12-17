<?php

namespace App\Services;

use App\Repositories\VacancyRepository;

class VacancyService
{
    public function __construct(
        protected VacancyRepository $repository,
    ) {  
    }

    public function index()
    {
        return $this->repository->index();
    }
}