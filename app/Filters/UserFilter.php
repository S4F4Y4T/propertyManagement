<?php

namespace App\Filters;

class UserFilter extends QueryFilter
{
    protected array $sort = ['id', 'name'];

    protected array $allowedIncludes = ['building'];


    public function search($search): void
    {
         $$this->builder->where(function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        });
    }
}
