<?php

namespace App\Repositories;

use App\Models\Plan;

class PlanRepository
{
    public function __construct(
        protected Plan $plan,
    ) {  
    }
    
    public function index()
    {
        return $this->plan->all();
    }

    public function show(int $id)
    {
        return $this->plan
            ->where('id', $id)
            ->first();
    }

    public function create(array $data)
    {
        return $this->plan->create($data);
    }
}