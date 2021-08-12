<?php

namespace App\Filters;

class ContactFilters extends QueryFilter
{
    public function q($query)
    {
        return $this->builder->where('first_name', 'LIKE', "%{$query}%")
            ->orWhere('last_name', 'LIKE', "%{$query}%");
    }

    public function website_id($website)
    {
        return $this->builder->where('website_id', $website);
    }

}
