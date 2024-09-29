<?php

namespace App\Http\Requests\Api;

use App\Factories\ResponseFactory;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class CreateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'products' => 'required|array',
            'products.*.product_id' => 'required|integer|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.price' => ['required', 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,2})?$/'],
        ];
    }

    public function messages()
    {
        return [
            'products.required' => 'A lista de produtos é obrigatória',
            'products.array' => 'A lista de produtos deve ser um array',
            'products.*.product_id.required' => 'O id do produto é obrigatório',
            'products.*.product_id.integer' => 'O id do produto deve ser um número inteiro',
            'products.*.product_id.exists' => 'O produto não existe',
            'products.*.quantity.required' => 'A quantidade é obrigatória',
            'products.*.quantity.integer' => 'A quantidade deve ser um número inteiro',
            'products.*.quantity.min' => 'A quantidade deve ser pelo menos 1',
            'products.*.price.required' => 'O preço é obrigatório',
            'products.*.price.numeric' => 'O preço deve ser um número válido',
            'products.*.price.min' => 'O preço não pode ser negativo',
            'products.*.price.regex' => 'O preço deve ter no máximo duas casas decimais'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(
            ResponseFactory::make(
                ResponseFactory::ERROR,
                ResponseFactory::VALIDATION_ERROR_MESSAGE,
                Response::HTTP_UNPROCESSABLE_ENTITY,
                $validator->errors()->toArray()
            ),
            Response::HTTP_UNPROCESSABLE_ENTITY
        ));
    }
}
