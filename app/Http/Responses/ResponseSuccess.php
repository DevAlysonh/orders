<?php

namespace App\Http\Responses;

use App\Http\Responses\Contracts\ApiResponse;

class ResponseSuccess implements ApiResponse
{
    public function build(string $message, int $statusCode, array $data = []): array
    {
        return [
            'status' => 'success',
            'message' => $message,
            'data' => $data,
            'status_code' => $statusCode,
        ];
    }
}
