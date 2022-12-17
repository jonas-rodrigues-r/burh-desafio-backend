<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'cpf',
        'birth_date',
    ];

    public static function createRules(): array
    {
        return [
            'name' => 'required|string|min:3|max:250',
            'email' => 'required|email|unique:App\Models\User',
            'cpf' => 'required|numeric|digits:11|unique:App\Models\User',
            'birth_date' => 'required|date',
        ];
    }

    public static function updateRules(string $id): array
    {
        return [
            'name' => 'required|string|min:3|max:250',
            'email' => 'required|email|unique:App\Models\User' .",id,$id",
        ];
    }
}
