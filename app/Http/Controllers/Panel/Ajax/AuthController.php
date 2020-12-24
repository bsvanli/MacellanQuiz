<?php

namespace App\Http\Controllers\Panel\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            return response()->json([
                'status'  => true,
                'message' => 'Giriş başarılı',
                'data'    => [
                    'redirect' => route('panel.home')
                ]
            ], JsonResponse::HTTP_ACCEPTED);
        }

        return response()->json([
            'status'  => false,
            'message' => 'E-mail veya parolanız hatalı'
        ], JsonResponse::HTTP_UNAUTHORIZED);

    }
}
