<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class CompanyController extends Controller
{
    public function __construct(
        protected CompanyService $service,
    ) { 
    }
    
    public function index(): Collection
    {
        return $this->service->index();
    }

    public function show(int $id): Company
    {
        return $this->service->show($id);
    }

    public function create(Request $request): JsonResponse
    {
        $request->validate(Company::createRules());

        $this->service->create($request->all());

        return response()->json('Empresa Cadastrada com Sucesso!', Response::HTTP_CREATED);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $request->validate(Company::updateRules());

        $this->service->update($request->all(), $id);

        return response()->json('Empresa Atualizada com Sucesso!', Response::HTTP_OK);
    }

    public function delete(int $id): JsonResponse
    {
        $this->service->delete($id);

        return response()->json('Empresa Excluída com Sucesso!', Response::HTTP_OK);
    }
}