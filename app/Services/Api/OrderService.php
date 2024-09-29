<?php

namespace App\Services\Api;

use App\Exceptions\NotFoundException;
use App\Models\Api\Order;
use App\Repositories\OrderRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderService
{
    protected string $lastMessage = '';

    public function __construct(protected OrderRepository $orderRepo)
    {
    }

    public function newOrder(array $products): Order
    {
        $order = $this->orderRepo->create(
            $products,
            $this->handleOrderTotalPrice($products)
        );

        $this->lastMessage = 'Pedido registrado';
        return $order;
    }

    public function updateOrder(string $orderId, array $updateData): ?Order
    {
        if (
            !$this->orderRepo->update($orderId, $updateData['status'])
        ) {
            $this->lastMessage = 'Pedido não encontrado';
            throw new NotFoundException();
        }

        $this->lastMessage = 'Pedido atualizado';

        return $this->orderRepo->findById($orderId);
    }

    public function listOrders(string $perPage): LengthAwarePaginator
    {
        $this->lastMessage = 'Lista de pedidos';
        return $this->orderRepo->listAll($perPage);
    }

    public function findOrder(string $orderId): ?Order
    {
        $order = $this->orderRepo->findById($orderId);

        if (!$order) {
            $this->lastMessage = 'O pedido não foi localizado';
            throw new NotFoundException();
        }

        $this->lastMessage = 'Detalhes do pedido';
        return $order;
    }

    public function getLastMessage(): string
    {
        return $this->lastMessage;
    }

    private function handleOrderTotalPrice(array $products): float
    {
        $total = 0.0;
        foreach ($products as $product) {
            $total += $product['price'] * $product['quantity'];
        }

        return $total;
    }
}
