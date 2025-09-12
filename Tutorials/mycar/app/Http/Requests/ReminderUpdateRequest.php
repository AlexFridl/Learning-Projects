<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ReminderUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'description' => 'required_without_all:date,price,notify_days,notify_email',
            'date' => 'required_without_all:description,price,notify_days,notify_email|date',
            'price' => 'required_without_all:date,description,notify_days,notify_email|integer|min:0',
            'notify_days' => 'required_without_all:date,price,description,notify_email|integer|min:0',
            'notify_email' => 'required_without_all:date,price,notify_days,description'
        ];
    }

    public function messages()
    {
        return [
            'required_without_all' => 'Polje ne sme biti prazno.',
            'date' => 'Datum mora biti ispravnog formata.',
            'integer' => 'Vradnost u polju mora biti celi broj.',
            'min' => 'Vrednost u polju mora biti najmanje :min.'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
