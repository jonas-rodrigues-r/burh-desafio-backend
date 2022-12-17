<?php

namespace App\Http\Controllers;

use App\Services\VacancyService;

class VacancyController extends Controller
{
    public function __construct(
        protected VacancyService $service,
    ) { 
    }

    public function index()
    {
        return $this->service->index();
    }
}