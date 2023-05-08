<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer este request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Prepara o valor para validação, ex: R$ 1.000,00 em 1,000.00
     *
     * @return void
     */
    public function prepareForValidation()
    {
        $this->merge([
        //    'start' => str_replace('/','-',$this->start),
        //    'end' => str_replace('/','-',$this->end),
        ]);
    }

    /**
     * Pega as regras de validação e aplica no request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'start' => 'required|date',
            'end' => 'nullable'
        ];
    }

    /**
     * Retorna as mensagens de erro.
     *
     * @return void
     */
    public function messages()
    {
        return[
            'title.required' => 'Campo título é obrigatório',
            'start.required' => 'Campo de início é obrigatório',
            //'end' => '',
        ];
    }

    /**
     * Troca o nome dos atributos
     *
     * @return void
     */
    public function attributes()
    {
        return [
            'title' => 'titulo',
            'start' => 'inicio',
            'end' => 'fim'
        ];
    }
}
