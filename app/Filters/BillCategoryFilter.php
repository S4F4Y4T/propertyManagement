<?php

namespace App\Filters;

class BillCategoryFilter extends QueryFilter
{
    protected array $sort = ['id', 'name'];

    protected array $allowedIncludes = ['bills'];


    public function name(string $value): void
    {
        $this->builder->where('name', 'like', '%' . $value . '%');
    }

}
