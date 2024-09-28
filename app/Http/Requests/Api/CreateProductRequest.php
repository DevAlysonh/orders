<?php

namespace App\Http\Requests\Api;

use App\Factories\ResponseFactory;
use App\Rules\ValidString;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class CreateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'name' => ['required', 'string', new ValidString()],
            'price' => 'required|decimal:2',
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'Campo Obrigatório.',
            'price.decimal' => 'O preço deve ser um número, com pelo menos duas casas decimais, como: 29.99'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(
            ResponseFactory::make(
                ResponseFactory::ERROR,
                'A validação dos dados falhou!',
                Response::HTTP_UNPROCESSABLE_ENTITY,
                $validator->errors()->toArray()
            ),
            Response::HTTP_UNPROCESSABLE_ENTITY
        ));
    }
}
