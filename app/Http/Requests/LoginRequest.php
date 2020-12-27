<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class LoginRequest extends FormRequest
{

    public function rules()
    {
        return [
            'email'    => 'required|email',
            'password' => 'required|min:6|max:30'
        ];
    }

    public function attributes()
    {
        return [
            'email'    => 'E-mail',
            'password' => 'Parola'
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
