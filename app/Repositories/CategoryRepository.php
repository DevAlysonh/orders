<?php

namespace App\Repositories;

use App\Models\Api\Category;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryRepository
{
    public function createNew(string $categoryName): Category
    {
        return Category::create([
            'name' => $categoryName
        ]);
    }

    public function listAllCategoriesWithItems(string $paginate): LengthAwarePaginator
    {
        return Category::with('products:id,category_id,name,price')
            ->orderBy('name')
            ->paginate($paginate);
    }
}
