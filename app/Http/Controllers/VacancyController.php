<?php

namespace App\Http\Controllers;

use App\Models\UserVacancy;
use App\Models\Vacancy;
use App\Services\VacancyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class VacancyController extends Controller
{
    public function __construct(
        protected VacancyService $service,
    ) { 
    }

    public function index(): Collection
    {
        return $this->service->index();
    }

    public function show(int $id): ?Vacancy
    {
        return $this->service->show($id);
    }

    public function create(Request $request): JsonResponse
    {
        $request->validate(Vacancy::createRules());

        $this->service->create($request->all());

        return response()->json('Vaga Cadastrada com Sucesso!', Response::HTTP_CREATED);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $request->validate(Vacancy::updateRules());

        $this->service->update($request->all(), $id);

        return response()->json('Vaga Atualizada com Sucesso!', Response::HTTP_OK);
    }

    public function delete(int $id): JsonResponse
    {
        $this->service->delete($id);

        return response()->json('Vaga Excluída com Sucesso!', Response::HTTP_OK);
    }

    public function getVacanciesByCompany(int $idCompany)
    {
        return $this->service->getVacanciesByCompany($idCompany);
    }

    public function subscription(Request $request): JsonResponse
    {
        $request->validate(UserVacancy::subscriptionRule());

        $this->service->subscription($request->all());

        return response()->json('Inscrição Realizada com Sucesso!', Response::HTTP_CREATED);
    }
}