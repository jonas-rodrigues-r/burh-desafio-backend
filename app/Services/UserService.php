<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Repositories\VacancyRepository;
use Exception;
use Illuminate\Http\Response;

class UserService
{

    public function __construct(
        protected UserRepository $repository,
        protected VacancyRepository $vacancyRepository,
    ) {  
    }

    public function index()
    {
        return $this->repository->index();
    }

    public function show(int $id)
    {
        $user = $this->repository->show($id);

        if (empty($user)) {
            throw new Exception('Usuário não existe!', Response::HTTP_NOT_FOUND);
        }

        return $user;
    }

    public function create(array $data)
    {
        return $this->repository->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'cpf' => $data['cpf'],
            'birth_date' => $data['birth_date'],
        ]);
    }

    public function update(array $data, int $id)
    {
        $user = $this->show($id);
        $user->name = $data['name'];
        $user->email = $data['email'];

        $this->repository->update($user);
    }

    public function delete(int $id)
    {
        $user = $this->show($id);

        return $this->repository->delete($user);
    }

    public function getUserAndVacancies(array $data)
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