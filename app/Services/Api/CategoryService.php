<?php

namespace App\Services\Api;

use App\Repositories\CategoryRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryService
{
    protected string $lastMessage = '';

    public function __construct(protected CategoryRepository $categoryRepo)
    {
    }

    public function newCategory(array $categoryData): ?array
    {
        $category = $this->categoryRepo
            ->create($categoryData['name']);

        $this->lastMessage = 'Categoria cadastrada com sucesso';
        return $category->only(['id', 'name']);
    }

    public function getMenu(string $perPage): LengthAwarePaginator
    {
        $this->lastMessage = 'Itens do cardápio';

        $menu = $this->categoryRepo->listAllCategoriesWithItems($perPage);

        if ($menu->isEmpty()) {
            $this->lastMessage = 'Seu cardápio ainda não possui nenhum item';
        }

        return $menu;
    }

    public function getLastMessage(): string
    {
        return $this->lastMessage;
    }
}
