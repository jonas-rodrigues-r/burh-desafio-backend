<?php

namespace App\Repositories;

use App\Models\UserVacancy;
use App\Models\Vacancy;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

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
        return Cache::remember(config('vacancy.key_base') . $id, config('vacancy.tll_redis'), function () use ($id) {
            return $this->vacancy
                ->select(config('vacancy.select_fields'))
                ->where('id', $id)
                ->with('company')
                ->first();
        });
    }

    public function create(array $data): Vacancy
    {
        $vacancy = $this->vacancy->create($data);

        return Cache::remember(config('vacancy.key_base') . $vacancy->id, config('vacancy.tll_redis'), function () use ($vacancy) {
            return $vacancy;
        });
    }

    public function update(Vacancy $data): bool
    {
        $vacancy = $data->update();

        Cache::forget(config('vacancy.key_base') . $data->id);

        Cache::remember(config('vacancy.key_base') . $data->id, config('vacancy.tll_redis'), function () use ($data) {
            return $data;
        });

        return $vacancy;
    }

    public function delete(Vacancy $data): bool
    {
        $vacancy = $data->delete();

        Cache::forget(config('vacancy.key_base') . $data->id);

        return $vacancy;
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
        $userVacancy = $this->userVacancy->create($data);

        Cache::remember(config('vacancy.key_base_user_vacancy') . $userVacancy->id, config('vacancy.tll_redis'), function () use ($userVacancy) {
            return $userVacancy;
        });

        return $userVacancy;
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