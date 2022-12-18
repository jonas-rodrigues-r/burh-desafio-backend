<?php

namespace App\Repositories;

use App\Models\UserVacancy;
use App\Models\Vacancy;
use Illuminate\Support\Collection;

class VacancyRepository
{
    public function __construct(
        protected Vacancy $vacancy,
        protected UserVacancy $userVacancy,
    ) {  
    }

    public function index(): Collection
    {
        return $this->vacancy
            ->select(config('vacancy.select_fields'))
            ->with('company')
            ->get();
    }

    public function show(int $id): ?Vacancy
    {
        return $this->vacancy
            ->select(config('vacancy.select_fields'))
            ->where('id', $id)
            ->with('company')
            ->first();
    }

    public function create(array $data): Vacancy
    {
        return $this->vacancy->create($data);
    }

    public function update(Vacancy $data): bool
    {
        return $data->update();
    }

    public function delete(Vacancy $data): bool
    {
        return $data->delete();
    }

    public function getNumberVacanciesByCompany(int $idCompany): int
    {
        return $this->vacancy
            ->where('id_company', $idCompany)
            ->count();
    }

    public function getVacanciesByCompany(int $idCompany): Collection
    {
        return $this->vacancy
            ->select(config('vacancy.select_fields'))
            ->where('id_company', $idCompany)
            ->with('company')
            ->get();
    }

    public function subscriptionUserInVacancy(array $data): ?UserVacancy
    {
        return $this->userVacancy->create($data);
    }

    public function getSubscriptionByUserAndVacancy(int $idUser, int $idVacancy): ?UserVacancy
    {
        return $this->userVacancy
            ->where('id_user', $idUser)
            ->where('id_vacancy', $idVacancy)
            ->with('user')
            ->with('vacancy')
            ->first();
    }
}