<?php

namespace App\Http\Requests\Player;

use App\ApiValidationRequest\ApiRequest;

class PlayerUpdateRequest extends ApiRequest
{
    public function attributes()
    {
        return [
            'id'        =>  'Identificador del jugador/jugadora',
            'name'    =>  'Nombre del jugador/jugadora',
            'age'      =>  'Edad del jugador/jugadora',
            'status'    =>  'Estado del jugador/jugadora',
            'sex'      =>  'Sexualidad del jugador/jugadora Masculino o Femenino',
            'level'     =>  'Nivel del jugador/jugadora'
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
            'id'        =>  'required|integer',
            'name'    =>  'required|string',
            'age'      =>  'nullable|integer|min:18|max:70',
            'status'    =>  'required|string|in:A,I',
            'sex'      =>  'required|string|in:M,F',
            'level'     =>  'required|integer|min:0|max:100',
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
            'required' => 'El campo :attribute es requerido',
        ];
    }
}
