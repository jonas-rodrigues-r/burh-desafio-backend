<?php

namespace App\Services;

use App\Models\Plan;
use App\Repositories\PlanRepository;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class PlanService
{
    public function __construct(
        protected PlanRepository $repository,
        protected CompanyService $companyService,
    ) {
    }
    
    public function index(): Collection
    {
        return $this->repository->index();
    }

    public function show(int $id): ?Plan
    {
        $plan = $this->repository->show($id);

        if (empty($plan)) {
            throw new Exception('Plano não existe!', Response::HTTP_NOT_FOUND);
        }

        return $plan;
    }

    public function create(array $data): Plan
    {
        return $this->repository->create([
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'number_vacancies' => $data['number_vacancies'],
        ]);
    }

    public function update(array $data, int $id): bool
    {
        $plan = $this->show($id);

        $plan->name = $data['name'];
        $plan->description = $data['description'];
        $plan->price = $data['price'];
        $plan->number_vacancies = $data['number_vacancies'];

        return $this->repository->update($plan);
    }

    public function delete(int $id): ?bool
    {
        $plan = $this->show($id);
        $numberCompanies = $this->companyService->countCompaniesByPlan($plan->id);

        if ($numberCompanies > 0) {
            throw new Exception('Plano não pode ser excluído, pois possui empresas vinculadas!');
        }

        return $this->repository->delete($plan);
    }
}