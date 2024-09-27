<?php

namespace App\Http\Responses\Contracts;

interface ApiResponse
{
    public function build(string $message, int $statusCode, array $data): array;
}
