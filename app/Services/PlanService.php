<?php

namespace App\Services;

use App\Repositories\PlanRepository;
use Exception;
use Illuminate\Http\Response;

class PlanService
{
    public function __construct(
        protected PlanRepository $repository
    ) {
    }
    
    public function index()
    {
        return $this->repository->index();
    }

    public function show(int $id)
    {
        $plan = $this->repository->show($id);

        if (empty($plan)) {
            throw new Exception('Plano não existe!', Response::HTTP_NOT_FOUND);
        }

        return $plan;
    }

    public function create(array $data)
    {
        return $this->repository->create([
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'number_vacancies' => $data['number_vacancies'],
        ]);
    }

    public function update(array $data, int $id)
    {
        $plan = $this->show($id);

        $plan->name = $data['name'];
        $plan->description = $data['description'];
        $plan->price = $data['price'];
        $plan->number_vacancies = $data['number_vacancies'];

        return $this->repository->update($plan);
    }
}