<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ResponseError
{
    public static function get($data, $status): JsonResponse
    {
        return response()->json([
            'message' => 'Ops! Some errors ocurred',
            'errors' => $data,
        ], $status);
    }
}
