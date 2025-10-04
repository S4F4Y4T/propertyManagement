<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponse;
use Closure;
use Exception;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;

class JwtMiddleware
{
    use ApiResponse;

    public function handle($request, Closure $next)
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (TokenExpiredException $e) {
            return self::error('Token expired.', 401);
        } catch (TokenInvalidException $e) {
            return self::error('Token not valid.', 401);
        } catch (JWTException $e) {
            return self::error('Token not found.', 401);
        } catch (Exception $e) {
            return self::error('Invalid Token', 401);
        }

        return $next($request);
    }
}
