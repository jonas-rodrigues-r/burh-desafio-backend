<?php

namespace App\Repositories;

use App\Models\Plan;
use Illuminate\Support\Collection;

class PlanRepository
{
    public function __construct(
        protected Plan $plan,
    ) {  
    }
    
    public function index(): Collection
    {
        return $this->plan->select(config('plan.select_fields'))->get();
    }

    public function show(int $id): ?Plan
    {
        return $this->plan
            ->select(config('plan.select_fields'))
            ->where('id', $id)
            ->first();
    }

    public function create(array $data): Plan
    {
        return $this->plan->create($data);
    }

    public function update(Plan $data): bool
    {
        return $data->update();
    }

    public function delete(Plan $data): bool
    {
        return $data->delete();
    }
}