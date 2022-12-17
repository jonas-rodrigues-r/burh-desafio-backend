<?php

namespace App\Http\Controllers;

use App\Services\PlanService;

use App\Models\Plan;

class PlanController extends Controller
{
    public function __construct(
        protected PlanService $service,
    ) { 
    }
    
    public function index()
    {
        return Plan::all();
    }

    public function show(int $id)
    {
        return $this->service->show($id);
    }
}