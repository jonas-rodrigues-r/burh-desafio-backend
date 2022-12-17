<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __construct(
        protected UserService $service,
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
        $request->validate(User::createRules());

        $this->service->create($request->all());

        return response()->json('Usuário Cadastrada com Sucesso!', Response::HTTP_CREATED);
    }

    public function update(Request $request, int $id)
    {
        $request->validate(User::updateRules($id));

        $this->service->update($request->all(), $id);

        return response()->json('Usuário Atualizada com Sucesso!', Response::HTTP_OK);
    }

    public function delete(int $id)
    {
        $this->service->delete($id);

        return response()->json('Usuário Excluída com Sucesso!', Response::HTTP_OK);
    }
}