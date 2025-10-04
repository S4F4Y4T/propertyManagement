<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilter
{
    protected Builder $builder;
    protected Request $request;

    protected array $sort = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getSort(): array
    {
        return $this->sort;
    }

    public function apply(Builder $builder): void
    {
        $this->builder = $builder;

        if($this->request->has('filters') && is_array($this->request->get('filters')) && !empty($this->request->get('filters'))) {
            $this->filter($this->request->get('filters'));
        }

        if($this->request->has('sort') && !empty($this->request->get('sort'))) {
            $this->sort($this->request->get('sort'));
        }

        if($this->request->has('includes') && !empty($this->request->get('includes'))) {
            $this->includes($this->request->get('includes'));
        }

    }

    private function filter(array $filters): void
    {
        foreach ($filters as $key => $value) {
            if(method_exists($this, $key)){
                $this->$key($value);
            }
        }
    }

    public function includes(string $includes = ''): void
    {
        $relations = explode(',', $includes);

        foreach ($relations as $relation) {
            if(in_array($relation, $this->allowedIncludes ?? [])) {
                $this->builder->with($relation);
            }
        }
    }

    private function sort(string $sorting = ''): void
    {
        $sorts = explode(',',$sorting);

        foreach ($sorts as $sort) {

            $direction = 'asc';

            if (str_starts_with($sort, '-')) {
                $direction = 'desc';
                $sort = substr($sort, 1); 
            }

            if(!in_array($sort, $this->sort) && !array_key_exists($sort, $this->sort)) {
                continue;
            }

            $column = $this->sort[$sort] ?? $sort;

            $this->builder->orderBy($column, $direction);
        }
    }

}
