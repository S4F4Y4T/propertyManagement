<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\Authentication\LoginRequest;

class AuthenticationController
{
    use ApiResponse;

    public function login(LoginRequest $request): JsonResponse
    {
        if (! $token = auth()->attempt($request->only('email', 'password'))) {
            return self::error('Invalid Credentials.', 401); // Return error if authentication fails
        }

        return self::success(message: 'authentication successful',data:[
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
        ]);    
    }

    public function me(): JsonResponse
    {
        return self::success('Data fetched successfully', data: auth()->user());
    }

    public function logout(): JsonResponse
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return self::success(message: 'Successfully logged out');
    }
}
