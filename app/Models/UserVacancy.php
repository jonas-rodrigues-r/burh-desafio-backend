<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVacancy extends Model
{
    use HasFactory;

    protected $table = 'user_vacancies';

    protected $fillable = [
        'id_user',
        'id_vacancy',
    ];

    public static function subscriptionRule()
    {
        return [
            'id_user' => 'required|integer',
            'id_vacancy' => 'required|integer',
        ];
    }

    public function user()
    {
        return $this->hasMany(User::class, 'id', 'id_user');
    }

    public function vacancy()
    {
        return $this->hasMany(Vacancy::class, 'id', 'id_vacancy');
    }
}