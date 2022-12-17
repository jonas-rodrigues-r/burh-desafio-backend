<?php

namespace App\Http\Controllers;

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
        $this->service->create($request->all());

        return response()->json('Empresa Cadastrada com Sucesso!', Response::HTTP_CREATED);
    }
}