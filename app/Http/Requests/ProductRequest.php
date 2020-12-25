<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class ProductRequest extends FormRequest
{


    public function rules()
    {
        return [
            'name'     => 'required|max:50',
            'price'    => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'category' => 'required|array',
        ];
    }

    public function attributes()
    {
        return [
            'name'     => 'Ürün Adı',
            'price'    => 'Ürün Fiyatı',
            'category' => 'Bağlı olduğu kategoriler'
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
