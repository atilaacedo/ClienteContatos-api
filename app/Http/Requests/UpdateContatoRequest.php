<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContatoRequest extends FormRequest
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
            'nome_completo' => 'sometimes|required|string|max:255',
            'cliente_id' => 'sometimes|required|exists:clientes,id',
        ];
    }


    public function messages(): array
    {
        return [
            'nome_completo.required' => 'O campo nome completo é obrigatório.',
            'nome_completo.string' => 'O campo nome completo deve ser uma string.',
            'nome_completo.max' => 'O campo nome completo não pode exceder 255 caracteres.',
            'cliente_id.required' => 'O campo cliente_id é obrigatório.',
            'cliente_id.exists' => 'O cliente_id fornecido não existe na tabela de clientes.',
        ];
    }
}
