<?php

namespace Automacao\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateComponenteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => 'required|max:60',
            'pino' => 'required|integer'
        ];
    }

    /**
     * Messages de validation
     * 
     */
    public function messages()
    {
        return [
            'nome.required' => 'Nome é obrigatório.',
            'nome.max' => 'Nome tem que ter no máximo 60 caracteres',
            'pino.required' => 'Pino é obrigatório'
        ];
    }
}
