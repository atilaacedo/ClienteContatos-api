<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
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
            'nome_completo' => 'required|string|max:255',
            'telefones' => 'sometimes|array',
            'telefones.*' => 'string|max:20',
            'emails' => 'sometimes|array',
            'emails.*' => 'email|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'nome_completo.required' => 'O campo nome completo é obrigatório.',
            'nome_completo.string' => 'O campo nome completo deve ser uma string.',
            'nome_completo.max' => 'O campo nome completo não pode exceder 255 caracteres.',
            'telefones.array' => 'O campo telefones deve ser um array.',
            'telefones.*.string' => 'Cada telefone deve ser uma string.',
            'telefones.*.max' => 'Cada telefone não pode exceder 20 caracteres.',
            'emails.array' => 'O campo emails deve ser um array.',
            'emails.*.email' => 'Cada email deve ser um endereço de email válido.',
            'emails.*.max' => 'Cada email não pode exceder 255 caracteres.',
        ];
    }
}
