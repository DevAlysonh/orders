<?php

namespace App\Transformers\Contracts;

interface Transformer
{
    public static function transform(mixed $data): array;
}
