<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{

    public static function success(string $message, int $code = 200, null|array|object $data = null): JsonResponse
    {
        $response = [
            'code' => $code,
            'type' => 'success',
            'message' => $message,
        ];

        if (!empty($data)) {
            $response['data'] = $data;
        }

        return response()->json($response, $code);
    }


    public static function error(string|array $message, int $code = 400, array $errors = []): JsonResponse
    {
        $response = [
            'code' => $code,
            'type' => 'error',
            'message' => $message,
        ];

        if (!empty($errors)) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $code);
    }

}
