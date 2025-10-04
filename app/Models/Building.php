<?php

namespace App\Models;

use App\Traits\Tenantable;

class Building extends Main
{
    use Tenantable;

    protected $guarded = [];

    public function flats()
    {
        return $this->hasMany(Flat::class);
    }

    public function tenants()
    {
        return $this->hasManyThrough(Tenant::class, Flat::class, "building_id","id","id", "tenant_id");
    }

    public function bills()
    {
        return $this->hasManyThrough(Bill::class, Flat::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
