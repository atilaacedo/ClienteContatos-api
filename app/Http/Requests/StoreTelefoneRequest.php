<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTelefoneRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'telefones' => 'required|array|min:1',
   //         'telefones.*' => 'string|regex:/^\+?[1-9]\d{1,14}$/',
        ];
    }

    public function messages(): array
    {
        return [
            'telefones.required' => 'O campo de telefones é obrigatório.',
            'telefones.array' => 'O campo de telefones deve ser um array.',
            'telefones.min' => 'É necessário fornecer pelo menos um telefone.',
            'telefones.*.string' => 'Cada telefone deve ser uma string válida.',
            //'telefones.*.regex' => 'Cada telefone deve estar no formato internacional válido.',
        ];
    }
}
