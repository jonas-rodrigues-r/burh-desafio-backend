<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    public function __construct(
        protected User $user,
    ) {  
    }

    public function index()
    {
        return $this->user
            ->select(array_merge(config('user.select_fields'), [DB::raw('YEAR(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(birth_date))) AS age')]))
            ->all();
    }

    public function show(int $id)
    {
        return $this->user
            ->select(array_merge(config('user.select_fields'), [DB::raw('YEAR(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(birth_date))) AS age')]))
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

    public function getUsers(array $data)
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