<?php

use App\Models\Api\Category;

beforeEach(function () {
    $this->category = Category::factory()->create();
});

it('should to register a product with a category', function () {
    $response = $this->json('POST', '/api/products', [
        'category_id' => $this->category->id,
        'name' => "Água Mineral",
        'price' => 3.50
    ]);

    $response->assertStatus(201);
    $data = $response->getData(true);

    expect($data)->not()->toBeEmpty();
});

it('should return a validation error if a category does not exists', function () {
    $response = $this->json('POST', '/api/products', [
        'category_id' => 10,
        'name' => "Água Mineral",
        'price' => 3.50
    ]);

    $data = $response->getData(true);

    expect($data['errors']['category_id'])->not()->toBeEmpty()
        ->and($data['errors']['category_id'][0])->toEqual('A categoria selecionada é inválida.');
});

it('should return a validation error if the price has more than two decimal places', function () {
    $response = $this->json('POST', '/api/products', [
        'category_id' => $this->category->id,
        'name' => "Água Mineral",
        'price' => 3.50555
    ]);

    $data = $response->getData(true);

    expect($data['errors']['price'])->not()->toBeEmpty()
        ->and($data['errors']['price'][0])->toEqual('O preço deve ter no máximo duas casas decimais.');
});

it('should return a validation error if the price is not a numeric value', function () {
    $response = $this->json('POST', '/api/products', [
        'category_id' => $this->category->id,
        'name' => "Água Mineral",
        'price' => "55.55AB"
    ]);

    $data = $response->getData(true);

    expect($data['errors']['price'])->not()->toBeEmpty()
        ->and($data['errors']['price'][0])->toEqual('O preço deve ser um número válido.')
        ->and($data['errors']['price'][1])->toEqual('O preço deve ter no máximo duas casas decimais.');
});

it('should return a validation error if the name is an invalid string', function () {
    $response = $this->json('POST', '/api/products', [
        'category_id' => $this->category->id,
        'name' => "@<?>--+Água Mineral",
        'price' => "5.55"
    ]);

    $data = $response->getData(true);

    expect($data['errors']['name'])->not()->toBeEmpty()
        ->and($data['errors']['name'][0])
            ->toEqual('Ops! O nome que você escolheu não é válido. Tente não utilizar caracteres especiais.');
});
