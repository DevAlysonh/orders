<?php

use App\Models\Api\Category;

beforeEach(function () {
    $this->category = Category::factory()->create();
});

it('should to register a product with a category', function () {
    $response = $this->json('POST', '/api/products', [
        'category_id' => $this->category->id,
        'name' => "Água Mineral",
        'price' => '350'
    ]);

    $response->assertStatus(201);
    $data = $response->getData(true);

    expect($data)->not()->toBeEmpty();
});
