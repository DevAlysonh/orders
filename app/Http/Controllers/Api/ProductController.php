<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;
use App\Services\Api\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService)
    {
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $product = $this->productService->newProduct($request->all());
            return response()->json([
                'data' => $product
            ], Response::HTTP_CREATED);
        } catch (NotFoundException $e) {
            return response()->json([
                'error' => $this->productService->getLastMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }
}
