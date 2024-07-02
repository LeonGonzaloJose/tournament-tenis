<?php

namespace App\Http\Requests\Tournament;

use App\ApiValidationRequest\ApiRequest;

class TournamentIndexRequest extends ApiRequest
{
    public function attributes()
    {
        return [
            'name'  =>  'Nombre del torneo',
            'sex'   =>  'Sexualidad de los participantes del torneo',
            'winner_id'=>  'Id del ganador'
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
            'winner_id'=> 'nullable|int'
        ];
    }

    public function messages()
    {
        return [
            'requided' => 'El campo :attribute es requerido',
            'string' => 'El campo :attribute tiene que ser de tipo string',
            'in' => 'El campo :attribute tiene que ser M (masculino) o F (femenino)'
        ];
    }
}
