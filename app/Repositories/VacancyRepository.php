<?php

namespace App\Repositories;

use App\Models\Vacancy;

class VacancyRepository
{
    public function __construct(
        protected Vacancy $vacancy,
    ) {  
    }

    public function index()
    {
        return $this->vacancy
            ->with('company')
            ->get();
    }
}