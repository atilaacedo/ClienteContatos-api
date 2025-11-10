<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClienteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nome_completo' => $this->nome_completo,
            'telefones' => $this->telefones->map(function($telefone) {
                return $telefone->numero;
            })->toArray(),
            'emails' => $this->emails->map(function($email) {
                return $email->email;
            })->toArray(),
            'data_registro' => $this->created_at->toDateTimeString()
        ];
    }
}
