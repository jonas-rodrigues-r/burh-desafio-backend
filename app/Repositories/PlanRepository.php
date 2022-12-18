<?php

namespace App\Repositories;

use App\Models\Plan;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class PlanRepository
{
    protected string $keyBase = 'burh:plan:';

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
        return Cache::remember(config('plan.key_base') . $id, config('plan.tll_redis'), function () use ($id) {
            return $this->plan
                ->select(config('plan.select_fields'))
                ->where('id', $id)
                ->first();
        });
    }

    public function create(array $data): Plan
    {
        $plan = $this->plan->create($data);

        return Cache::remember(config('plan.key_base') . $plan->id, config('plan.tll_redis'), function () use ($plan) {
            return $plan;
        });
    }

    public function update(Plan $data): bool
    {
        $plan = $data->update();

        Cache::forget(config('plan.key_base') . $data->id);

        Cache::remember(config('plan.key_base') . $data->id, config('plan.tll_redis'), function () use ($data) {
            return $data;
        });

        return $plan;
    }

    public function delete(Plan $data): bool
    {
        $plan = $data->delete();

        Cache::forget(config('plan.key_base') . $data->id);

        return $plan;
    }
}