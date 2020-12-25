<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class CategoryRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'     => 'required|max:50',
            'category' => 'nullable|exists:categories',
        ];
    }

    public function attributes()
    {
        return [
            'name'     => 'Kategori Adı',
            'category' => 'Bağlı olduğu kategori'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status'  => false,
                'message' => $validator->errors()->first()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
