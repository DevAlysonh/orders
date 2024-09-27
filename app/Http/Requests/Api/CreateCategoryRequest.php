<?php

namespace App\Http\Requests\Api;

use App\Models\Api\Category;
use App\Rules\ValidString;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CreateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:30',
                new ValidString(),
                Rule::unique(Category::class, 'name')
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => "O campo name é obrigatório.",
            'name.string' => "O campo name deve ser uma string.",
            'name.max' => "O campo name deve ter até 30 caracteres.",
            'name.unique' => "Já existe uma categoria com esse nome.",
        ];
    }

    public function validated($key = null, $default = null): array
    {
        return parent::validated();
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ], 400));
    }
}
