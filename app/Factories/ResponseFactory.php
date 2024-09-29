<?php

namespace App\Factories;

use App\Http\Responses\ResponseError;
use App\Http\Responses\ResponseSuccess;

class ResponseFactory
{
    public const SUCCESS = 'success';
    public const ERROR = 'error';
    public const INTERNAL_ERROR_MESSAGE = 'Ocorreu um erro ao processar sua solicitação, tente novamente em instantes';
    public const VALIDATION_ERROR_MESSAGE = 'A validação dos dados falhou';

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
