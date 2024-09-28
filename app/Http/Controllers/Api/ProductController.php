<?php

namespace App\Http\Controllers\Api;

use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateProductRequest;
use App\Services\Api\ProductService;
use App\Traits\SwaggerDocs\ProductControllerDocs;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Throwable;

class ProductController extends Controller
{
    use ProductControllerDocs;
    public function __construct(protected ProductService $productService)
    {
    }

    public function store(CreateProductRequest $request): JsonResponse
    {
        try {
            $product = $this->productService->newProduct($request->all());
            return response()->json(
                ResponseFactory::make(
                    ResponseFactory::SUCCESS,
                    $this->productService->getLastMessage(),
                    Response::HTTP_CREATED,
                    $product
                ),
                Response::HTTP_CREATED
            );
        } catch (Throwable $e) {
            return $this->internalErrorResponse();
        }
    }
}
