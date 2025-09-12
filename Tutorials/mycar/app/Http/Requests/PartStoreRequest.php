<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'date' => 'required|date',
            'mileage' => 'required|integer|min:1',
            'price' => 'required|integer|min:0',
            'part_type_id' => 'exists:part_types,id'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Ovo polje je obavezno.',
            'date' => 'Datum mora biti ispravnog formata.',
            'integer' => 'Vradnost u polju mora biti celi broj.',
            'min' => 'Vrednost u polju mora biti najmanje :min.',
            'exists' => 'Izabrana vrednost ne postoji u bazi.'
        ];
    }
}
