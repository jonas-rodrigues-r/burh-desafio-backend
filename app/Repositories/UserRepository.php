<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
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
            ->select(array_merge(config('user.select_fields'), [$this->getAge()]))
            ->get();
    }

    public function show(int $id): ?User
    {
        return Cache::remember(config('user.key_base') . $id, config('user.tll_redis'), function () use ($id) {
            return $this->user
                ->select(array_merge(config('user.select_fields'), [$this->getAge()]))
                ->where('id', $id)
                ->first();
        });
    }

    public function create(array $data): User
    {
        $user = $this->user->create($data);

        return Cache::remember(config('user.key_base') . $user->id, config('user.tll_redis'), function () use ($user) {
            return $user;
        });
    }

    public function update(User $data): bool
    {
        $user = $data->update();

        Cache::forget(config('user.key_base') . $data->id);

        Cache::remember(config('user.key_base') . $data->id, config('user.tll_redis'), function () use ($data) {
            return $data;
        });

        return $user;
    }

    public function delete(User $data): bool
    {
        $user = $data->delete();

        Cache::forget(config('user.key_base') . $data->id);

        return $user;
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
        ->select(array_merge(config('user.select_fields'), [$this->getAge()]))
        ->get();
    }

    protected function getAge(): mixed
    {
        return DB::raw('YEAR(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(birth_date))) AS age');
    }
}