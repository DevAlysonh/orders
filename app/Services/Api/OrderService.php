<?php

namespace App\Services\Api;

use App\Models\Api\Order;

class OrderService
{
    protected string $lastMessage;

    public function newOrder(array $products): Order
    {
        $order = Order::create([
            'status' => Order::STATUS_OPEN,
            'total' => $this->handleOrderTotalPrice($products)
        ]);

        $this->addProductsToOrder($order, $products);

        return $order;
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
