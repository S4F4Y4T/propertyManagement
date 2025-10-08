<?php

namespace App\Filters;

class TenantFilter extends QueryFilter
{
    protected array $sort = ['id', 'name'];

    protected array $allowedIncludes = ['flat', 'bills'];

    public function search($value): void
    {
        $this->builder->where('name', 'like', '%' . $value . '%');
    }

    public function building($value): void
    {
        $this->builder->whereHas('flat', function ($query) use ($value) {
            $query->where('building_id', $value);
        });
    }

}
