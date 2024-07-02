<?php

namespace App\Http\Requests\Player;

use App\ApiValidationRequest\ApiRequest;

class PlayerShowRequest extends ApiRequest
{
    public function attributes()
    {
        return [
            'id'        =>  'Identificador del jugador/jugadora'
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
            'id'        =>  'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'requided' => 'El campo :attribute es requerido',
            'integer' => 'El campo :attribute tiene que ser de tipo integer'
        ];
    }
}
