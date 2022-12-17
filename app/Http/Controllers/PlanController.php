<?php

namespace App\Http\Controllers;

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
        $this->service->create($request->all());

        return response()->json('Plano Cadastrado com Sucesso!', Response::HTTP_CREATED);
    }
}