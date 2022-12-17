<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Services\PlanService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PlanController extends Controller
{
    public function __construct(
        protected PlanService $service,
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
        $request->validate(Plan::createRules());

        $this->service->create($request->all());

        return response()->json('Plano Cadastrado com Sucesso!', Response::HTTP_CREATED);
    }

    public function update(Request $request, int $id)
    {
        $request->validate(Plan::updateRules());
        
        $this->service->update($request->all(), $id);

        return response()->json('Plano Atualizado com Sucesso!', Response::HTTP_OK);
    }

    public function delete(int $id)
    {
        $this->service->delete($id);

        return response()->json('Plano Excluído com Sucesso!', Response::HTTP_OK);
    }
}