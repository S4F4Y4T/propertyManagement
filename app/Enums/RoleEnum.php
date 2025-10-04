<?php

namespace App\Enums;

enum RoleEnum: string
{
    case OWNER = 'owner';
    case ADMIN = 'admin';

    public static function getRoles(): array
    {
        return array_map(fn($role) => $role->value, self::cases());
    }

    public static function default(): string
    {
        return self::OWNER->value;
    }
}