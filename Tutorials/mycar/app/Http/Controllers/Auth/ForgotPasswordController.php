<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class ForgotPasswordController extends Controller
{

    use SendsPasswordResetEmails;

    protected function validateEmail(Request $request)
    {
        $request->validate(['email' => 'required|email'], [
            'required' => 'Ovo polje je obavezno.',
            'email' => 'Email nije ispravnog formata.',
        ]);
    }
}
