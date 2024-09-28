<?php

namespace App\Transformers;

use App\Transformers\Contracts\Transformer;

class OrderTransformer implements Transformer
{
    public static function transform(mixed $data): array
    {
        return [
            'order_id' => $data->id,
            'order_status' => $data->status,
            'total_cost' => $data->total,
            'products' => $data->products->map(function ($product) {
                return [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'price' =>  self::calculatePivotPrice($product->pivot->price),
                    'quantity' => $product->pivot->quantity,
                ];
            }),
        ];
    }

    private static function calculatePivotPrice(int $price): string
    {
        return number_format($price / 100, 2, '.');
    }
}
