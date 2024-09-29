<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\NotFoundException;
use App\Factories\ResponseFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateOrderRequest;
use App\Services\Api\OrderService;
use App\Traits\SwaggerDocs\OrderControllerDocs;
use App\Transformers\OrderListTransformer;
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

    public function show(string $id): JsonResponse
    {
        try {
            $order = $this->orderService->findOrderWithProducts($id);

            return response()->json(
                ResponseFactory::make(
                    ResponseFactory::SUCCESS,
                    $this->orderService->getLastMessage(),
                    Response::HTTP_OK,
                    OrderTransformer::transform($order)
                ),
                Response::HTTP_OK
            );
        } catch (NotFoundException $e) {
            return response()->json(
                ResponseFactory::make(
                    ResponseFactory::ERROR,
                    $this->orderService->getLastMessage(),
                    Response::HTTP_NOT_FOUND,
                    []
                ),
                Response::HTTP_NOT_FOUND
            );
        } catch (Throwable $e) {
            return $this->internalErrorResponse();
        }
    }

    public function list(string $perPage = '10')
    {
        try {
            $ordersList = $this->orderService->listOrders($perPage);

            $responseStatus = $ordersList->isEmpty()
                ? Response::HTTP_NO_CONTENT
                : Response::HTTP_OK;

            return response()->json(
                ResponseFactory::make(
                    ResponseFactory::SUCCESS,
                    $this->orderService->getLastMessage(),
                    $responseStatus,
                    OrderListTransformer::transform($ordersList)
                ),
                $responseStatus
            );
        } catch (Throwable $e) {
            return $this->internalErrorResponse();
        }
    }
}
