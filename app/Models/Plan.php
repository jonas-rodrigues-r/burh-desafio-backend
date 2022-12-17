<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $table = 'plans';

    protected $fillable = [
        'name',
        'description',
        'price',
        'number_vacancies'
    ];

    public static function createRules(): array
    {
        return [
            'name' => 'unique:plans|required|string|min:3|max:100',
            'description' => 'required|string|max:150',
            'price' => 'required|numeric',
            'number_vacancies' => 'required|integer',
        ];
    }

    public static function updateRules(): array
    {
        return [
            'name' => 'string|min:3|max:100',
            'description' => 'string|max:150',
            'price' => 'numeric',
            'number_vacancies' => 'integer',
        ];
    }
}