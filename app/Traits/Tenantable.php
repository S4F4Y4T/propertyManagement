<?php

namespace App\Traits;

use App\Models\Scopes\OwnerScope;

trait Tenantable
{
    protected static function bootTenantable()
    {
        static::addGlobalScope(new OwnerScope);

        static::creating(function ($model) {

            if (auth()->check() && auth()->user()->isOwner()) {
                $model->owner_id = auth()->id();
            }
        });
    }
}
