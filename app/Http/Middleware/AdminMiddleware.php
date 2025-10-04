<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponse;
use Closure;
use App\Enums\RoleEnum;

class AdminMiddleware
{
    use ApiResponse;

    public function handle($request, Closure $next)
    {
        if($request->user()->role !== RoleEnum::ADMIN->value) {
            return self::error('Unauthorize Access.', 403);
        }

        return $next($request);
    }
}
