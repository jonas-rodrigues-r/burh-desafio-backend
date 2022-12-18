<?php

namespace App\Services;

use App\Models\Company;
use App\Repositories\CompanyRepository;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class CompanyService
{
    public function __construct(
        protected CompanyRepository $repository
    ) {
    }
    
    public function index(): Collection
    {
        return $this->repository->index();
    }

    public function show(int $id): ?Company
    {
        $company = $this->repository->show($id);

        if (empty($company)) {
            throw new Exception('Empresa não existe!', Response::HTTP_NOT_FOUND);
        }

        return $company;
    }

    public function create(array $data): Company
    {
        return $this->repository->create([
            'name' => $data['name'],
            'description' => $data['description'],
            'cnpj' => $data['cnpj'],
            'id_plan' => $data['id_plan'],
        ]);
    }

    public function update(array $data, int $id): bool
    {
        $company = $this->show($id);

        $company->name = $data['name'];
        $company->description = $data['description'];
        $company->id_plan = $data['id_plan'];

        return $this->repository->update($company);
    }

    public function delete(int $id): bool
    {
        $company = $this->show($id);

        return $this->repository->delete($company);
    }

    public function countCompaniesByPlan(int $idPlan): Collection
    {
        return $this->repository->countCompaniesByPlan($idPlan);
    }
}