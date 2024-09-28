<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateOrderRequest;
use App\Services\Api\OrderService;
use Illuminate\Http\JsonResponse;
use Throwable;

class OrderController extends Controller
{
    public function __construct(protected OrderService $orderService)
    {
    }

    public function store(CreateOrderRequest $request): JsonResponse
    {
        try {
            $order = $this->orderService->newOrder($request->input('products'));
            return response()->json($order, 201);
        } catch (Throwable $e) {
            dd($e->getMessage());
            return $this->internalErrorResponse();
        }
    }
}
