<?php

namespace App\Repositories;

use App\Models\Company;

class CompanyRepository
{
    public function __construct(
        protected Company $company,
    ) {  
    }
    
    public function index()
    {
        return $this->company
            ->with('plan')
            ->get();
    }

    public function show(int $id)
    {
        return $this->company
            ->where('id', $id)
            ->with('plan')
            ->first();
    }
}