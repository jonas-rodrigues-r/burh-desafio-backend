<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use App\Services\VacancyService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VacancyController extends Controller
{
    public function __construct(
        protected VacancyService $service,
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
        $request->validate(Vacancy::createRules());

        $this->service->create($request->all());

        return response()->json('Vaga Cadastrada com Sucesso!', Response::HTTP_CREATED);
    }
}