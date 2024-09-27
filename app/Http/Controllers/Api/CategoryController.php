<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateCategoryRequest;
use App\Services\Api\CategoryService;
use Illuminate\Http\JsonResponse;
use InvalidArgumentException;

class CategoryController extends Controller
{
    public function __construct(protected CategoryService $categoryService)
    {
    }
    public function store(CreateCategoryRequest $request): JsonResponse
    {
        try {
            $category = $this->categoryService
                ->create($request->validated());

            return response()->json([
                'msg' => $this->categoryService->getLastMessage(),
                'category' => $category
            ], 201);
        } catch (InvalidArgumentException $e) {
            return response()->json([
                'error' => $this->categoryService->getLastMessage(),
            ], 400);
        }
    }
}
