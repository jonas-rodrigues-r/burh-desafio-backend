<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CompanyController extends Controller
{
    public function __construct(
        protected CompanyService $service,
    ) { 
    }
    
    public function index()
    {
        return $this->service->index();
    }

    public function show(int $id)
    {
        return $this->service->show($id);
    }

    public function create(Request $request)
    {
        $request->validate(Company::createRules());

        $this->service->create($request->all());

        return response()->json('Empresa Cadastrada com Sucesso!', Response::HTTP_CREATED);
    }

    public function update(Request $request, int $id)
    {
        $request->validate(Company::updateRules());

        $this->service->update($request->all(), $id);

        return response()->json('Empresa Atualizada com Sucesso!', Response::HTTP_OK);
    }

    public function delete(int $id)
    {
        $this->service->delete($id);

        return response()->json('Empresa Excluída com Sucesso!', Response::HTTP_OK);
    }
}