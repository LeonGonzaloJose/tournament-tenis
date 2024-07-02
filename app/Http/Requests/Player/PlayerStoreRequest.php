<?php

namespace App\Http\Requests\Player;

use App\ApiValidationRequest\ApiRequest;

class PlayerStoreRequest extends ApiRequest
{
    public function attributes()
    {
        return [
            'name'    =>  'Nombre de la persona',
            'age'      =>  'Edad de la persona',
            'sex'      =>  'Sexualidad de la persona Masculino o Femenino',
            'level'     =>  'Nivel del jugador'
        ];   
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'    =>  'string',
            'age'      =>  'nullable|integer|min:18|max:70',
            'sex'      =>  'string|in:M,F',
            'level'     =>  'integer|min:0|max:100',
        ];
    }

    public function messages()
    {
        return [
            'requided' => 'El campo :attribute es requerido',
            'string' => 'El campo :attribute tiene que ser de tipo string',
            'integer' => 'El campo :attribute tiene que ser de tipo integer',
            'sex.in' => 'El campo :attribute tiene que ser M (masculino) o F (femenino)',
            'min' => 'El valor minimo del campo :attribute es de :min',
            'max' => 'El valor maximo del campo :attribute es de :max',
        ];
    }
}
