<?php

namespace App\Services\Api;

use App\Models\Api\Category;

class CategoryService
{
    protected string $lastMessage = '';
    public function create(array $categoryData): ?array
    {
        $category = Category::create($categoryData);

        $this->lastMessage = "Categoria cadastrada com sucesso.";
        return $category->only(['id', 'name']);
    }

    public function getLastMessage(): string
    {
        return $this->lastMessage;
    }
}
