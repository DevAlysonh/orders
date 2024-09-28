<?php

namespace App\Transformers;

use App\Transformers\Contracts\Transformer;

class MenuItemsTransformer implements Transformer
{
    public static function transform(mixed $data): array
    {
        return [
            'menu' => $data->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'products' => $category->products->select('id', 'name', 'price'),
                ];
            }),
            'current_page' => $data->currentPage(),
            'last_page' => $data->lastPage(),
        ];
    }
}
