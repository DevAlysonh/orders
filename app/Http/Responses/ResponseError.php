<?php

namespace App\Http\Responses;

use App\Http\Responses\Contracts\ApiResponse;

class ResponseError implements ApiResponse
{
    public function build(
        string $message,
        int $statusCode,
        array $data
    ): array {
        return [
            'status' => 'error',
            'message' => $message,
            'errors' => $data,
            'status_code' => $statusCode
        ];
    }
}
