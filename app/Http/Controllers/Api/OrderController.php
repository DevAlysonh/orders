<?php

namespace App\Http\Controllers\Api;

use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateOrderRequest;
use App\Services\Api\OrderService;
use App\Traits\SwaggerDocs\OrderControllerDocs;
use App\Transformers\OrderTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Throwable;

class OrderController extends Controller
{
    use OrderControllerDocs;

    public function __construct(protected OrderService $orderService)
    {
    }

    public function store(CreateOrderRequest $request): JsonResponse
    {
        try {
            $order = $this->orderService->newOrder($request->input('products'));

            return response()->json(
                ResponseFactory::make(
                    ResponseFactory::SUCCESS,
                    $this->orderService->getLastMessage(),
                    Response::HTTP_CREATED,
                    OrderTransformer::transform($order)
                ),
                Response::HTTP_CREATED
            );
        } catch (Throwable $e) {
            return $this->internalErrorResponse();
        }
    }
}
