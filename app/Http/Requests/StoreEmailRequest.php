<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmailRequest extends FormRequest
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
            'emails' => 'required|array|min:1',
            'emails.*' => 'email',
        ];
    }


    public function messages(): array
    {
        return [
            'emails.required' => 'O campo de emails é obrigatório.',
            'emails.array' => 'O campo de emails deve ser um array.',
            'emails.min' => 'É necessário fornecer pelo menos um email.',
            'emails.*.email' => 'Cada email deve ser um endereço de email válido.',
        ];
    }
}
