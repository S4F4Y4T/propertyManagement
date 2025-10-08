<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\RoleEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Filters\QueryFilter;
use App\Builders\BaseQueryBuilder;

class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function building()
    {
        return $this->hasOne(Building::class, 'owner_id');
    }

    public function isAdmin(): bool
    {
        return $this->role === RoleEnum::ADMIN->value;
    }

    public function scopeFilter(Builder $query, QueryFilter $filter): void
    {
        $filter->apply($query);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function isOwner(): bool
    {
        return $this->role === RoleEnum::OWNER->value;
    }

    public function scopeOwners($query)
    {
        return $query->where('role', RoleEnum::OWNER->value);
    }

    public function newEloquentBuilder($query)
    {
        return new BaseQueryBuilder($query);
    }
}
