<?php

namespace App\Services\Api;

use App\Exceptions\NotFoundException;
use App\Models\Api\Order;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderService
{
    protected string $lastMessage = '';

    public function newOrder(array $products): Order
    {
        $order = Order::create([
            'status' => Order::STATUS_OPEN,
            'total' => $this->handleOrderTotalPrice($products)
        ]);

        $this->addProductsToOrder($order, $products);

        $this->lastMessage = 'Pedido registrado';
        return $order;
    }

    public function updateOrder(string $orderId, array $updateData): ?Order
    {
        $order = Order::with('products')->find($orderId);

        if (!$order) {
            $this->lastMessage = 'Pedido não encontrado';
            throw new NotFoundException();
        }

        $this->lastMessage = 'Pedido atualizado';
        $order->update([
            'status' => $updateData['status']
        ]);

        return $order;
    }

    public function listOrders(string $perPage): LengthAwarePaginator
    {
        $this->lastMessage = 'Lista de pedidos';
        return Order::select('id', 'total')->paginate($perPage);
    }

    public function findOrder(string $orderId): ?Order
    {
        $order = Order::with('products')->find($orderId);

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

    private function addProductsToOrder(Order $order, array $products): void
    {
        foreach ($products as $product) {
            $order->products()->attach($product['product_id'], [
                'quantity' => $product['quantity'],
                'price' => $product['price'] * 100
            ]);
        }
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
