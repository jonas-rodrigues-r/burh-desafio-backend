<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    public function __construct(
        protected User $user,
    ) {  
    }

    public function index(): Collection
    {
        return $this->user
            ->select(array_merge(config('user.select_fields'), [DB::raw('YEAR(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(birth_date))) AS age')]))
            ->get();
    }

    public function show(int $id): ?User
    {
        return $this->user
            ->select(array_merge(config('user.select_fields'), [DB::raw('YEAR(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(birth_date))) AS age')]))
            ->where('id', $id)
            ->first();
    }

    public function create(array $data): User
    {
        return $this->user->create($data);
    }

    public function update(User $data): bool
    {
        return $data->update();
    }

    public function delete(User $data): bool
    {
        return $data->delete();
    }

    public function getUsers(array $data): Collection
    {
        $query = $this->user
            ->query();

        foreach ($data as $key => $value) {
            if (! empty($value)) {
                $query->where($key, 'LIKE', "%$value%");
            }
        }

        return $query->with('vacancies', function($subQueryVacancy) {
            return $subQueryVacancy->with('vacancy', function($subQueryCompany) {
                return $subQueryCompany->with('company');
            });
        })
        ->select(array_merge(config('user.select_fields'), [DB::raw('YEAR(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(birth_date))) AS age')]))
        ->get();
    }
}