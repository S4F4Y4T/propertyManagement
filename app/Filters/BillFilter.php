<?php

namespace App\Filters;

class BillFilter extends QueryFilter
{
    protected array $sort = ['id'];

    protected array $allowedIncludes = ['category', 'flat', 'tenant'];

    public function month($value): void
    {
        $this->builder->where('month', $value);
    }

    public function category($value): void
    {
        $this->builder->where('category_id', $value);
    }

    public function status($value): void
    {
        $this->builder->where('status', $value);
    }

    public function totalAmountMin($value): void
    {
        $this->builder->where('total_amount', '>=', $value);
    }

    public function totalAmountMax($value): void
    {
        $this->builder->where('total_amount', '<=', $value);
    }

    public function paidAmountMin($value): void
    {
        $this->builder->where('paid_amount', '>=', $value);
    }

    public function paidAmountMax($value): void
    {
        $this->builder->where('paid_amount', '<=', $value);
    }

}
