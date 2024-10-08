<?php

namespace App\Http\Controllers\Api;

use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateCategoryRequest;
use App\Services\Api\CategoryService;
use App\Traits\SwaggerDocs\CategoryControllerDocs;
use App\Transformers\MenuItemsTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Throwable;

class CategoryController extends Controller
{
    use CategoryControllerDocs;

    public function __construct(protected CategoryService $categoryService)
    {
    }

    public function store(CreateCategoryRequest $request): JsonResponse
    {
        try {
            $category = $this->categoryService
                ->newCategory($request->validated());

            return response()->json(
                ResponseFactory::make(
                    ResponseFactory::SUCCESS,
                    $this->categoryService->getLastMessage(),
                    Response::HTTP_CREATED,
                    $category
                ),
                Response::HTTP_CREATED
            );
        } catch (Throwable $e) {
            return $this->internalErrorResponse($e);
        }
    }

    public function menu(string $perPage = '10'): JsonResponse
    {
        try {
            $menuList = $this->categoryService
                ->getMenu($perPage);

            $responseStatus = $menuList->isEmpty()
                ? Response::HTTP_NO_CONTENT
                : Response::HTTP_OK;

            return response()->json(
                ResponseFactory::make(
                    ResponseFactory::SUCCESS,
                    $this->categoryService->getLastMessage(),
                    $responseStatus,
                    MenuItemsTransformer::transform($menuList)
                ),
                $responseStatus
            );
        } catch (Throwable $e) {
            return $this->internalErrorResponse($e);
        }
    }
}
