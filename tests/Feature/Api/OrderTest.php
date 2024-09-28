<?php

use App\Models\Api\Category;
use App\Models\Api\Order;
use App\Models\Api\Product;

beforeEach(function () {
    $this->category = Category::factory()->create();
    $this->product = Product::factory()->state([
        'category_id' => $this->category->id,
    ])->create();
});

it('should to create an order', function () {
    $productsArray = [
        [
            'product_id' => $this->product->id,
            'quantity' => 2,
            'price' => (float) $this->product->price,
        ],
        [
            'product_id' => $this->product->id,
            'quantity' => 1,
            'price' => ((float) $this->product->price - 1),
        ],
    ];

    $response = $this->json('POST', '/api/orders', [
        'products' => $productsArray,
    ]);
    $response->assertStatus(201);

    $data = $response->getData(true);

    expect($data['data'])->not()->toBeEmpty()
        ->and($data['data']['products'])->toHaveCount(2)
        ->and($data['data']['total_cost'])->toEqual('6.65')
        ->and($data['data']['order_status'])->toEqual(Order::STATUS_OPEN);
});

it('should return an validation exception if the request does not have products array field', function () {
    $response = $this->json('POST', '/api/orders');
    $response->assertStatus(422);

    $data = $response->getData(true);
    expect($data['errors'])->not()->toBeEmpty()
        ->and($data['errors']['products'][0])
            ->toEqual('A lista de produtos é obrigatória.');
});

it('should return an validation exception if the price of product is invalid', function () {
    $productsArray = [
        [
            'product_id' => $this->product->id,
            'quantity' => 2,
            'price' => 2.5555555555555555,
        ],
    ];

    $response = $this->json('POST', '/api/orders', [
        'products' => $productsArray,
    ]);
    $response->assertStatus(422);

    $data = $response->getData(true);

    expect($data['errors'])->not()->toBeEmpty()
        ->and($data['errors']['products.0.price'][0])
            ->toEqual('O preço deve ter no máximo duas casas decimais.');
});

it('should return an validation exception if the product does not exists', function () {
    $productsArray = [
        [
            'product_id' => 123,
            'quantity' => 2,
            'price' => 2.55,
        ],
    ];

    $response = $this->json('POST', '/api/orders', [
        'products' => $productsArray,
    ]);
    $response->assertStatus(422);

    $data = $response->getData(true);

    expect($data['errors'])->not()->toBeEmpty()
        ->and($data['errors']['products.0.product_id'][0])
        ->toEqual('O produto não existe.');
});
