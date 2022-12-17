<?php

namespace App\Services;

use App\Repositories\CompanyRepository;
use Exception;
use Illuminate\Http\Response;

class CompanyService
{
    public function __construct(
        protected CompanyRepository $repository
    ) {
    }
    
    public function index()
    {
        return $this->repository->index();
    }

    public function show(int $id)
    {
        $company = $this->repository->show($id);

        if (empty($company)) {
            throw new Exception('Empresa não existe!', Response::HTTP_NOT_FOUND);
        }

        return $company;
    }

    public function create(array $data)
    {
        return $this->repository->create([
            'name' => $data['name'],
            'description' => $data['description'],
            'cnpj' => $data['cnpj'],
            'id_plan' => $data['id_plan'],
        ]);
    }

    public function update(array $data, int $id)
    {
        $company = $this->show($id);

        $company->name = $data['name'];
        $company->description = $data['description'];
        $company->id_plan = $data['id_plan'];

        return $this->repository->update($company);
    }
}