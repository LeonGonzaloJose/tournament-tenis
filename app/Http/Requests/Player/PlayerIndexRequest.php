<?php

namespace App\Http\Requests\Player;

use App\ApiValidationRequest\ApiRequest;

class PlayerIndexRequest extends ApiRequest
{
    public function attributes()
    {
        return [
            'name'  =>  'Nombre de la persona',
            'sex'   =>  'Sexualidad de la persona Masculino o Femenino',
            'age'   =>  'Edad del personas',
            'status'=>  'Estado actual de la persona',
            'level' =>  'Nivel de la persona'
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
            'name'  => 'nullable|string',
            'sex'   => 'nullable|string|in:M,F',
            'status'=> 'nullable|string|in:A,I',
            'age'   => 'nullable|integer|min:18|max:70',
            'level' => 'nullable|integer|min:0|max:100'
        ];
    }

    public function messages()
    {
        return [
            'requided'  => 'El campo :attribute es requerido',
            'string'    => 'El campo :attribute tiene que ser de tipo string',
            'sex.in'    => 'El campo :attribute tiene que ser M (masculino) o F (femenino)',
            'status.in' => 'El campo :attribute tiene que ser A (activo) o I (inactivo)',
            'min' => 'El valor minimo del campo :attribute es de :min',
            'max' => 'El valor maximo del campo :attribute es de :max'
        ];
    }
}
