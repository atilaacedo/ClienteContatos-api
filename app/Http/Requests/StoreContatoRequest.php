<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContatoRequest extends FormRequest
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
            'cliente_id'    => 'required|string|exists:clientes,id',
            'emails'        => 'nullable|array',
            'emails.*'      => 'required|email|distinct',
            'telefones'     => 'nullable|array',
            'telefones.*'   => 'required|string|min:8|distinct',
        ];
    }

    public function messages()
    {
        return [
            'nome_completo.required' => 'O campo nome completo é obrigatório.',
            'nome_completo.string' => 'O campo nome completo deve ser uma string.',
            'nome_completo.max' => 'O campo nome completo não pode exceder 255 caracteres.',
            'cliente_id.required' => 'O campo cliente_id é obrigatório.',
            'cliente_id.integer' => 'O campo cliente_id deve ser um número inteiro.',
            'cliente_id.exists' => 'O cliente especificado não existe.',
            'emails.array' => 'O campo emails deve ser um array.',
            'emails.*.email' => 'Cada email deve ser um endereço de email válido.',
            'emails.*.distinct' => 'Os emails devem ser distintos.',
            'telefones.array' => 'O campo telefones deve ser um array.',
            'telefones.*.string' => 'Cada telefone deve ser uma string.',
            'telefones.*.min' => 'Cada telefone deve ter pelo menos 8 caracteres.',
            'telefones.*.distinct' => 'Os telefones devem ser distintos.',
        ];
    }
}
