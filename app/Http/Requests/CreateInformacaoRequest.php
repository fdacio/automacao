<?php

namespace Automacao\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateInformacaoRequest extends FormRequest
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
            'texto' => 'required|max:255'
        ];
    }

        /**
     * Messages de validation
     * 
     */
    public function messages()
    {
        return [
            'texto.required' => 'Texto é obrigatório.',
            'texto.max' => 'Texto tem que ter no máximo 255 caracteres',
        ];
    }
}
