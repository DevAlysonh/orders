<?php

namespace App\Http\Requests\Api;

use App\Factories\ResponseFactory;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class UpdateOrderStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'string','in:open,approved,finished,cancelled'],
            'total' => ['prohibited']
        ];
    }

    public function messages(): array
    {
        return [
            'status.in' => 'O status deve ser um desses: "open", "approved", "finished", "cancelled"',
            'status.required' => 'Campo obrigatório',
            'total.prohibited' => 'O campo total não é permitido'
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
