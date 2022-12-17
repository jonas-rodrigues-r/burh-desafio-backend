<?php

namespace App\Repositories;

use App\Models\Vacancy;

class VacancyRepository
{
    public function __construct(
        protected Vacancy $vacancy,
    ) {  
    }

    public function index()
    {
        return $this->vacancy
            ->with('company')
            ->get();
    }

    public function show(int $id)
    {
        return $this->vacancy
            ->where('id', $id)
            ->with('company')
            ->first();
    }

    public function create(array $data)
    {
        return $this->vacancy->create($data);
    }

    public function getNumberVacanciesByCompany(int $idCompany)
    {
        return $this->vacancy
            ->where('id_company', $idCompany)
            ->count();
    }

    public function update(Vacancy $data)
    {
        return $data->update();
    }
}