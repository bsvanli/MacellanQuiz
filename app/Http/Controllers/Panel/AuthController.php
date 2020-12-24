<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('panel.login');
    }

    public function logout(){
        Auth::logout();
        return redirect('panel.login');
    }
}
