<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class VehicleStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'make' => 'required',
            'model' => 'required',
            'registration_number' => 'required|regex:/^[A-ZŠĐČĆŽ]{2}[0-9]{3,5}[A-ZŠĐČĆŽ]{2}$/u|unique:vehicles,registration_number,NULL,NULL,user_id,' . Auth::user()->id
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Ovo polje je obavezno.',
            'regex' => 'Polje nije u ispravnom formatu.',
            'unique' => 'Već imate auto sa unetim brojem tablica.'
        ];
    }
}
