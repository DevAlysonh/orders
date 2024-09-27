<?php

namespace App\Services\Api;

use App\Exceptions\NotFoundException;
use App\Models\Api\Category;
use App\Models\Api\Product;

class ProductService
{
    protected string $lastMessage = '';
    public function newProduct(array $productData): ?array
    {
        $category = Category::find($productData['category_id']);

        if (!$category) {
            $this->lastMessage = 'Categoria não existe, ou é inválida.';
            throw new NotFoundException();
        }

        $this->lastMessage = 'Produto cadastrado com sucesso.';

        $product = Product::create([
            'category_id' => $category->id,
            'name' => $productData['name'],
            'price' => $this->handleProductPrice($productData['price']),
        ]);

        return $product->only(['id', 'name', 'category_id', 'price']);
    }

    public function getLastMessage(): string
    {
        return $this->lastMessage;
    }

    private function handleProductPrice(string $price): int
    {
        return (int) preg_replace('/\D/', '', $price);
    }
}
