<?php

namespace App\Services\Api;

use App\Models\Api\Category;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryService
{
    protected string $lastMessage = '';
    public function create(array $categoryData): ?array
    {
        $category = Category::create($categoryData);

        $this->lastMessage = 'Categoria cadastrada com sucesso.';
        return $category->only(['id', 'name']);
    }

    public function getMenuItems(string $perPage): LengthAwarePaginator
    {
        $this->lastMessage = 'Itens do cardápio.';

        $menu = Category::with('products:id,category_id,name,price')
            ->orderBy('name')
            ->paginate($perPage);

        if ($menu->isEmpty()) {
            $this->lastMessage = 'Seu cardápio ainda não possui nenhum item.';
        }

        return $menu;
    }

    public function getLastMessage(): string
    {
        return $this->lastMessage;
    }
}
