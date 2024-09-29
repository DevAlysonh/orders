<?php

namespace App\Services\Api;

use App\Models\Api\Category;
use App\Models\Api\Product;

class ProductService
{
    protected string $lastMessage = '';

    public function newProduct(array $productData): ?array
    {
        $category = Category::find($productData['category_id']);

        $this->lastMessage = 'Produto cadastrado com sucesso';
        $product = Product::create([
            'category_id' => $category->id,
            'name' => $productData['name'],
            'price' => $productData['price'],
        ]);

        return $product->only(['id', 'name', 'category_id', 'price']);
    }

    public function getLastMessage(): string
    {
        return $this->lastMessage;
    }
}
