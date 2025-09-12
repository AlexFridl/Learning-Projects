<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required_without_all:password|email',
            'password' => 'required_without_all:email|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'required_without_all' => 'Polje ne sme biti prazno.',
            'min' => 'Vrednost u polju mora biti najmanje :min.',
            'email' => 'Email nije ispravnog formata.',
            'confirmed' => 'Lozinka i ponovna lozinka nisu iste.'
        ];
    }
}
