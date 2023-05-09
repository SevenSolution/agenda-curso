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
        return true;
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
            'end' => 'nullable|date',
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
            'title.max' => 'tamanho maximo excedido',
            'start.required' => 'Campo de início é obrigatório',
            'start.date' => 'Campo de início deve ser do tipo data',
            'end.date' => 'Campo de fim deve ser do tipo data'
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
        //ver onde retorna
        return [
            'title' => 'titulo',
            'start' => 'inicio',
            'end' => 'fim'
        ];
    }
}
