<?php

namespace App\Http\Controllers;

use App\Services\CompanyService;

class CompanyController extends Controller
{
    public function __construct(
        protected CompanyService $service,
    ) { 
    }
    
    public function index()
    {
        return $this->service->index();
    }
}