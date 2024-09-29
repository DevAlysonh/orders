<?php


use App\Models\Api\Category;
use App\Models\Api\Product;

it('should to create a category', function () {
    $response = $this->json('POST', '/api/categories', [
        'name' => 'Foo Bar',
    ]);

    $response->assertStatus(201);
    $data = $response->getData(true);

    expect($data['message'])->toBe('Categoria cadastrada com sucesso');
    expect($data['data']['name'])->toBe('Foo Bar');
});

it('should return an error if the request does not have required params', function () {
    $response = $this->json('POST', '/api/categories', [
        'other' => 'Foo Bar',
    ]);

    $responseData = $response->getData(true);

    expect($responseData['errors']['name'][0])
        ->toBe('O campo name é obrigatório');
});

it('should return an error if the name contains an invalid string', function () {
    $response = $this->json('POST', '/api/categories', [
        'name' => "<>@foo bar*&^*&*&%",
    ]);

    $responseData = $response->getData(true);

    expect($responseData['errors']['name'][0])
        ->toBe('Ops! O nome que você escolheu não é válido. Tente não utilizar caracteres especiais');
});

it('should return a menu with all categories with your products', function () {
    $category = Category::factory()->has(Product::factory(1))->create();
    $response = $this->json('GET', '/api/categories/menu');

    $response->assertStatus(200);
    $data = $response->getData(true);

    expect($data['data']['menu'])->not()->toBeEmpty()
        ->and($data['data']['menu'][0]['id'])->toEqual($category->id)
        ->and($data['data']['menu'][0]['products'])->toHaveCount(1)
        ->and($data['data']['menu'][0]['products'][0]['price'])->toEqual('2.55')
        ->and($data['data']['current_page'])->toEqual(1)
        ->and($data['data']['last_page'])->toEqual(1);
});

it('should return no content if no category is found', function () {
    $response = $this->json('GET', '/api/categories/menu');

    $response->assertStatus(204);
    $data = $response->getData(true);

    expect($data['data']['menu'])->toBeEmpty();
});
