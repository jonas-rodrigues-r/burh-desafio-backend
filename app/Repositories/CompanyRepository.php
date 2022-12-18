<?php

namespace App\Repositories;

use App\Models\Company;
use Illuminate\Support\Collection;

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
        return $this->company
            ->select(config('company.select_fields'))
            ->where('id', $id)
            ->with('plan')
            ->first();
    }

    public function create(array $data): Company
    {
        return $this->company->create($data);
    }

    public function update(Company $data): bool
    {
        return $data->update();
    }

    public function delete(Company $data): bool
    {
        return $data->delete();
    }

    public function countCompaniesByPlan(int $idPlan): int
    {
        return (int) $this->company
            ->where('id_plan', $idPlan)
            ->count();
    }
}