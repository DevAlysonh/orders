<?php

namespace App\Repositories;

use App\Exceptions\NotFoundException;
use App\Models\Api\Product;

class ProductRepository
{
    public function __construct(protected CategoryRepository $categoryRepo)
    {
    }

    public function create(array $productData): Product
    {
        $category = $this->categoryRepo
            ->findById($productData['category_id']);

        unset($productData['category_id']);

        return Product::create([
            ...$productData,
            'category_id' => $category->id
        ]);
    }
}
