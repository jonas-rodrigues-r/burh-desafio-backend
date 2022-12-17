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
}