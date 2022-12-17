<?php

namespace App\Services;

use App\Repositories\VacancyRepository;
use Exception;
use Illuminate\Http\Response;

class VacancyService
{
    public function __construct(
        protected VacancyRepository $repository,
    ) {  
    }

    public function index()
    {
        return $this->repository->index();
    }

    public function show(int $id)
    {
        $vacancy = $this->repository->show($id);

        if (empty($vacancy)) {
            throw new Exception('Vaga não existe!', Response::HTTP_NOT_FOUND);
        }

        return $vacancy;
    }
}