<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function __construct(
        protected User $user,
    ) {  
    }

    public function index()
    {
        return $this->user->all();
    }

    public function show(int $id)
    {
        return $this->user
            ->where('id', $id)
            ->first();
    }

    public function create(array $data)
    {
        return $this->user->create($data);
    }

    public function update(User $data)
    {
        return $data->update();
    }

    public function delete(User $data)
    {
        return $data->delete();
    }
}