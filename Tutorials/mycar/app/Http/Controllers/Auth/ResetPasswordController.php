<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{

    use ResetsPasswords;

    protected function resetPassword($user, $password)
    {
        $this->setUserPassword($user, $password);

        $user->setRememberToken(Str::random(60));

        $user->save();

        event(new PasswordReset($user));
    }

    protected function validationErrorMessages()
    {
        return [
            'required' => 'Ovo polje je obavezno.',
            'email' => 'Email nije ispravnog formata.',
            'min' => 'Ovo polje mora biti 8 ili više karaktera',
            'confirmed' => 'Lozinka i ponovna lozinka nisu iste.'
        ];
    }

    protected $redirectTo = '/login';
}
