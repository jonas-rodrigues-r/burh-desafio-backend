<?php

namespace App\Repositories;

use App\Models\Company;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CompanyRepository
{
    public function __construct(
        protected Company $company,
    ) {  
    }
    
    public function index(): Collection
    {
        return $this->company
            ->select(config('company.select_fields'))
            ->with('plan')
            ->get();
    }

    public function show(int $id): ?Company
    {
        return Cache::remember(config('company.key_base') . $id, config('company.tll_redis'), function () use ($id) {
            return $this->company
                ->select(config('company.select_fields'))
                ->where('id', $id)
                ->with('plan')
                ->first();
            }
        );
    }

    public function create(array $data): Company
    {
        $company = $this->company->create($data);

        return Cache::remember(config('company.key_base') . $company->id, config('company.tll_redis'), function () use ($company) {
            return $company;
        });
    }

    public function update(Company $data): bool
    {
        $company = $data->update();

        Cache::forget(config('company.key_base') . $data->id);

        Cache::remember(config('company.key_base') . $data->id, config('company.tll_redis'), function () use ($data) {
            return $data;
        });

        return $company;
    }

    public function delete(Company $data): bool
    {
        $company = $data->delete();

        Cache::forget(config('company.key_base') . $data->id);

        return $company;
    }

    public function countCompaniesByPlan(int $idPlan): int
    {
        return (int) $this->company
            ->where('id_plan', $idPlan)
            ->count();
    }
}