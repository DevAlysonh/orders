<?php

namespace App\Repositories;

use App\Models\Api\Order;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderRepository
{
    public function create(array $products, float $totalPrice): Order
    {
        $order = Order::create([
            'status' => Order::STATUS_OPEN,
            'total' => $totalPrice,
        ]);

        $this->addProducts($order, $products);

        return $order;
    }

    public function listAll(string $perPage): LengthAwarePaginator
    {
        return Order::select('id', 'total')->paginate($perPage);
    }

    public function findById(string $orderId): ?Order
    {
        return Order::with('products')->find($orderId);
    }

    public function update(string $orderId, string $status): bool
    {
        return Order::where('id', $orderId)
            ->update(['status' => $status]);
    }

    private function addProducts(Order $order, array $products): void
    {
        foreach ($products as $product) {
            $order->products()->attach($product['product_id'], [
                'quantity' => $product['quantity'],
                'price' => $product['price'] * 100
            ]);
        }
    }
}
