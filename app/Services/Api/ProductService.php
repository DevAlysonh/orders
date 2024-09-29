<?php

namespace App\Services\Api;

use App\Repositories\ProductRepository;

class ProductService
{
    protected string $lastMessage = '';

    public function __construct(protected ProductRepository $productRepo)
    {
    }

    public function newProduct(array $productData): ?array
    {
        $this->lastMessage = 'Produto cadastrado com sucesso';
        $product = $this->productRepo->create($productData);

        return $product->only(['id', 'name', 'category_id', 'price']);
    }

    public function getLastMessage(): string
    {
        return $this->lastMessage;
    }
}
