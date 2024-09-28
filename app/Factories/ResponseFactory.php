<?php

namespace App\Factories;

use App\Http\Responses\ResponseError;
use App\Http\Responses\ResponseSuccess;

class ResponseFactory
{
    public const SUCCESS = 'success';
    public const ERROR = 'error';

    public static function make(
        string $status,
        string $message,
        int $statusCode,
        array $data
    ): array {
        return match ($status) {
            self::SUCCESS => (new ResponseSuccess())->build($message, $statusCode, $data),
            self::ERROR => (new ResponseError())->build($message, $statusCode, $data),
            default => []
        };
    }
}
