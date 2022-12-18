<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class UserController extends Controller
{
    public function __construct(
        protected UserService $service,
    ) { 
    }

    public function index(): Collection
    {
        return $this->service->index();
    }

    public function show(int $id): ?User
    {
        return $this->service->show($id);
    }

    public function create(Request $request): JsonResponse
    {
        $request->validate(User::createRules());

        $this->service->create($request->all());

        return response()->json('Usuário Cadastrada com Sucesso!', Response::HTTP_CREATED);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $request->validate(User::updateRules($id));

        $this->service->update($request->all(), $id);

        return response()->json('Usuário Atualizada com Sucesso!', Response::HTTP_OK);
    }

    public function delete(int $id): JsonResponse
    {
        $this->service->delete($id);

        return response()->json('Usuário Excluída com Sucesso!', Response::HTTP_OK);
    }

    public function getUserAndVacancies(Request $request): Collection
    {
        return $this->service->getUserAndVacancies($request->all());
    }
}