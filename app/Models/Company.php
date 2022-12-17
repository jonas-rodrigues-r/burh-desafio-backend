<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';

    protected $fillable = [
        'name',
        'description',
        'cnpj',
        'id_plan',
    ];

    public static function createRules(): array
    {
        return [
            'name' => 'required|string|min:3|max:100',
            'description' => 'required|string|min:3|max:250',
            'cnpj' => 'required|numeric|min:14|max:14',
            'id_plan' => 'required|numeric',
        ];
    }

    public static function updateRules(): array
    {
        return [
            'name' => 'string|min:3|max:100',
            'description' => 'string|min:3|max:250',
            'id_plan' => 'numeric',
        ];
    }
}
