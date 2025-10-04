<?php

namespace App\Filters;

class FlatFilter extends QueryFilter
{
    protected array $sort = ['id'];

    protected array $allowedIncludes = ['building', 'tenant', 'bills'];

    public function flat_number($value): void
    {
        $this->builder->where('flat_number', $value);
    }

    public function building($value): void
    {
        $this->builder->where('building_id', $value);
    }

}
