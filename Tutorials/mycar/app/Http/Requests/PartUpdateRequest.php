<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PartUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required_without_all:date,mileage,price,part_type_id,change',
            'date' => 'required_without_all:name,mileage,price,part_type_id,change|date',
            'mileage' => 'required_without_all:date,name,price,part_type_id,change|integer|min:1',
            'price' => 'required_without_all:date,mileage,name,part_type_id,change|integer|min:0',
            'change' => 'required_without_all:date,mileage,price,part_type_id,name',
            'part_type_id' => 'required_without_all:date,mileage,price,name,change|exists:part_types,id',
        ];
    }

    public function messages(){
        return [
            'required_without_all' => 'Polje ne sme biti prazno.',
            'date' => 'Datum mora biti ispravnog formata.',
            'integer' => 'Vradnost u polju mora biti celi broj.',
            'min' => 'Vrednost u polju mora biti najmanje :min.',
            'exists' => 'Izabrana vrednost ne postoji u bazi.'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
