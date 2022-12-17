<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Vacancy extends Model
{
    use HasFactory;

    protected $table = 'vacancies';

    protected $fillable = [
        'title',
        'description',
        'type',
        'wage',
        'hours',
        'id_company',
    ];

    public function company()
    {
        return $this->hasMany(Company::class, 'id', 'id_company')
            ->select('id', 'name');
    }

    public static function createRules(): array
    {
        return [
            'title' => 'required|string|min:3|max:100',
            'description' => 'required|string|min:20',
            'type' => [
                'required', Rule::in(config('vacancy.types')), 
                'max:100'
            ],
            'wage' => 'numeric',
            'hour' => 'integer',
            'id_company' => 'required|integer',
        ];
    }

    public static function updateRules(): array
    {
        return [
            'title' => 'string|min:3|max:100',
            'description' => 'string|min:50',
            'type' => [
                Rule::in(config('vacancy.types')), 
                'max:100'
            ],
            'wage' => 'numeric',
            'hour' => 'integer',
        ];
    }
}
