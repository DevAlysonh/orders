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
            'price' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'Campo Obrigatório',
            'category_id.exists' => 'A categoria selecionada é inválida',
            'price.numeric' => "O preço deve ser um número válido",
            'price.regex' => 'O preço deve ter no máximo duas casas decimais'
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
