<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\ApiResponse;

class PublicMiddleware
{
    use ApiResponse;

    public function handle(Request $request, Closure $next): Response
    {

        if ($request->user()) {
            return self::error(message: 'You are already authenticated.', code: 400);
        }

        return $next($request);
    }
}
