<?php

namespace App\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

abstract class QueryFilter
{
    protected $request;

    protected $builder;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply the filters
     */
    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->filters() as $name => $value) {
            if (method_exists($this, $name)) {
                if (isset($value) && $value !== '') {
                    isset($value) ? $this->$name(trim($value)) : $this->$name();
                }
            }
        }

        return $this->builder;
    }

    /**
     * Retrieve the query filters
     */
    public function filters()
    {
        return $this->request->all();
    }
}
