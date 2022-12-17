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
}