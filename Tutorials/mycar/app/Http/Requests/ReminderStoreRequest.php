<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReminderStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'description' => 'required',
            'date' => 'required|date',
            'price' => 'required|integer|min:0',
            'notify_days' => 'required|integer|min:0',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Ovo polje je obavezno.',
            'date' => 'Datum mora biti ispravnog formata.',
            'integer' => 'Vradnost u polju mora biti celi broj.',
            'min' => 'Vrednost u polju mora biti najmanje :min.'
        ];
    }
}
