<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Repositories\VacancyRepository;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class UserService
{
    public function __construct(
        protected UserRepository $repository,
        protected VacancyRepository $vacancyRepository,
    ) {  
    }

    public function index(): Collection
    {
        return $this->repository->index();
    }

    public function show(int $id): ?User
    {
        $user = $this->repository->show($id);

        if (empty($user)) {
            throw new Exception('Usuário não existe!', Response::HTTP_NOT_FOUND);
        }

        return $user;
    }

    public function create(array $data): User
    {
        return $this->repository->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'cpf' => $data['cpf'],
            'birth_date' => $data['birth_date'],
        ]);
    }

    public function update(array $data, int $id): bool
    {
        $user = $this->show($id);
        $user->name = $data['name'];
        $user->email = $data['email'];

        return $this->repository->update($user);
    }

    public function delete(int $id): bool
    {
        $user = $this->show($id);

        return $this->repository->delete($user);
    }

    public function getUserAndVacancies(array $data): Collection
    {
        $users = $this->repository->getUsers([
            'name' => $data['name'] ?? null,
            'email' => $data['email'] ?? null,
            'cpf' => $data['cpf'] ?? null,
        ]);

        if (empty($users)) {
            throw new Exception('Nenhum registro encontrado.', Response::HTTP_OK);
        }

        return $users;
    }
}