<?php

namespace App\Transformers;

use App\Transformers\Contracts\Transformer;

class OrderListTransformer implements Transformer
{
    public static function transform(mixed $data): array
    {
        return [
            'orders' => $data->map(function ($oder) {
                return [
                    'id' => $oder->id,
                    'total_cost' => $oder->total,
                ];
            }),
            'current_page' => $data->currentPage(),
            'last_page' => $data->lastPage(),
        ];
    }
}
