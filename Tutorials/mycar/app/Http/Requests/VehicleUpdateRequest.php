<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class VehicleUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'make' => 'required_without_all:model,registration_number',
            'model' => 'required_without_all:make,registration_number',
            'registration_number' => 'required_without_all:make,model|regex:/^[A-ZŠĐČĆŽ]{2}[0-9]{3,5}[A-ZŠĐČĆŽ]{2}$/u|unique:vehicles,registration_number,NULL,NULL,user_id,' . Auth::user()->id
        ];
    }

    public function messages(){
        return [
            'required_without_all' => 'Polje ne sme biti prazno.',
            'regex' => 'Polje nije ispravnog formata.',
            'unique' => 'Već imate auto sa unetim brojem tablica.'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
