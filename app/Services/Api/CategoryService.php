<?php

namespace App\Services\Api;

use App\Models\Api\Category;
use http\Exception\InvalidArgumentException;

class CategoryService
{
    protected string $lastMessage = '';
    public function create(array $categoryData): ?array
    {
        if (!isset($categoryData['name'])) {
            $this->lastMessage = "Ops! Dados inválidos para cadastrar uma nova categoria.";
            throw new InvalidArgumentException();
        }

        $category = Category::create($categoryData);

        $this->lastMessage = "Categoria cadastrada.";
        return $category->only(['id', 'name']);
    }

    public function getLastMessage(): string
    {
        return $this->lastMessage;
    }
}
